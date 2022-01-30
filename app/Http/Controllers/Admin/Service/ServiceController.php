<?php

namespace App\Http\Controllers\Admin\Service;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Models\Service\Service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Models\Service\Servicecategory;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.service.posts.self');
        $auth = Auth::guard('admin')->user();
        $posts = Service::latest()->get();
        return view('backend.admin.service.post.index',compact('posts','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.service.posts.create');
        $categories = Servicecategory::where('parent_id', '=', 0)->get();
        $subcat = Servicecategory::all();
        $sidebars = Sidebar::all();
        return view('backend.admin.service.post.form',compact('categories','subcat','sidebars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.service.posts.create');
            $this->validate($request,[
                'title' => 'required|unique:services',
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

            $postphotoPath = public_path('uploads/servicephoto');
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



        $service = Service::create([
            'title' => $request->title,
            'slug' => $slug,
            'admin_id' => Auth::id(),
            'image' => $imagename,
            'body' => $request->body,
            'order' => $request->order,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,

        ]);

        //for many to many
        $service->servicecategories()->attach($request->categories);


        notify()->success("Service Successfully created","Added");
        return redirect()->route('admin.services.index');
    }


    public function status($id)
    {
        Gate::authorize('app.service.posts.status');
        $post = Service::find($id);
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
     * @param  \App\Models\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        Gate::authorize('app.service.posts.edit');
        $categories = Servicecategory::where('parent_id', '=', 0)->get();
        $subcat = Servicecategory::all();
        $editsidebars = Sidebar::all();
        return view('backend.admin.service.post.form',compact('service','categories','subcat','editsidebars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        Gate::authorize('app.service.posts.edit');
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

            $postphotoPath = public_path('uploads/servicephoto');

            $postphoto_path = public_path('uploads/servicephoto/'.$service->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

           $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $service->image;
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


        $service->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'admin_id' => Auth::id(),
            'image' => $imagename,
            'body' => $request->body,
            'order' => $request->order,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
        ]);

        //for many to many
        $service->servicecategories()->sync($request->categories);


        notify()->success("Service Successfully Updated","Update");
        return redirect()->route('admin.services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        Gate::authorize('app.service.posts.destroy');

        $postphoto_path = public_path('uploads/servicephoto/'.$service->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

        $service->servicecategories()->detach();

        $service->delete();
        notify()->success('Service Deleted Successfully','Delete');
        return back();
    }
}
