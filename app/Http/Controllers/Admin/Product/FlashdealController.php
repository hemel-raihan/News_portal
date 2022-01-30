<?php

namespace App\Http\Controllers\Admin\Product;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Flashdeal;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class FlashdealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flashdeals = Flashdeal::paginate(10);
        return view('backend.admin.marketing.flash_deals.index',compact('flashdeals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.marketing.flash_deals.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|unique:flashdeals',
            'banner' => 'mimes:png,jpg,jpeg,bmp|max:1024',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        //get form image
        $image = $request->file('banner');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

             $categoryphotoPath = public_path('uploads/flashdeal_photo');


            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename =null;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $flashdeals = Flashdeal::create([
            'title' => $request->title,
            'slug' => $slug,
            'banner' => $imagename,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'background_color' => $request->background_color,
            'text_color' => $request->text_color,
            'status' => $status,
        ]);

        $flashdeals->products()->attach($request->products);

        foreach ($request->products as $key => $product) {
        $root_product = Product::findOrFail($product);
        $root_product->discount_rate = $request['discount_'.$product];
        $root_product->discount_type = $request['discount_type_'.$product];
        $root_product->discount_startdate = $request->start_date;
        $root_product->discount_enddate   = $request->end_date;
        $root_product->save();
        }

        notify()->success("Flash-Deals Successfully created","Added");
        return redirect()->route('admin.flash-deals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Flashdeal  $flashdeal
     * @return \Illuminate\Http\Response
     */
    public function product_discount(Request $request){
        $product_ids = $request->product_ids;
        return view('backend.admin.marketing.flash_deals.flash_deal_discount', compact('product_ids'));
    }

    public function product_discount_edit(Request $request){
        $product_ids = $request->product_ids;
        $flash_deal_id = $request->flash_deal_id;
        return view('backend.admin.marketing.flash_deals.flash_deal_discount_edit', compact('product_ids', 'flash_deal_id'));
    }



    public function status($id)
    {
        $flashdeal = Flashdeal::find($id);
        if($flashdeal->status == true)
        {
            $flashdeal->status = false;
            $flashdeal->save();

            notify()->success('Successfully Deactiveated Post');
        }
        elseif($flashdeal->status == false)
        {
            $flashdeal->status = true;
            $flashdeal->save();

            notify()->success('Removed the Activeated Approval');
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\Flashdeal  $flashdeal
     * @return \Illuminate\Http\Response
     */
    public function edit(Flashdeal $flash_deal)
    {
        return view('backend.admin.marketing.flash_deals.form',compact('flash_deal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Flashdeal  $flashdeal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flashdeal $flash_deal)
    {
        $this->validate($request,[
            'title' => 'required',
            'banner' => 'mimes:png,jpg,jpeg,bmp|max:1024',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        //get form image
        $image = $request->file('banner');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $categoryphotoPath = public_path('uploads/flashdeal_photo');

            $categoryphoto_path = public_path('uploads/flashdeal_photo/'.$flash_deal->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }

            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $flash_deal->banner;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $flash_deal->update([
            'title' => $request->title,
            'slug' => $slug,
            'banner' => $imagename,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'background_color' => $request->background_color,
            'text_color' => $request->text_color,
            'status' => $status,
        ]);

        $flash_deal->products()->sync($request->products);

        foreach ($request->products as $key => $product) {
        $root_product = Product::findOrFail($product);
        $root_product->discount_rate = $request['discount_'.$product];
        $root_product->discount_type = $request['discount_type_'.$product];
        $root_product->discount_startdate = $request->start_date;
        $root_product->discount_enddate   = $request->end_date;
        $root_product->save();
        }

        notify()->success("Flash-Deals Successfully Updated","Update");
        return redirect()->route('admin.flash-deals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\Flashdeal  $flashdeal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flashdeal = Flashdeal::find($id);

        $categoryphoto_path = public_path('uploads/flashdeal_photo/'.$flashdeal->image);  // Value is not URL but directory file path
            if (file_exists($categoryphoto_path)) {

                @unlink($categoryphoto_path);

            }
            $flashdeal->products()->detach();
            $flashdeal->delete();
            notify()->success('Flas-Deals Deleted Successfully','Delete');

        return back();
    }
}
