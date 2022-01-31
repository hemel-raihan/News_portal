<?php

namespace App\Http\Controllers\Admin\Program;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Program\Program;
use App\Http\Controllers\Controller;
use App\Models\Program\Programcategory;

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
            'video' => 'required',
            'categories' => 'required',
            'start_date' => 'required',
            'start_time' => 'required|unique:programs',
            'end_date' => 'required',
            'end_time' => 'required|unique:programs',
        ]);
        $slug = Str::slug($request->title);

        $file = $request->file('video');


        // $currentDate = Carbon::now()->toDateString();
        //     $videoname = $currentDate.'-'.uniqid().'.'.$video->getClientOriginalExtension();
            $file->move('public/uploads/video',$file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();

            $start = Carbon::parse($request->input('start_time'))->format('h:i a');
            $end = Carbon::parse($request->input('end_time'))->format('h:i a');


            // $program_date = Program::all();
            // foreach($program_date as $date)
            // {
            //     if($request->start_date == $date->start_date && $request->end_date == $date->end_date &&  $start > $date->start_time && $start < $date->end_time && $end > $date->end_time && $end < $date->end_time)
            //     {
            //         notify()->success("Already have a video in this date & time");
            //         return back();
            //     }
            // }

            // if($request->start_date != $date->start_date && $request->end_date != $date->end_date && $start != $date->start_time && $end != $date->end_time)
            // {
            $program = Program::create([
                'programcategory_id' => $request->categories,
                'title' => $request->title,
                'slug' => $slug,
                'video' => $file_name,
                'start_date' => $request->start_date,
                'start_time' => $start,
                'end_date' => $request->end_date,
                'end_time' => $end,
            ]);
            notify()->success("Program Successfully created","Added");
            return redirect()->route('admin.programs.index');
        //}
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

        $start = Carbon::parse($request->input('start_time'))->format('h:i a');
        $end = Carbon::parse($request->input('end_time'))->format('h:i a');

            $program->update([
                'programcategory_id' => $request->categories,
                'title' => $request->title,
                'slug' => $slug,
                'video' => $file_name,
                'start_date' => $request->start_date,
                'start_time' => $start,
                'end_date' => $request->end_date,
                'end_time' => $end,
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
