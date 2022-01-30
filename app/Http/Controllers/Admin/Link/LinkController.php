<?php

namespace App\Http\Controllers\Admin\Link;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Link\Link;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $links = Link::all();
        return view('backend.admin.link.index',compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.link.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'title' => 'required',
        //     'slider_id' => 'required',
        // ]);

        //check status
        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

       $link = Link::create([
            'name' => $request->name,
            'link' => $request->link,
            'text' => $request->text,
            'color' => $request->color,
            'bgcolor' => $request->bgcolor,
            'status' => $status
        ]);

        notify()->success("Link Successfully created","Added");
        return redirect()->route('admin.links.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    // public function details(Link $link)
    // {
    //     return view('frontend_theme.default.front_layout.single-link',compact('link'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        return view('backend.admin.link.form',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {

        //check status
        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

       $link->update([
            'name' => $request->name,
            'link' => $request->link,
            'text' => $request->text,
            'color' => $request->color,
            'bgcolor' => $request->bgcolor,
            'status' => $status
        ]);

        notify()->success("Link Successfully updated","Updated");
        return redirect()->route('admin.links.index');
    }

    public function status($id){
       $link = Link::find($id);
        if($link->status == 1){
           $link->status = 0;
           $link->save();

            notify()->success("Link Status Successfully updated","Updated");
            return redirect()->route('admin.links.index');
        }
        else{
           $link->status = 1;
           $link->save();

            notify()->success("Link Status Successfully updated","Updated");
            return redirect()->route('admin.links.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {

       $link->delete();
        notify()->success('Link Deleted Successfully','Delete');
        return back();
    }
}
