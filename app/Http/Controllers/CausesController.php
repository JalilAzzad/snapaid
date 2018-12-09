<?php

namespace App\Http\Controllers;

use App\Cause;
use App\CausesCategory;
use App\Report;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class CausesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $featured_causes = Cause::leftJoin('reports', 'causes.id', '=', 'reports.cause_id')
            ->selectRaw('causes.*, sum(reports.status) as count')
            ->whereBetween('reports.created_at', [Carbon::now()->subDays(7)->toDateTimeString(), Carbon::now()->toDateTimeString()])
            ->groupBy('causes.id')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();

        $value = $request->input('q', "");

        if(empty($value))
        {
            $categories = CausesCategory::with('causes')->get();
        } else {
            $categories = CausesCategory::with(['causes' => function($q) use($value) {
                // Query the name field in status table
                $q->where('title', 'like', "%".$value."%"); // '=' is optional
            }])->get();
        }

        return view('causes.index', ['categories' => $categories, 'featured_causes' => $featured_causes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $agent = new Agent();
        $category_id = $request->input('category_id', null);

        $cause = Cause::where('slug', (string) $slug)->first();
        if(is_null($cause))
            abort(404);

        $ip = $request->getClientIp();
        $user_agent = $request->server('HTTP_USER_AGENT');

        $client = new Client();

        $res = $client->get(env('API_URL').'api/wall/'.env('API_KEY').'/json?incent=1&mobile=1&snapaid=1&ip='.urlencode($ip).'&user_agent='.urlencode($user_agent));
        $res = json_decode($res->getBody(), true);

        $offers = collect([]);
        if(isset($res['campaigns'])) {
            $offers = collect($res['campaigns']);
        }
        $categories = collect([]);
        $keys = collect([]);
        foreach ($offers as $key => $offer)
        {
            $keys->push((int) $offer["category"]["id"]);
            if(!$keys->search((int) $offer["category"]["id"]))
                $categories->push($offer["category"]);

            if(!is_null($category_id) && (int) $category_id != 0)
            {
                if((int)$offer['category_id'] !== (int) $category_id)
                {
                    $offers->forget($key);
                }
            }
        }

        return view('causes.show', ['cause' => $cause, 'categories' => $categories, 'category_id' => $category_id, 'show' => (bool) $request->input('offers', false), 'agent' => $agent]);
    }


    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function showWall(Request $request, $slug)
    {
        $cause = Cause::where('slug', (string) $slug)->first();
        if(is_null($cause))
            abort(404);

        return view('causes.showWall', ['cause' => $cause]);
    }


    /**
     *
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function checkStatus(Request $request, $slug)
    {
        $cause = Cause::where('slug', (string) $slug)->first();
        if(is_null($cause))
            abort(404);

        return view('causes.showWall', ['cause' => $cause]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
