<?php

namespace App\Http\Controllers\Admin\general_content;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\general_content\Contentcategory;

class ContentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.content.categories.self');
        $categories = Contentcategory::all();
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.general_content.category.index',compact('categories','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.content.categories.create');
        $categories = Contentcategory::where('parent_id', '=', 0)->get();
        $subcat = Contentcategory::all();
        $sidebars = Sidebar::all();
        return view('backend.admin.general_content.category.form',compact('categories','subcat','sidebars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.content.categories.create');
        $this->validate($request,[
           'name' => 'required|unique:contentcategories',
            'image' => 'required|mimes:png,jpg,jpeg,bmp|max:1024',
            'leftsidebar_id' => 'required',
            'rightsidebar_id' => 'required',

        ]);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $categoryphotoPath = public_path('uploads/contentcategoryphoto');
            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = "default.png";
        }

        if(!$request->parent_id)
        {
            $parent_id = 0;
        }
        else
        {
            $parent_id = $request->parent_id;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $category = Contentcategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'parent_id' => $parent_id,
            'image' => $imagename,
            'desc' => $request->desc,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,

        ]);

        notify()->success("Category Successfully created","Added");
        return redirect()->route('admin.contentcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\general_content\Contentcategory  $contentcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Contentcategory $contentcategory)
    {
        //
    }

    public function approval($id)
    {
        Gate::authorize('app.content.categories.approve');
        $category = Contentcategory::find($id);
        if($category->status == true)
        {
            $category->status = false;
            $category->save();

            notify()->success('Successfully approved category');
        }
        elseif($category->status == false)
        {
            $category->status = true;
            $category->save();

            notify()->success('Removed the Category Approval');
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\general_content\Contentcategory  $contentcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Contentcategory $contentcategory)
    {
        Gate::authorize('app.blog.categories.edit');
        $categories = Contentcategory::where('parent_id', '=', 0)->get();
        $subcat = Contentcategory::all();
        $editsidebars = Sidebar::all();
        return view('backend.admin.general_content.category.form',compact('contentcategory','categories','subcat','editsidebars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\general_content\Contentcategory  $contentcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contentcategory $contentcategory)
    {
        Gate::authorize('app.content.categories.edit');
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:png,jpg,jpeg,bmp|max:1024',
            'leftsidebar_id' => 'required',
            'rightsidebar_id' => 'required',

        ]);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $categoryphotoPath = public_path('uploads/contentcategory');

            $categoryphoto_path = public_path('uploads/contentcategory/'.$contentcategory->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }

           $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $contentcategory->image;
        }

        if(!$request->parent_id)
        {
            $parent_id = 0;
        }
        else
        {
            $parent_id = $request->parent_id;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $contentcategory->update([
            'name' => $request->name,
            'slug' => $slug,
            'parent_id' => $parent_id,
            'image' => $imagename,
            'desc' => $request->desc,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,

        ]);

        notify()->success("Category Successfully Updated","Update");
        return redirect()->route('admin.contentcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\general_content\Contentcategory  $contentcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contentcategory $contentcategory)
    {
        Gate::authorize('app.content.categories.destroy');
        //delete old image
        if(Storage::disk('public')->exists('contentcategoryphoto/'.$contentcategory->image))
        {
            Storage::disk('public')->delete('contentcategoryphoto/'.$contentcategory->image);
        }

        if($contentcategory->childrenRecursive->count()>0)
        {
            notify()->error('You Can not Delete this Item !! Sub-category exist','Alert');
        }
        elseif($contentcategory->contentposts()->count() >0)
        {
            notify()->error('You Can not Delete this Item !! Post exist under this category','Alert');
        }
        else

        {
            $contentcategory->delete();
            notify()->success('Category Deleted Successfully','Delete');
        }

        // if($contentcategory->childrenRecursive->count()>0)
        // {
        //     notify()->error('You Can not Delete this Item !! Sub-Item exist','Alert');
        // }
        // else
        // {
        //     $contentcategory->delete();
        //     notify()->success('Category Deleted Successfully','Delete');
        // }
        return back();
    }
}
