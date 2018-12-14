<?php

namespace App\Http\Controllers;

use App\Cause;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DonateController extends Controller
{
    public function getDonatePage(Request $request, $slug)
    {
        $cause = Cause::where('slug', (string) $slug)->first();
        if(is_null($cause))
            abort(404);

        $client = new Client();
        $res = $client->get(env('API_URL').'api/wall/'.env('API_KEY').'/json?incent=1&mobile=1');
        $res = json_decode($res->getBody(), true);

        return view('causes.donate', ['cause' => $cause, 'offers' => $res['campaigns']]);
    }
}
