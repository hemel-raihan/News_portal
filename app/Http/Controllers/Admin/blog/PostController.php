<?php

namespace App\Http\Controllers\Admin\blog;

use Carbon\Carbon;
use App\Models\blog\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Models\blog\category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.blog.posts.self');
        //$posts = Auth::guard('admin')->user()->posts()->latest()->get();
        $auth = Auth::guard('admin')->user();
        $posts = Post::latest()->get();
        return view('backend.admin.blog.post.index',compact('posts','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.blog.posts.create');
        $categories = category::where('parent_id', '=', 0)->get();
        $subcat = category::all();
        $sidebars = Sidebar::all();
        return view('backend.admin.blog.post.form',compact('categories','subcat','sidebars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.blog.posts.create');
            $this->validate($request,[
                'title' => 'required|unique:posts',
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

            $postphotoPath = public_path('uploads/postphoto');
            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }


         //get form Gallary image
         $gallaryimage = $request->file('gallaryimage');
         $images=array();
         $destination = public_path('uploads/gallary_image');

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
         else
         {
            $images[] = null;
         }

        //get form file
        $file = $request->file('files');

        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/files');

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



        $post = Post::create([
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
        $post->categories()->attach($request->categories);


        notify()->success("Post Successfully created","Added");
        return redirect()->route('admin.posts.index');
    }

    public function status_approval($id)
    {
        Gate::authorize('app.blog.posts.status');
        $post = Post::find($id);
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

    public function scroll_approval($id)
    {
        Gate::authorize('app.blog.posts.status');
        $post = Post::find($id);
        if($post->scrollable == true)
        {
            $post->scrollable = false;
            $post->save();

            notify()->success('Successfully Deactiveated');
        }
        elseif($post->scrollable == false)
        {
            $post->scrollable = true;
            $post->save();

            notify()->success('Successfully Activeated');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        Gate::authorize('app.blog.posts.details');
        return view('backend.admin.blog.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('app.blog.posts.edit');
        $categories = category::where('parent_id', '=', 0)->get();
        $subcat = category::all();
        $editsidebars = Sidebar::all();
        return view('backend.admin.blog.post.form',compact('post','categories','subcat','editsidebars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('app.blog.posts.edit');
        $this->validate($request,[
            'title' => 'required',
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

            $postphotoPath = public_path('uploads/postphoto');

            $postphoto_path = public_path('uploads/postphoto/'.$post->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

           $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $post->image;
        }

        //get form Gallary image
        $gallaryimage = $request->file('gallaryimage');
        $images=array();
        $destination = public_path('uploads/gallary_image');
        $updateimages = explode("|", $post->gallaryimage);


        if(isset($gallaryimage))
        {
            foreach($updateimages as $updateimage){

                $gallary_path = public_path('uploads/gallary_image/'.$updateimage);

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
            $images[]=$post->gallaryimage;
        }

        //get form file
        $file = $request->file('files');

        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/files');


            $file_path = public_path('uploads/files/'.$post->files);  // Value is not URL but directory file path
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
            $filename = $post->files;
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



        // if($request->image)
        // {
        //     $imagename = $imagename;
        //     $youtube = null;
        // }
        // elseif(!$request->image)
        // {
        //     $imagename = null;
        //     $youtube = $request->youtube_link;
        // }
        // elseif($request->youtube_link)
        // {
        //     $imagename = null;
        //     $youtube = $request->youtube_link;
        // }

        $post->update([
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
        $post->categories()->sync($request->categories);


        notify()->success("Post Successfully Updated","Update");
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Gate::authorize('app.blog.posts.destroy');
        // //delete old image
        // if(Storage::disk('public')->exists('postphoto/'.$post->image))
        // {
        //     Storage::disk('public')->delete('postphoto/'.$post->image);
        // }

        $postphoto_path = public_path('uploads/postphoto/'.$post->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

        $gallaryimages = explode("|", $post->gallaryimage);

        foreach($gallaryimages as $gimage){

            $gallaryimage_path = public_path('uploads/gallary_image/'.$gimage);

            if (file_exists($gallaryimage_path)) {

                @unlink($gallaryimage_path);

            }

        }

        $postfile_path = public_path('uploads/files/'.$post->files);  // Value is not URL but directory file path
            if (file_exists($postfile_path)) {

                @unlink($postfile_path);

            }

        $post->categories()->detach();

        $post->delete();
        notify()->success('Post Deleted Successfully','Delete');
        return back();

    }
}
