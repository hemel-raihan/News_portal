<?php

namespace App\Http\Controllers\Admin\Pagebuilder;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Pagebuilder\Custompage;
use App\Models\Pagebuilder\Pagebuilder;

class PagebuilderController extends Controller
{
    public function index($id)
    {
        Gate::authorize('app.build.pages.pagebuilder');
        $page = Custompage::findOrFail($id);
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.pagebuilder.builder',compact('page','auth'));
    }

    public function create($id)
    {
        $page = Custompage::findOrFail($id);
        return view('backend.admin.pagebuilder.section.form',compact('page'));
    }

    public function store(Request $request,$id)
    {
        $page = Custompage::findOrFail($id);

        //get form image
        $image = $request->file('background_img');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $sidebarphotoPath = public_path('uploads/sectionpagephoto');
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

        if(!$request->background_img)
        {
            $background_img = null;
        }
        else
        {
            $background_img = $imagename;
        }

        if(!$request->background_color)
        {
            $background_color = null;
        }
        else
        {
            $background_color = $request->background_color;
        }

        $page->pagebuilders()->create([
            'title' => $request->title,
            'layout' => $request->layout,
            'padding' => $request->padding,
            'margin' => $request->margin,
            'border' => $request->border,
            'bordercolor' => $request->bordercolor,
            'border_style' => $request->border_style,
            'status' => $status,
            'background_color' => $background_color,
            'background_img' => $background_img,

        ]);
        notify()->success("Section Successfully created","Added");
        return redirect()->route('admin.custompage.builder',$id);
    }

    public function order(Request $request, $id)
    {
        $page = Custompage::findOrFail($id);
        $pageItemOrder = json_decode($request->get('order'));
        $this->orderPage($pageItemOrder,null);
    }

    private function orderPage(array $pageItems, $parentId)
    {
        foreach($pageItems as $index => $item)
        {
            $pageItem = Pagebuilder::findOrFail($item->id);
            $pageItem->update([
                'order' => $index + 1,
            ]);

        }
    }

    public function edit($id,$pageId)
    {
        $auth = Auth::user();
        $page = Custompage::findOrFail($id);
        $pagebuilder = $page->pagebuilders()->findOrFail($pageId);
        return view('backend.admin.pagebuilder.section.form',compact('page','auth','pagebuilder'));
    }

    public function update(Request $request,$id,$pageId)
    {
        //Gate::authorize('app.menus.edit');
        $page = Custompage::findOrFail($id);

        //get form image
        $image = $request->file('background_img');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $sidebarphotoPath = public_path('uploads/sectionpagephoto');

            $sidebarphoto_path = public_path('uploads/sectionpagephoto/'.$page->pagebuilders()->findOrFail($pageId)->background_img);  // Value is not URL but directory file path
            if (file_exists($sidebarphoto_path)) {

                @unlink($sidebarphoto_path);

            }

            $image->move($sidebarphotoPath,$imagename);

        }
        else
        {
            $imagename = $page->pagebuilders()->findOrFail($pageId)->background_img;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        if(!$request->background_img)
        {
            $background_img = null;
        }
        else
        {
            $background_img = $imagename;
        }

        if(!$request->background_color)
        {
            $background_color = null;
        }
        else
        {
            $background_color = $request->background_color;
        }

        $page->pagebuilders()->findOrFail($pageId)->update([
            'title' => $request->title,
            'layout' => $request->layout,
            'padding' => $request->padding,
            'margin' => $request->margin,
            'border' => $request->border,
            'bordercolor' => $request->bordercolor,
            'border_style' => $request->border_style,
            'status' => $status,
            'background_color' => $background_color,
            'background_img' => $background_img,
        ]);

        notify()->success('Section Updated','Update');
        return redirect()->route('admin.custompage.builder',$id);
    }

    // public function widgetdetails($id)
    // {
    //     $widget = Widget::find($id);
    //     return view('frontend_theme.default.widget_detailspage',compact('widget'));
    // }

    public function destroy($id,$pageId)
    {
        $page = Custompage::findOrFail($id);

        $sidebarphoto_path = public_path('uploads/sectionpagephoto/'.$page->pagebuilders()->findOrFail($pageId)->background_img);  // Value is not URL but directory file path
        if (file_exists($sidebarphoto_path)) {

            @unlink($sidebarphoto_path);

        }

        Custompage::findOrFail($id)
                 ->pagebuilders()
                 ->findOrFail($pageId)
                 ->delete();

        notify()->success('Section Delete Successfully');
        return back();
    }
}
