<?php

namespace App\Http\Controllers\Admin\Pagebuilder;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pagebuilder\Pagebuilder;

class ElementController extends Controller
{
    public function index($id)
    {
        //Gate::authorize('app.build.pages.pagebuilder');
        $page = Pagebuilder::findOrFail($id);
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.pagebuilder.element.index',compact('page','auth'));
    }

    public function create($id)
    {
        $page = Pagebuilder::findOrFail($id);
        return view('backend.admin.pagebuilder.element.form',compact('page'));
    }

    public function store(Request $request,$id)
    {
        $page = Pagebuilder::findOrFail($id);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $sidebarphotoPath = public_path('uploads/elementphoto');
            $image->move($sidebarphotoPath,$imagename);

        }
        else
        {
            $imagename = null;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $page->elements()->create([
            'title' => $request->title,
            'module_type' => $request->module_type,
            'layout' => $request->layout,
            'post_qty' => $request->post_qty,
            'image' => $imagename,
            'img_width' => $request->img_width,
            'img_height' => $request->img_height,
            'img_margin' => $request->img_margin,
            'margin_amt' => $request->margin_amt,
            'img_topmargin' => $request->img_topmargin,
            'topmargin_amt' => $request->topmargin_amt,
            'body' => $request->body,
            'status' => $status,


        ]);
        notify()->success("Element Successfully created","Added");
        return redirect()->route('admin.element.index',$id);
    }

    public function edit($id,$elementId)
    {
        $auth = Auth::user();
        $page = Pagebuilder::findOrFail($id);
        $element = $page->elements()->findOrFail($elementId);
        return view('backend.admin.pagebuilder.element.form',compact('page','auth','element'));
    }

    public function update(Request $request,$id,$elementId)
    {
        //Gate::authorize('app.menus.edit');
        $page = Pagebuilder::findOrFail($id);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $sidebarphotoPath = public_path('uploads/elementphoto');

            $sidebarphoto_path = public_path('uploads/elementphoto/'.$page->elements()->findOrFail($elementId)->image);  // Value is not URL but directory file path
            if (file_exists($sidebarphoto_path)) {

                @unlink($sidebarphoto_path);

            }

            $image->move($sidebarphotoPath,$imagename);

        }
        else
        {
            $imagename = $page->elements()->findOrFail($elementId)->image;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $page->elements()->findOrFail($elementId)->update([
            'title' => $request->title,
            'module_type' => $request->module_type,
            'layout' => $request->layout,
            'post_qty' => $request->post_qty,
            'image' => $imagename,
            'img_width' => $request->img_width,
            'img_height' => $request->img_height,
            'img_margin' => $request->img_margin,
            'margin_amt' => $request->margin_amt,
            'img_topmargin' => $request->img_topmargin,
            'topmargin_amt' => $request->topmargin_amt,
            'body' => $request->body,
            'status' => $status,
        ]);

        notify()->success('Element Updated','Update');
        return redirect()->route('admin.element.index',$id);
    }

    public function destroy($id,$elementId)
    {
        $page = Pagebuilder::findOrFail($id);

        $sidebarphoto_path = public_path('uploads/elementphoto/'.$page->elements()->findOrFail($elementId)->image);  // Value is not URL but directory file path
        if (file_exists($sidebarphoto_path)) {

            @unlink($sidebarphoto_path);

        }

        Pagebuilder::findOrFail($id)
                 ->elements()
                 ->findOrFail($elementId)
                 ->delete();

        notify()->success('Element Delete Successfully');
        return back();
    }
}
