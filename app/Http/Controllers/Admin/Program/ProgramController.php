<?php

namespace App\Http\Controllers\Admin\Program;

use Carbon\Carbon;
use FFMpeg\FFMpeg;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use FFMpeg\Format\Video\X264;
use App\Models\Program\Program;
use FFMpeg\Coordinate\TimeCode;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Models\Program\Programcategory;
require 'vendor/autoload.php';

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::latest()->get();

        return view('backend.admin.program.post.index',compact('programs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Programcategory::all();
        return view('backend.admin.program.post.form',compact('categories'));
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
            'title' => 'required|unique:programs',
            //'video' => 'required',
            'categories' => 'required',
            'start_date' => 'required',
            //'start_time' => 'required|unique:programs',
            'end_date' => 'required',
            //'end_time' => 'required|unique:programs',
        ]);
        $slug = Str::slug($request->title);

        $file = $request->file('video');


        if(isset($file))
        {
            $file->move('public/uploads/video',$file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
        }
        else
        {
            $file_name = null;
        }

        if(isset($file))
        {
            $local_video = $file_name;
        }
        else
        {
            $local_video = null;
        }

        if(isset($request->embed_code))
        {
            $embed_code = $request->embed_code;
        }
        else
        {
            $embed_code = null;
        }
        // $ffmpeg = FFMpeg::create();
        // $video = $ffmpeg->open('asd.mpg');

        // $clip = $video->clip(TimeCode::fromSeconds(30), TimeCode::fromSeconds(15));
        // $clip->save(new X264(), 'dsa.mp4');

        // $video = '../../../../../Newfolder/hem/asd.mp4';
        // $output = '../../../../../Newfolder/hem/test.mp4';
        // $cmd = "C:/FFmpeg/bin/ffmpeg -i $video -ss 00:00:10 -t 00:00:10 $output";
        // echo shell_exec($cmd);


            $start = Carbon::parse($request->input('start_time'))->format('h:i a');
            $end = Carbon::parse($request->input('end_time'))->format('h:i a');


            //get form image
            $image = $request->file('poster');

            if(isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

                $postphotoPath = public_path('uploads/video');
                $img                     =       Image::make($image->path());
                $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);
            }
            else
            {
                $imagename = null;
            }
            $start_date=date("d/m/Y",strtotime($request->start_date));
            $program = Program::create([

                'programcategory_id' => $request->categories,
                'title' => $request->title,
                'slug' => $slug,
                'body' => $request->body,
                'poster' => $imagename,
                'video' => $local_video,
                'embed_code' => $embed_code,
                'start_date' => $request->start_date,
                'start_datetime' => $request->start_date.' '.$start,
                'start_time' => $request->start_time,
                'end_date' => $request->end_date,
                'end_datetime' => $request->end_date.' '.$end,
                'end_time' => $request->end_time,
            ]);
            notify()->success("Program Successfully created","Added");
            return redirect()->route('admin.programs.index');
            //return response()->json(['success'=>'Successfully uploaded.']);

        //}
    }


    public function status($id)
    {
        $program = Program::find($id);
        if($program->status == true)
        {
            $program->status = false;
            $program->save();

            notify()->success('Successfully Deactiveated Post');
        }
        elseif($program->status == false)
        {
            $program->status = true;
            $program->save();

            notify()->success('Removed the Activeated Approval');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $categories = Programcategory::all();
        return view('backend.admin.program.post.form',compact('program','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $this->validate($request,[
            'title' => 'required',
            'categories' => 'required',
        ]);

        $slug = Str::slug($request->title);

        $file = $request->file('video');

        if(isset($file))
        {
            $postphoto_path = public_path('uploads/video/'.$program->video);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }
            $file->move('public/uploads/video',$file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
        }
        else
        {
            $file_name = $program->video;
        }

        if(isset($file))
        {
            $local_video = $file_name;
        }
        else
        {
            $local_video = $program->video;
        }

        if(isset($request->embed_code))
        {
            $embed_code = $request->embed_code;
        }
        else
        {
            $embed_code = $program->embed_code;
        }

        $image = $request->file('poster');
        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/video');

            $postphoto_path = public_path('uploads/video/'.$program->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

           $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $program->poster;
        }

        $start = Carbon::parse($request->input('start_time'))->format('h:i a');
        $end = Carbon::parse($request->input('end_time'))->format('h:i a');

            $program->update([
                'programcategory_id' => $request->categories,
                'title' => $request->title,
                'slug' => $slug,
                'body' => $request->body,
                'poster' =>$imagename,
                'video' => $local_video,
                'embed_code' => $embed_code,
                'start_date' => $request->start_date,
                'start_datetime' => $request->start_date.' '.$start,
                'start_time' => $request->start_time,
                'end_date' => $request->end_date,
                'end_datetime' => $request->end_date.' '.$end,
                'end_time' => $request->end_time,
            ]);
            notify()->success("Program Successfully Updated","Updated");
            return redirect()->route('admin.programs.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $postphoto_path = public_path('uploads/video/'.$program->image);  // Value is not URL but directory file path
        if (file_exists($postphoto_path)) {

            @unlink($postphoto_path);

        }

        $program->delete();
        notify()->success('Program Deleted Successfully','Delete');
        return back();
    }
}
