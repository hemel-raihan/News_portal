<?php

namespace App\Http\Controllers\Admin\blog;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Models\blog\category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.blog.categories.self');
        $categories = category::paginate(10);
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.blog.category.index',compact('categories','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.blog.categories.create');
        $categories = category::where('parent_id', '=', 0)->get();

        return view('backend.admin.blog.category.form',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.blog.categories.create');
        $this->validate($request,[
            'name' => 'required|unique:categories',
            'image' => 'mimes:png,jpg,jpeg,bmp|max:1024',
        ]);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

             $categoryphotoPath = public_path('uploads/categoryphoto');
            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = null;
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

        $category = category::create([
            'name' => $request->name,
            'slug' => $slug,
            'parent_id' => $parent_id,
            'image' => $imagename,
            'desc' => $request->desc,
            'position' => $request->position,
            'status' => $status,

        ]);

        notify()->success("Category Successfully created","Added");
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blog\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    public function approval($id)
    {
        Gate::authorize('app.blog.categories.approve');
        $category = category::find($id);
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
     * @param  \App\Models\blog\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        Gate::authorize('app.blog.categories.edit');
        $categories = category::where('parent_id', '=', 0)->get();
        return view('backend.admin.blog.category.form',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blog\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        Gate::authorize('app.blog.categories.edit');
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:png,jpg,jpeg,bmp|max:1024',
        ]);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $categoryphotoPath = public_path('uploads/categoryphoto');

            $categoryphoto_path = public_path('uploads/categoryphoto/'.$category->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }

            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $category->image;
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

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'parent_id' => $parent_id,
            'image' => $imagename,
            'desc' => $request->desc,
            'position' => $request->position,
            'status' => $status,

        ]);

        notify()->success("Category Successfully Updated","Update");
        return redirect()->route('admin.categories.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blog\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        Gate::authorize('app.blog.categories.destroy');
        // //delete old image
        // if(Storage::disk('public')->exists('categoryphoto/'.$category->image))
        // {
        //     Storage::disk('public')->delete('categoryphoto/'.$category->image);
        // }

        $categoryphoto_path = public_path('uploads/categoryphoto/'.$category->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }

        if($category->childrenRecursive->count()>0)
        {
            notify()->error('You Can not Delete this Item !! Sub-category exist','Alert');
        }
        elseif($category->posts()->count() >0)
        {
            notify()->error('You Can not Delete this Item !! Post exist under this category','Alert');
        }
        else
        {
            $category->delete();
            notify()->success('Category Deleted Successfully','Delete');
        }


        return back();
    }
}
