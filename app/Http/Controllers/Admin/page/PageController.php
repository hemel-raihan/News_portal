<?php

namespace App\Http\Controllers\Admin\page;

use Carbon\Carbon;
use App\Models\Admin\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.pages.self');
        //$posts = Auth::guard('admin')->user()->posts()->latest()->get();
        $auth = Auth::guard('admin')->user();
        $pages = Page::latest()->get();
        Artisan::call('cache:clear');
        return view('backend.admin.page.index',compact('pages','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.pages.create');
        $sidebars = Sidebar::all();
        Artisan::call('cache:clear');
        return view('backend.admin.page.form',compact('sidebars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.pages.create');
        $this->validate($request,[
            'title' => 'required',
            'image' => 'max:1024',
            'gallaryimage.*' => 'max:1024',
            'leftsidebar_id' => 'required',
            'rightsidebar_id' => 'required',
        ]);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);
            
        if(isset($image))
        {
           $image = $request->file('image');
          $currentDate = Carbon::now()->toDateString();
          $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $pagePath = public_path('uploads/pagephoto');
            Image::make($image)->resize(300, 200)->save($pagePath.'/'.$imagename);

           // $img->resize(900, 600)->save($pagePath.'/'.$imagename);

        }
        else
        {
            $imagename = null;
        }


          //get form Gallary image
         $gallaryimage = $request->file('gallaryimage');
         $images=array();
         $destination = public_path('uploads/pagegallary_image');

         if(isset($gallaryimage))
         {
             foreach($gallaryimage as $gimage)
             {
                $gallaryimagename = $slug.'-'.'-'.uniqid().'.'.$gimage->getClientOriginalExtension();
                //$gimg = Image::make($gimage)->resize(900,600)->save($gallaryimagename,90);
                $gimg                     =       Image::make($gimage->path());
                $gimg->resize(900, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$gallaryimagename);
                //$gimage->move($destination,$gallaryimagename);
                //Storage::disk('public')->put('pagegallary_image/'.$gallaryimagename,$gimg);
                $images[]=$gallaryimagename;
             }

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


        $page = Page::create([
            'title' => $request->title,
            'slug' => $slug,
            'admin_id' => Auth::id(),
            'image' => $imagename,
            'gallaryimage'=>  implode("|",$images),
            //'files' => $filename,
            'body' => $request->body,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,

        ]);

        Artisan::call('cache:clear');

        notify()->success("Page Successfully created","Added");
        return redirect()->route('admin.pages.index');
    }


    public function status_approval($id)
    {
        Gate::authorize('app.pages.status');
        $page = Page::find($id);
        if($page->status == true)
        {
            $page->status = false;
            $page->save();

            notify()->success('Successfully Deactiveated Post');
        }
        elseif($page->status == false)
        {
            $page->status = true;
            $page->save();

            notify()->success('Removed the Activeated Approval');
        }

        Artisan::call('cache:clear');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        Gate::authorize('app.pages.edit');
        $editsidebars = Sidebar::all();
        Artisan::call('cache:clear');
        return view('backend.admin.page.form',compact('page','editsidebars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        Gate::authorize('app.pages.edit');
        $this->validate($request,[
            'title' => 'required',
            'image' => 'max:1024',
            'gallaryimage.*' => 'max:1024',
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


            $pagePath = public_path('uploads/pagephoto');

            $pagephoto_path = public_path('uploads/pagephoto/'.$page->image);  // Value is not URL but directory file path
            if (file_exists($pagephoto_path)) {

                @unlink($pagephoto_path);

            }

            $img                     =       Image::make($image->path());

            $img->resize(900, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($pagePath.'/'.$imagename);

            // $image->move($pagePath,$imagename);

        }
        else
        {
            $imagename = $page->image;
        }

        //get form Gallary image
        $gallaryimage = $request->file('gallaryimage');
        $images=array();
        $destination = public_path('uploads/pagegallary_image');
        $updateimages = explode("|", $page->gallaryimage);

        if(isset($gallaryimage))
        {

            foreach($updateimages as $updateimage){

                $gallary_path = public_path('uploads/pagegallary_image/'.$updateimage);

                if (file_exists($gallary_path)) {

                    @unlink($gallary_path);

                }
            }

            foreach($gallaryimage as $gimage)
            {

               $gallaryimagename = $slug.'-'.'-'.uniqid().'.'.$gimage->getClientOriginalExtension();
               //$gimage->move($destination,$gallaryimagename);
               $gimg                     =       Image::make($gimage->path());
                $gimg->resize(900, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$gallaryimagename);
               $images[]=$gallaryimagename;
            }

        }
        else
        {
            $images[]=$page->gallaryimage;
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

        $page->update([
            'title' => $request->title,
            'slug' => $slug,
            'admin_id' => Auth::id(),
            'image' => $imagename,
            'gallaryimage'=>  implode("|",$images),
            'body' => $request->body,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,

        ]);
        
        Artisan::call('cache:clear');


        notify()->success("Page Successfully Updated","Update");
        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        Gate::authorize('app.pages.destroy');
        //delete old image
        // if(Storage::disk('public')->exists('pagephoto/'.$page->image))
        // {
        //     Storage::disk('public')->delete('pagephoto/'.$page->image);
        // }

        $pagephoto_path = public_path('uploads/pagephoto/'.$page->image);  // Value is not URL but directory file path
        if (file_exists($pagephoto_path)) {

            @unlink($pagephoto_path);

        }

    $gallaryimages = explode("|", $page->gallaryimage);

    foreach($gallaryimages as $gimage){

        $gallaryimage_path = public_path('uploads/pagegallary_image/'.$gimage);

        if (file_exists($gallaryimage_path)) {

            @unlink($gallaryimage_path);

        }

    }
    Artisan::call('cache:clear');

        $page->delete();
        notify()->success('Page Deleted Successfully','Delete');
        return back();
    }
}
