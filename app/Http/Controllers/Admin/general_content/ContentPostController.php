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
use App\Models\general_content\Contentpost;
use App\Models\general_content\Contentcategory;

class ContentPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.content.posts.self');
        //$posts = Auth::guard('admin')->user()->posts()->latest()->get();
        $auth = Auth::guard('admin')->user();
        $posts = Contentpost::latest()->get();
        return view('backend.admin.general_content.post.index',compact('posts','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.content.posts.create');
        $categories = Contentcategory::where('parent_id', '=', 0)->get();
        $subcat = Contentcategory::all();
        $sidebars = Sidebar::all();
        return view('backend.admin.general_content.post.form',compact('categories','subcat','sidebars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.content.posts.create');
        $this->validate($request,[
            'title' => 'required|unique:contentposts',
            'image' => 'max:1024',
            'gallaryimage.*' => 'max:1024',
            'files' => 'mimes:pdf,doc,docx',
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

            $postphotoPath = public_path('uploads/contentpostphoto');
            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = null;
        }


         //get form Gallary image
         $gallaryimage = $request->file('gallaryimage');
         $images=array();
         $destination = public_path('uploads/Contentgallary_image');

         if(isset($gallaryimage))
         {
             foreach($gallaryimage as $gimage)
             {
                $gallaryimagename = $slug.'-'.'-'.uniqid().'.'.$gimage->getClientOriginalExtension();
                $gimg                     =       Image::make($gimage->path());
                $gimg->resize(900, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$gallaryimagename);
                $images[]=$gallaryimagename;
             }

         }

        //get form file
        $file = $request->file('files');

        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/contentfiles');

            // //check image folder existance
            // if(!Storage::disk('public')->exists('postfile'))
            // {
            //     Storage::disk('public')->makeDirectory('postfile');
            // }
            $file->move($destinationPath,$filename);

            // //resize image
            // $postfile = Image::make($file)->save($filename);
            // Storage::disk('public')->put('categoryphoto/'.$filename,$postfile);

        }
        else
        {
            $filename = null;
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

        if(!$request->youtube_link)
        {
            $youtube = null;
        }
        else
        {
            $youtube = $request->youtube_link;
        }

        if(!$request->image)
        {
            $featureimg = null;
        }
        else
        {
            $featureimg = $imagename;
        }

        $post = Contentpost::create([
            'title' => $request->title,
            'slug' => $slug,
            'admin_id' => Auth::id(),
            'image' => $featureimg,
            'youtube_link' => $youtube,
            'gallaryimage'=>  implode("|",$images),
            'files' => $filename,
            'body' => $request->body,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,

        ]);

        //for many to many
        $post->contentcategories()->attach($request->categories);


        notify()->success("Post Successfully created","Added");
        return redirect()->route('admin.contentposts.index');
    }

    public function status_approval($id)
    {
        Gate::authorize('app.content.posts.status');
        $post = Contentpost::find($id);
        if($post->status == true)
        {
            $post->status = false;
            $post->save();

            notify()->success('Successfully Deactivated Post');
        }
        elseif($post->status == false)
        {
            $post->status = true;
            $post->save();

            notify()->success('Removed the Activated Approval');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\general_content\Contentpost  $contentpost
     * @return \Illuminate\Http\Response
     */
    public function show(Contentpost $contentpost)
    {
        Gate::authorize('app.blog.posts.details');
        return view('backend.admin.general_content.post.show',compact('contentpost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\general_content\Contentpost  $contentpost
     * @return \Illuminate\Http\Response
     */
    public function edit(Contentpost $contentpost)
    {
        Gate::authorize('app.content.posts.edit');
        $categories = Contentcategory::where('parent_id', '=', 0)->get();
        $subcat = Contentcategory::all();
        $editsidebars = Sidebar::all();
        return view('backend.admin.general_content.post.form',compact('contentpost','categories','subcat','editsidebars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\general_content\Contentpost  $contentpost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contentpost $contentpost)
    {
        Gate::authorize('app.content.posts.edit');
        $this->validate($request,[
            'title' => 'required',
            'categories' => 'required',
            'image' => 'max:1024',
            'gallaryimage.*' => 'max:1024',
            'files' => 'mimes:pdf,doc,docx',
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

            $postphotoPath = public_path('uploads/contentpostphoto');

            $postphoto_path = public_path('uploads/contentpostphoto/'.$contentpost->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

             $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $contentpost->image;
        }

        //get form Gallary image
        $gallaryimage = $request->file('gallaryimage');
        $images=array();
        $destination = public_path('uploads/contentgallary_image');
        $updateimages = explode("|", $contentpost->gallaryimage);

        if(isset($gallaryimage))
        {

            foreach($updateimages as $updateimage){

                $gallary_path = public_path('uploads/contentgallary_image/'.$updateimage);

                if (file_exists($gallary_path)) {

                    @unlink($gallary_path);

                }
            }

            foreach($gallaryimage as $gimage)
            {

               $gallaryimagename = $slug.'-'.'-'.uniqid().'.'.$gimage->getClientOriginalExtension();
               $gimg                     =       Image::make($gimage->path());
                $gimg->resize(900, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$gallaryimagename);
               $images[]=$gallaryimagename;
            }

        }
        else
        {
            $images[]=$contentpost->gallaryimage;
        }

        //get form file
        $file = $request->file('files');

        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/contentfiles');


            $file_path = public_path('uploads/contentfiles/'.$contentpost->files);  // Value is not URL but directory file path
            if (file_exists($file_path)) {

                @unlink($file_path);

            }
            $file->move($destinationPath,$filename);

            // //resize image
            // $postfile = Image::make($file)->save($filename);
            // Storage::disk('public')->put('categoryphoto/'.$filename,$postfile);

        }
        else
        {
            $filename = $contentpost->files;
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

        // if(!$request->youtube_link)
        // {
        //     $youtube = null;
        // }
        // else
        // {
        //     $youtube = $request->youtube_link;
        // }

        // if(!$request->image)
        // {
        //     $featureimg = null;
        // }
        // else
        // {
        //     $featureimg = $imagename;
        // }

        $contentpost->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'admin_id' => Auth::id(),
            'image' => $imagename,
            'youtube_link' => $request->youtube_link,
            'gallaryimage'=>  implode("|",$images),
            'files' => $filename,
            'body' => $request->body,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,

        ]);

        //for many to many
        $contentpost->contentcategories()->sync($request->categories);


        notify()->success("Post Successfully Updated","Update");
        return redirect()->route('admin.contentposts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\general_content\Contentpost  $contentpost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contentpost $contentpost)
    {
        Gate::authorize('app.content.posts.destroy');
        //delete old image
        // if(Storage::disk('public')->exists('contentpostphoto/'.$contentpost->image))
        // {
        //     Storage::disk('public')->delete('contentpostphoto/'.$contentpost->image);
        // }

        $postphoto_path = public_path('uploads/contentpostphoto/'.$contentpost->image);  // Value is not URL but directory file path
        if (file_exists($postphoto_path)) {

            @unlink($postphoto_path);

        }

    $gallaryimages = explode("|", $contentpost->gallaryimage);

    foreach($gallaryimages as $gimage){

        $gallaryimage_path = public_path('uploads/Contentgallary_image/'.$gimage);

        if (file_exists($gallaryimage_path)) {

            @unlink($gallaryimage_path);

        }

    }

    $postfile_path = public_path('uploads/contentfiles/'.$contentpost->image);  // Value is not URL but directory file path
        if (file_exists($postfile_path)) {

            @unlink($postfile_path);

        }

        $contentpost->contentcategories()->detach();

        $contentpost->delete();
        notify()->success('Post Deleted Successfully','Delete');
        return back();
    }
}
