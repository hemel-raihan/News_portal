<?php

namespace App\Http\Controllers\Admin\Portfolio;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Models\Portfolio\Portfoliocategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.portfolio.categories.self');
        $categories = Portfoliocategory::paginate(9);
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.portfolio.category.index',compact('categories','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.portfolio.categories.create');
        $categories = Portfoliocategory::where('parent_id', '=', 0)->get();
        $subcat = Portfoliocategory::all();
        return view('backend.admin.portfolio.category.form',compact('categories','subcat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.portfolio.categories.create');
        $this->validate($request,[
            'name' => 'required|unique:portfoliocategories',
            'image' => 'required|mimes:png,jpg,jpeg,bmp|max:1024',
        ]);


        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

             $categoryphotoPath = public_path('uploads/portfoliocategory_photo');
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

        $category = Portfoliocategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imagename,
            'desc' => $request->desc,
            'parent_id' => $parent_id,
            'status' => $status,

        ]);

        notify()->success("Category Successfully created","Added");
        return redirect()->route('admin.portfoliocategories.index');
    }

    public function approval($id)
    {
        Gate::authorize('app.portfolio.categories.approve');
        $category = Portfoliocategory::find($id);
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
     * @param  \App\Models\Service\Servicecategory  $servicecategory
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service\Servicecategory  $servicecategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfoliocategory $portfoliocategory)
    {
        Gate::authorize('app.portfolio.categories.edit');
        $categories = Portfoliocategory::where('parent_id', '=', 0)->get();
        $subcat = Portfoliocategory::all();
        return view('backend.admin.portfolio.category.form',compact('portfoliocategory','categories','subcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service\Servicecategory  $servicecategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Portfoliocategory $portfoliocategory)
    {
        Gate::authorize('app.portfolio.categories.edit');
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

            $categoryphotoPath = public_path('uploads/portfoliocategory_photo');

            $categoryphoto_path = public_path('uploads/portfoliocategory_photo/'.$portfoliocategory->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }

            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $portfoliocategory->image;
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

        $portfoliocategory->update([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imagename,
            'desc' => $request->desc,
            'parent_id' => $parent_id,
            'status' => $status,

        ]);

        notify()->success("Category Successfully Updated","Update");
        return redirect()->route('admin.portfoliocategories.index');
    }


    public function destroy(Portfoliocategory $portfoliocategory)
    {
        Gate::authorize('app.portfolio.categories.destroy');

        $categoryphoto_path = public_path('uploads/portfoliocategory_photo/'.$portfoliocategory->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }

        if($portfoliocategory->childrenRecursive->count()>0)
        {
            notify()->error('You Can not Delete this Item !! Sub-category exist','Alert');
        }
        elseif($portfoliocategory->portfolios()->count() >0)
        {
            notify()->error('You Can not Delete this Item !! Post exist under this category','Alert');
        }
        else
        {
            $portfoliocategory->delete();
            notify()->success('Category Deleted Successfully','Delete');
        }

        return back();
    }
}
