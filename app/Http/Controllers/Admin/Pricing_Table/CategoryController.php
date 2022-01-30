<?php

namespace App\Http\Controllers\Admin\Pricing_Table;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Models\Pricing_Table\Pricecategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.price.categories.self');
        $categories = Pricecategory::paginate(2);
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.pricing_table.category.index',compact('categories','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.price.categories.create');
        $categories = Pricecategory::where('parent_id', '=', 0)->get();
        $subcat = Pricecategory::all();
        return view('backend.admin.pricing_table.category.form',compact('categories','subcat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.price.categories.create');
        $this->validate($request,[
            'name' => 'required|unique:pricecategories',
            'image' => 'required|mimes:png,jpg,jpeg,bmp|max:1024',
        ]);


        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

             $categoryphotoPath = public_path('uploads/pricecategory_photo');
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

        $category = Pricecategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imagename,
            'desc' => $request->desc,
            'parent_id' => $parent_id,
            'status' => $status,

        ]);

        notify()->success("Category Successfully created","Added");
        return redirect()->route('admin.pricecategories.index');
    }


    public function approval($id)
    {
        Gate::authorize('app.price.categories.approve');
        $category = Pricecategory::find($id);
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
     * Display the specified resource.
     *
     * @param  \App\Models\Pricing_Table\Pricecategory  $pricecategory
     * @return \Illuminate\Http\Response
     */
    public function show(Pricecategory $pricecategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pricing_Table\Pricecategory  $pricecategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Pricecategory $pricecategory)
    {
        Gate::authorize('app.price.categories.edit');
        $categories = Pricecategory::where('parent_id', '=', 0)->get();
        $subcat = Pricecategory::all();
        return view('backend.admin.pricing_table.category.form',compact('servicecategory','categories','subcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pricing_Table\Pricecategory  $pricecategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pricecategory $pricecategory)
    {
        Gate::authorize('app.price.categories.edit');
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

            $categoryphotoPath = public_path('uploads/pricecategory_photo');

            $categoryphoto_path = public_path('uploads/pricecategory_photo/'.$pricecategory->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }

            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $pricecategory->image;
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

        $pricecategory->update([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imagename,
            'desc' => $request->desc,
            'parent_id' => $parent_id,
            'status' => $status,

        ]);

        notify()->success("Category Successfully Updated","Update");
        return redirect()->route('admin.pricecategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pricing_Table\Pricecategory  $pricecategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pricecategory $pricecategory)
    {
        Gate::authorize('app.service.categories.destroy');

        $categoryphoto_path = public_path('uploads/pricecategory_photo/'.$pricecategory->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }

        if($pricecategory->childrenRecursive->count()>0)
        {
            notify()->error('You Can not Delete this Item !! Sub-category exist','Alert');
        }
        elseif($pricecategory->prices()->count() >0)
        {
            notify()->error('You Can not Delete this Item !! Post exist under this category','Alert');
        }
        else
        {
            $pricecategory->delete();
            notify()->success('Category Deleted Successfully','Delete');
        }

        return back();
    }
}
