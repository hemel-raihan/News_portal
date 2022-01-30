<?php

namespace App\Http\Controllers\Admin\Slide;

use Illuminate\Http\Request;
use App\Models\Admin\Slide\Slider;
use App\Http\Controllers\Controller;
use App\Models\Admin\Slide\Slide;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.slider.form');
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
            'name' => 'required',
        ]);
        //check status
        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }
        //fwidth
        if(!$request->fullwidth)
        {
            $fullwidth = 0;
        }
        else
        {
            $fullwidth = 1;
        }

        $slider = Slider::create([
            'name' => $request->name,
            'height' => $request->height,
            'fullwidth' => $fullwidth,
            'width' => $request->width,
            'padding' => $request->padding,
            'margin' => $request->margin,
            'status' => $status
        ]);

        // dd($slider);

        notify()->success("New Slider Successfully created","Added");
        return redirect()->route('admin.sliders.index');
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
    public function edit(Slider $slider)
    {
        return view('backend.admin.slider.form',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        //fwidth
        if(!$request->fullwidth)
        {
            $fullwidth = 0;
        }
        else
        {
            $fullwidth = 1;
        }

        $slider->update([
            'name'=>$request->name,
            'height' => $request->height,
            'fullwidth' => $fullwidth,
            'width' => $request->width,
            'padding' => $request->padding,
            'margin' => $request->margin,
            'status' => $status
        ]);

        notify()->success("Slider Successfully Updated","Update");
        return redirect()->route('admin.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //also delete slide images from folder
        $slide = Slide::where('slider_id',$slider->id)->first();
        $images = explode("|", $slide->slideimage);

        foreach($images as $image){

            $image_path = public_path('slide_image/'.$image);

            if (file_exists($image_path)) {

                @unlink($image_path);

            }

        }

        $slider->delete();
        notify()->success("Slider Delete Succefully");
        return back();
    }
}
