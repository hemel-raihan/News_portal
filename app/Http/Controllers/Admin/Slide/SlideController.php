<?php

namespace App\Http\Controllers\Admin\Slide;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Slide\Slide;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        return view('backend.admin.slide.index',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.slide.form');
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
            'slider_id' => 'required',
        ]);

        $title = Str::slug($request->title);

        //get form Slide images
        $slideimages = $request->file('slideimage');
        $images=array();
        $destination = public_path('uploads/slide_image');

        //dd($slideimages);

        if(isset($slideimages))
        {
            foreach($slideimages as $slideimage)
            {
               $slideimagename = $title.'-'.uniqid().'.'.$slideimage->getClientOriginalExtension();
               $slideimage->move($destination,$slideimagename);
               $images[]=$slideimagename;
            }

        }

        //check status
        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $slide = Slide::create([
            'slider_id'=>$request->slider_id,
            'title' => $request->title,
            'type' => $request->type,
            'url' => $request->url,
            'content' => $request->content,
            'slideimage' => implode("|",$images),
            'status' => $status
        ]);

        notify()->success("Slide Successfully created","Added");
        return redirect()->route('admin.slides.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return view('backend.admin.slide.form',compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $title = Str::slug($request->title);
        //get form Gallary image
        $slideimages = $request->file('slideimage');
        $images=array();
        $destination = public_path('uploads/slide_image');
        $oldimages = explode("|", $slide->slideimage);

        if(isset($slideimages))
        {

            foreach($oldimages as $image){

                $image_path = public_path('uploads/slide_image/'.$image);

                if (file_exists($image_path)) {

                    @unlink($image_path);

                }

            }

            foreach($slideimages as $slideimage)
            {

                $slideimagename = $title.'-'.uniqid().'.'.$slideimage->getClientOriginalExtension();
                $slideimage->move($destination,$slideimagename);
                $images[]=$slideimagename;
            }

        }
        else
            {
                $images[]=$slide->slideimage;
            }
        //check status
        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $slide->update([
            'slider_id'=>$request->slider_id,
            'title' => $request->title,
            'type' => $request->type,
            'url' => $request->url,
            'content' => $request->content,
            'slideimage' => implode("|",$images),
            'status' => $status
        ]);

        notify()->success("Slide Successfully updated","Updated");
        return redirect()->route('admin.slides.index');
    }

    public function status($id){
        $slide = Slide::find($id);
        if($slide->status == 1){
            $slide->status = 0;
            $slide->save();

            notify()->success("Slide Status Successfully updated","Updated");
            return redirect()->route('admin.slides.index');
        }
        else{
            $slide->status = 1;
            $slide->save();

            notify()->success("Slide Status Successfully updated","Updated");
            return redirect()->route('admin.slides.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        $images = explode("|", $slide->slideimage);

        foreach($images as $image){

            $image_path = public_path('uploads/slide_image/'.$image);

            if (file_exists($image_path)) {

                @unlink($image_path);

            }

        }

        $slide->delete();
        notify()->success('Slide Deleted Successfully','Delete');
        return back();
    }
}
