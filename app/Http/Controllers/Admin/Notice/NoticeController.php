<?php

namespace App\Http\Controllers\Admin\Notice;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Notice\Notice;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::all();
        return view('backend.admin.notice.index',compact('notices'));
    }

    public function noticeList(){
        $notices = Notice::all();
        return view('frontend_theme.default.front_layout.all-notice',compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.notice.form');
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

        //get form file
        $file = $request->file('files');

        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $filename = $currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/files');
            $file->move($destinationPath,$filename);

        }
        else
        {
            $filename = null;
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

       $notice = Notice::create([
            'title' => $request->title,
            'files' => $filename,
            'status' => $status
        ]);

        notify()->success("Notice Successfully created","Added");
        return redirect()->route('admin.notices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        return view('backend.admin.notice.form',compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
                //get form file
                $file = $request->file('files');

                if(isset($file))
                {
                    $currentDate = Carbon::now()->toDateString();
                    $filename = $currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/files');


                    $file_path = public_path('uploads/files/'.$notice->files);  // Value is not URL but directory file path
                    if (file_exists($file_path)) {

                        @unlink($file_path);

                    }
                    $file->move($destinationPath,$filename);

                }
                else
                {
                    $filename = $notice->files;
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

       $notice->update([
           'title' => $request->title,
           'file'=>$request->files,
            'status' => $status
        ]);

        notify()->success("Notice Successfully updated","Updated");
        return redirect()->route('admin.notices.index');
    }

    public function status($id){
       $notice = Notice::find($id);
        if($notice->status == 1){
           $notice->status = 0;
           $notice->save();

            notify()->success("Notice Status Successfully updated","Updated");
            return redirect()->route('admin.notices.index');
        }
        else{
           $notice->status = 1;
           $notice->save();

            notify()->success("Notice Status Successfully updated","Updated");
            return redirect()->route('admin.notices.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        $pdf_file = public_path('uploads/files/'.$notice->files);  // Value is not URL but directory file path
        if (file_exists($pdf_file)) {

            @unlink($pdf_file);

        }

       $notice->delete();
        notify()->success('Notice Deleted Successfully','Delete');
        return back();
    }
}
