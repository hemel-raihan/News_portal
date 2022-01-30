<?php

namespace App\Http\Controllers\Admin\sidebar;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Admin\Widget;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Models\blog\category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class WidgetbuilderController extends Controller
{
    public function index($id)
    {
        Gate::authorize('app.sidebars.widgetbuilder');
        $sidebar = Sidebar::findOrFail($id);
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.sidebar.builder',compact('sidebar','auth'));
    }

    public function create($id)
    {
        $sidebar = Sidebar::findOrFail($id);
        //$categories = category::where('parent_id', '=', 0)->get();
        $categories = category::all();
        return view('backend.admin.sidebar.widget.form',compact('sidebar','categories'));
    }

    public function store(Request $request,$id)
    {
        $sidebar = Sidebar::findOrFail($id);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $sidebarphotoPath = public_path('uploads/sidebarphoto');
            $image->move($sidebarphotoPath,$imagename);

        }
        else
        {
            $imagename = null;
        }
        $sidebar->widgets()->create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'no_of_post' => $request->no_of_post,
            'type' => $request->type,
            'image' => $imagename,
            'body' => $request->body,

        ]);
        notify()->success("Widget Successfully created","Added");
        return redirect()->route('admin.widget.builder',$id);
    }

    public function order(Request $request, $id)
    {
        $sidebar = Sidebar::findOrFail($id);
        $widgetItemOrder = json_decode($request->get('order'));
        $this->orderWidget($widgetItemOrder,null);
    }

    private function orderWidget(array $widgetItems, $parentId)
    {
        foreach($widgetItems as $index => $item)
        {
            $widgetItem = Widget::findOrFail($item->id);
            $widgetItem->update([
                'order' => $index + 1,
            ]);

        }
    }

    public function edit($id,$widgetId)
    {
        $auth = Auth::user();
        $sidebar = Sidebar::findOrFail($id);
        $widget = $sidebar->widgets()->findOrFail($widgetId);
        $editcategories = category::all();
        return view('backend.admin.sidebar.widget.form',compact('sidebar','auth','widget','editcategories'));
    }

    public function update(Request $request,$id,$widgetId)
    {
        //Gate::authorize('app.menus.edit');
        $sidebar = Sidebar::findOrFail($id);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $sidebarphotoPath = public_path('uploads/sidebarphoto');

            $sidebarphoto_path = public_path('uploads/sidebarphoto/'.$sidebar->widgets()->findOrFail($widgetId)->image);  // Value is not URL but directory file path
            if (file_exists($sidebarphoto_path)) {

                @unlink($sidebarphoto_path);

            }

            $image->move($sidebarphotoPath,$imagename);

        }
        else
        {
            $imagename = $sidebar->widgets()->findOrFail($widgetId)->image;
        }

        $sidebar->widgets()->findOrFail($widgetId)->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'no_of_post' => $request->no_of_post,
            'type' => $request->type,
            'image' => $imagename,
            'body' => $request->body,
        ]);

        notify()->success('Widget Item Updated','Update');
        return redirect()->route('admin.widget.builder',$id);
    }
    
    public function widgetdetails($id)
    {
        $widget = Widget::find($id);
        return view('frontend_theme.default.widget_detailspage',compact('widget'));
    }

    public function destroy($id,$widgetId)
    {
        $sidebar = Sidebar::findOrFail($id);

        $sidebarphoto_path = public_path('uploads/sidebarphoto/'.$sidebar->widgets()->findOrFail($widgetId)->image);  // Value is not URL but directory file path
        if (file_exists($sidebarphoto_path)) {

            @unlink($sidebarphoto_path);

        }

        Sidebar::findOrFail($id)
                 ->widgets()
                 ->findOrFail($widgetId)
                 ->delete();

        notify()->success('Widget Delete Successfully');
        return back();
    }
}
