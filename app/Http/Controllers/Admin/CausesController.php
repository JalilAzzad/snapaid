<?php

namespace App\Http\Controllers\Admin;

use App\Cause;
use App\CausesCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CausesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $causes = Cause::with('category')->get();
        return view('admin.causes.index', ['causes' => $causes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cause = new Cause();
        $categories = CausesCategory::all()->pluck('title', 'id');
        return view('admin.causes.create', ['cause' => $cause, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title'           => 'required|string|max:255',
            'description'    => 'required|string|max:5000',
            'category'       => 'required|exists:causes_categories,id',
            'image'          => 'mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return redirect('/admin/causes/create')
                ->withErrors($validator)
                ->withInput();
        }

        $cause = new Cause();
        $cause->title = $request->input('title');
        $cause->description = $request->input('description');
        $cause->category_id = $request->input('category');
        $cause->file_ext = ($request->file('image'))->getClientOriginalExtension();
        $cause->slug = str_slug($cause->title);
        $cause->save();

        // Store Image
        $file = $request->file('image');
        $destinationPath = public_path('/images/causes');
        $fileExt = $file->getClientOriginalExtension();
        $filename = $cause->id.".".$fileExt;
        $file->move($destinationPath, $filename);
        $img = $filename;

        return redirect('/admin/causes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cause = Cause::findOrFail($id);
        return view('admin.causes.show', ['cause' => $cause]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cause = Cause::findOrFail((int) $id);
        $categories = CausesCategory::all()->pluck('title', 'id');
        return view('admin.causes.edit', ['cause' => $cause, 'categories' => $categories]);
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
        $cause = Cause::findOrFail((int) $id);
        $validator = \Validator::make($request->all(), [
            'title'           => 'required|string|max:255',
            'description'    => 'required|string|max:5000',
            'category'       => 'required|exists:causes_categories,id',
            'image'          => 'mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return redirect('/admin/causes/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $file = $request->file('image');


        $cause->title = $request->input('title');
        $cause->description = $request->input('description');
        $cause->category_id = $request->input('category');
        $cause->slug = str_slug($cause->title);

        // Store Image
        if(! is_null($file)) {
            $destinationPath = public_path('/images/causes');
            $fileExt = $file->getClientOriginalExtension();
            $filename = $cause->id . "." . $fileExt;
            $file->move($destinationPath, $filename);
            $img = $filename;
            $cause->file_ext = ($request->file('image'))->getClientOriginalExtension();
        }

        $cause->save();

        return redirect('/admin/causes');
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
