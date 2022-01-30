<?php

namespace App\Http\Controllers\Admin\Product;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.product.brands.self');
        $brands = Brand::all();
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.product.brand.index',compact('brands','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.product.brands.create');
        return view('backend.admin.product.brand.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.product.brands.create');
        $this->validate($request,[
            'name' => 'required|unique:brands',
            'image' => 'mimes:png,jpg,jpeg,bmp|max:1024',

        ]);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

             $brandphotoPath = public_path('uploads/productbrand_photo');

            //  if (file_exists($categoryphotoPath)) {
            //     Storage::makeDirectory($categoryphotoPath, 0775, true, true);
            // }

            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($brandphotoPath.'/'.$imagename);

        }



        $brand = Brand::create([
            'name' => $request->name,
            'image' => $imagename,
            'desc' => $request->desc,

        ]);

        notify()->success("Brand Successfully created","Added");
        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        Gate::authorize('app.product.brands.edit');
        return view('backend.admin.product.brand.form',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        Gate::authorize('app.product.brands.edit');
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

            $brandphotoPath = public_path('uploads/productbrand_photo');

            $brandphoto_path = public_path('uploads/productbrand_photo/'.$brand->image);  // Value is not URL but directory file path
            if (file_exists($brandphoto_path)) {

                @unlink($brandphoto_path);

            }

            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($brandphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $brand->image;
        }

        $brand->update([
            'name' => $request->name,
            'image' => $imagename,
            'desc' => $request->desc,
        ]);

        notify()->success("Brand Successfully Updated","Update");
        return redirect()->route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        Gate::authorize('app.product.brands.destroy');

        $brandphoto_path = public_path('uploads/productbrand_photo/'.$brand->image);  // Value is not URL but directory file path
            if (file_exists($brandphoto_path)) {

                @unlink($brandphoto_path);

            }
            $brand->delete();
            notify()->success('Brand Deleted Successfully','Delete');

        return back();
    }
}
