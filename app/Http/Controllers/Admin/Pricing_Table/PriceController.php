<?php

namespace App\Http\Controllers\Admin\Pricing_Table;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Models\Pricing_Table\Price;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Models\Pricing_Table\Pricecategory;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.price.posts.self');
        $auth = Auth::guard('admin')->user();
        $posts = Price::latest()->get();
        return view('backend.admin.pricing_table.post.index',compact('posts','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.price.posts.create');
        $categories = Pricecategory::where('parent_id', '=', 0)->get();
        $subcat = Pricecategory::all();
        $sidebars = Sidebar::all();
        return view('backend.admin.pricing_table.post.form',compact('categories','subcat','sidebars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.price.posts.create');
            $this->validate($request,[
                'title' => 'required|unique:prices',
                'image' => 'max:1024',
                'categories' => 'required',
                'leftsidebar_id' => 'required',
                'rightsidebar_id' => 'required',
            ]);


        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/pricephoto');
            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

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

        if(!Auth::guard('admin')->user()->role_id == 1)
        {
            $is_approved = false;
        }
        else
        {
            $is_approved = true;
        }



        $price = Price::create([
            'title' => $request->title,
            'slug' => $slug,
            'admin_id' => Auth::id(),
            'image' => $imagename,
            'body' => $request->body,
            'price' => $request->price,
            'duration' => $request->duration,
            'order' => $request->order,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,

        ]);

        //for many to many
        $price->pricecategories()->attach($request->categories);


        notify()->success("Price Successfully created","Added");
        return redirect()->route('admin.prices.index');
    }


    public function status($id)
    {
        Gate::authorize('app.price.posts.status');
        $post = Price::find($id);
        if($post->status == true)
        {
            $post->status = false;
            $post->save();

            notify()->success('Successfully Deactiveated Post');
        }
        elseif($post->status == false)
        {
            $post->status = true;
            $post->save();

            notify()->success('Removed the Activeated Approval');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pricing_Table\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pricing_Table\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        Gate::authorize('app.price.posts.edit');
        $categories = Pricecategory::where('parent_id', '=', 0)->get();
        $subcat = Pricecategory::all();
        $editsidebars = Sidebar::all();
        return view('backend.admin.pricing_table.post.form',compact('price','categories','subcat','editsidebars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pricing_Table\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        Gate::authorize('app.price.posts.edit');
        $this->validate($request,[
            'title' => 'required',
            'image' => 'max:1024',
            'categories' => 'required',
            'leftsidebar_id' => 'required',
            'rightsidebar_id' => 'required',
        ]);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/pricephoto');

            $postphoto_path = public_path('uploads/pricephoto/'.$price->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

           $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $price->image;
        }


        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        if(!Auth::guard('admin')->user()->role_id == 1)
        {
            $is_approved = false;
        }
        else
        {
            $is_approved = true;
        }


        $price->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'admin_id' => Auth::id(),
            'image' => $imagename,
            'body' => $request->body,
            'price' => $request->price,
            'duration' => $request->duration,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
        ]);

        //for many to many
        $price->pricecategories()->sync($request->categories);


        notify()->success("Price Successfully Updated","Update");
        return redirect()->route('admin.prices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pricing_Table\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        Gate::authorize('app.price.posts.destroy');

        $postphoto_path = public_path('uploads/pricephoto/'.$price->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

        $price->pricecategories()->detach();

        $price->delete();
        notify()->success('Price Deleted Successfully','Delete');
        return back();
    }
}
