<?php

namespace App\Http\Controllers\Admin\Product;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Models\Product\Productcategory;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.product.categories.self');
        $categories = Productcategory::all();
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.product.category.index',compact('categories','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.product.categories.create');
        $categories = Productcategory::where('parent_id', '=', 0)->get();
        $subcat = Productcategory::all();
        $sidebars = Sidebar::all();
        return view('backend.admin.product.category.form',compact('categories','subcat','sidebars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.product.categories.create');
        $this->validate($request,[
            'name' => 'required|unique:productcategories',
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

             $categoryphotoPath = public_path('uploads/productcategory_photo');

            //  if (file_exists($categoryphotoPath)) {
            //     Storage::makeDirectory($categoryphotoPath, 0775, true, true);
            // }

            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

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

        $category = Productcategory::create([
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
        return redirect()->route('admin.productcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Productcategory $productcategory)
    {
        //
    }

    public function approval($id)
    {
        Gate::authorize('app.product.categories.approve');
        $category = Productcategory::find($id);
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
     * @param  \App\Models\Product\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Productcategory $productcategory)
    {
        Gate::authorize('app.product.categories.edit');
        $categories = Productcategory::where('parent_id', '=', 0)->get();
        $subcat = Productcategory::all();
        $editsidebars = Sidebar::all();
        return view('backend.admin.product.category.form',compact('productcategory','categories','subcat','editsidebars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productcategory $productcategory)
    {
        Gate::authorize('app.product.categories.edit');
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

            $categoryphotoPath = public_path('uploads/productcategory_photo');

            $categoryphoto_path = public_path('uploads/productcategory_photo/'.$productcategory->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }

            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $productcategory->image;
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

        $productcategory->update([
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
        return redirect()->route('admin.productcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\Productcategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productcategory $productcategory)
    {
        Gate::authorize('app.product.categories.destroy');
        // //delete old image
        // if(Storage::disk('public')->exists('categoryphoto/'.$category->image))
        // {
        //     Storage::disk('public')->delete('categoryphoto/'.$category->image);
        // }

        $categoryphoto_path = public_path('uploads/productcategory_photo/'.$productcategory->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }

        if($productcategory->childrenRecursive->count()>0)
        {
            notify()->error('You Can not Delete this Item !! Sub-category exist','Alert');
        }

        elseif($productcategory->products()->count() >0)
        {
            notify()->error('You Can not Delete this Item !! Post exist under this category','Alert');
        }
        else
        {
            $productcategory->delete();
            notify()->success('Category Deleted Successfully','Delete');
        }


        return back();
    }
}
