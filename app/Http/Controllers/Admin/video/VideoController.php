<?php

namespace App\Http\Controllers\Admin\video;

use App\Http\Controllers\Controller;
use App\Models\Admin\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::latest()->get();
        return view('backend.admin.video.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $videos = Video::all();
        return view('backend.admin.video.form',compact('videos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
        ]);



        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $video = Video::create([
            'title' => $request->title,
            'url' => $request->url,
            'type' => $request->type,
            'status' => $status,
        ]);



        notify()->success("Video Successfully created","Added");
        return redirect()->route('admin.videos.index');
    }


    public function status_approval($id)
    {
        $video = Video::find($id);
        if($video->status == true)
        {
            $video->status = false;
            $video->save();

            notify()->success('Successfully Deactiveated');
        }
        elseif($video->status == false)
        {
            $video->status = true;
            $video->save();

            notify()->success('Successfully Activated');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('backend.admin.video.form',compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $this->validate($request,[
            'title' => 'required',
        ]);


        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $video->update([
            'title' => $request->title,
            'url' => $request->url,
            'type' => $request->type,
            'status' => $status,
        ]);



        notify()->success("Video Successfully Updated","Update");
        return redirect()->route('admin.videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        notify()->success('Video Deleted Successfully','Delete');
        return back();
    }
}
