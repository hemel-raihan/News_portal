<?php

namespace App\Http\Controllers\Admin\Portfolio;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Models\Portfolio\Portfolio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Models\Portfolio\Portfoliocategory;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.portfolio.posts.self');
        $auth = Auth::guard('admin')->user();
        $posts = Portfolio::latest()->get();
        return view('backend.admin.portfolio.post.index',compact('posts','auth'));
    }

    public function fetchportfolios()
    {
        $portfolios = Portfolio::all();
        return response()->json([
            'portfolios' => $portfolios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.portfolio.posts.create');
        $categories = Portfoliocategory::where('parent_id', '=', 0)->get();
        $subcat = Portfoliocategory::all();
        $sidebars = Sidebar::all();
        return view('backend.admin.portfolio.post.form',compact('categories','subcat','sidebars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.portfolio.posts.create');
        $this->validate($request,[
            'title' => 'required|unique:portfolios',
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

        $postphotoPath = public_path('uploads/portfoliophoto');
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
    $destination = public_path('uploads/portfoliogallary_image');

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
       $destinationPath = public_path('uploads/portfoliofiles');

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



    $portfolio = Portfolio::create([
        'title' => $request->title,
        'slug' => $slug,
        'admin_id' => Auth::id(),
        'image' => $imagename,
        'gallaryimage'=>  implode("|",$images),
        'files' => $filename,
        'body' => $request->body,
        'leftsidebar_id' => $request->leftsidebar_id,
        'rightsidebar_id' => $request->rightsidebar_id,
        'status' => $status,
        'is_approved' => $is_approved,
        'meta_title' => $request->meta_title,
        'meta_desc' => $request->meta_desc,

    ]);

    //for many to many
    $portfolio->portfoliocategories()->attach($request->categories);


    notify()->success("Portfolio Successfully created","Added");
    return redirect()->route('admin.portfolios.index');
    }

    public function status($id)
    {
        Gate::authorize('app.portfolio.posts.status');
        $post = Portfolio::find($id);
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
     * @param  \App\Models\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        Gate::authorize('app.portfolio.posts.edit');
        $categories = Portfoliocategory::where('parent_id', '=', 0)->get();
        $subcat = Portfoliocategory::all();
        $editsidebars = Sidebar::all();
        return view('backend.admin.portfolio.post.form',compact('portfolio','categories','subcat','editsidebars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        Gate::authorize('app.portfolio.posts.edit');
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

            $postphotoPath = public_path('uploads/portfoliophoto');

            $postphoto_path = public_path('uploads/portfoliophoto/'.$portfolio->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

           $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $portfolio->image;
        }


        //get form Gallary image
        $gallaryimage = $request->file('gallaryimage');
        $images=array();
        $destination = public_path('uploads/portfoliogallary_image');
        $updateimages = explode("|", $portfolio->gallaryimage);


        if(isset($gallaryimage))
        {
            foreach($updateimages as $updateimage){

                $gallary_path = public_path('uploads/portfoliogallary_image/'.$updateimage);

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
            $images[]=$portfolio->gallaryimage;
        }

        //get form file
        $file = $request->file('files');

        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/portfoliofiles');


            $file_path = public_path('uploads/portfoliofiles/'.$portfolio->files);  // Value is not URL but directory file path
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
            $filename = $portfolio->files;
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


        $portfolio->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'admin_id' => Auth::id(),
            'image' => $imagename,
            'body' => $request->body,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
        ]);

        //for many to many
        $portfolio->portfoliocategories()->sync($request->categories);


        notify()->success("Portfolio Successfully Updated","Update");
        return redirect()->route('admin.portfolios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        Gate::authorize('app.portfolio.posts.destroy');

        $postphoto_path = public_path('uploads/portfoliophoto/'.$portfolio->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

            $gallaryimages = explode("|", $portfolio->gallaryimage);

            foreach($gallaryimages as $gimage){

                $gallaryimage_path = public_path('uploads/portfoliogallary_image/'.$gimage);

                if (file_exists($gallaryimage_path)) {

                    @unlink($gallaryimage_path);

                }

            }

            $postfile_path = public_path('uploads/portfoliofiles/'.$portfolio->files);  // Value is not URL but directory file path
                if (file_exists($postfile_path)) {

                    @unlink($postfile_path);

                }

        $portfolio->portfoliocategories()->detach();

        $portfolio->delete();
        notify()->success('Portfolio Deleted Successfully','Delete');
        return back();
    }
}
