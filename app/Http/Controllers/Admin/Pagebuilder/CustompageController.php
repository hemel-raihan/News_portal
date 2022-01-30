<?php

namespace App\Http\Controllers\Admin\Pagebuilder;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Models\Pagebuilder\Custompage;

class CustompageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.custom.pages.self');
        $pages = Custompage::all();
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.pagebuilder.index',compact('auth','pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.custom.pages.create');
        $sidebars = Sidebar::all();
        return view('backend.admin.pagebuilder.form',compact('sidebars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.custom.pages.create');
        $this->validate($request,[
            'name' => 'required|unique:custompages',
            'background_img' => 'max:1024',
            'type' => 'required',
            'container' => 'required',
            'leftsidebar_id' => 'required',
            'rightsidebar_id' => 'required',
        ]);

        $image = $request->file('background_img');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/custompagephoto');
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

        if(!$request->transparent)
        {
            $transparent = 0;
        }
        else
        {
            $transparent = 1;
        }

        if(!$request->background_img)
        {
            $background_img = null;
        }
        else
        {
            $background_img = $imagename;
        }

        if(!$request->background_color)
        {
            $background_color = null;
        }
        else
        {
            $background_color = $request->background_color;
        }


        $custompage = Custompage::create([
            'name' => $request->name,
            'slug' => $slug,
            'type' => $request->type,
            'status' => $status,
            'transparent' => $transparent,
            'background_img' => $background_img,
            'background_color' => $background_color,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'container' => $request->container,
        ]);


        notify()->success("Page Successfully created","Added");
        return redirect()->route('admin.custompages.index');
    }


    public function status_approval($id)
    {
        Gate::authorize('app.custom.pages.status');
        $page = Custompage::find($id);

        $mainpage = Custompage::where('type','=','Main-Page')->get();
            foreach($mainpage as $mmenu)
            {
                if($mmenu->id != $id)
                {
                    $mmenu->status = false;
                    $mmenu->save();

                }
                else
                {
                    $mmenu->status = true;
                    $mmenu->save();
                }
            }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagebuilder\Custompage  $custompage
     * @return \Illuminate\Http\Response
     */
    public function show(Custompage $custompage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pagebuilder\Custompage  $custompage
     * @return \Illuminate\Http\Response
     */
    public function edit(Custompage $custompage)
    {
        Gate::authorize('app.custom.pages.edit');
        $editsidebars = Sidebar::all();
        return view('backend.admin.pagebuilder.form',compact('custompage','editsidebars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagebuilder\Custompage  $custompage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Custompage $custompage)
    {
        Gate::authorize('app.custom.pages.edit');
        $this->validate($request,[
            'name' => 'required',
            'background_img' => 'max:1024',
            'type' => 'required',
            'container' => 'required',
            'leftsidebar_id' => 'required',
            'rightsidebar_id' => 'required',
        ]);

        $image = $request->file('background_img');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/custompagephoto');

            $postphoto_path = public_path('uploads/custompagephoto/'.$custompage->background_img);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

           $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $custompage->background_img;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        if(!$request->transparent)
        {
            $transparent = 0;
        }
        else
        {
            $transparent = 1;
        }

        if(!$request->background_img)
        {
            $background_img = null;
        }
        else
        {
            $background_img = $imagename;
        }

        if(!$request->background_color)
        {
            $background_color = null;
        }
        else
        {
            $background_color = $request->background_color;
        }

        $custompage->update([
            'name' => $request->name,
            'slug' => $slug,
            'type' => $request->type,
            'status' => $status,
            'transparent' => $transparent,
            'background_img' => $background_img,
            'background_color' => $background_color,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'container' => $request->container,
        ]);


        notify()->success("Page Successfully Updated","Update");
        return redirect()->route('admin.custompages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pagebuilder\Custompage  $custompage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Custompage $custompage)
    {
        Gate::authorize('app.custom.pages.destroy');

        $postphoto_path = public_path('uploads/custompagephoto/'.$custompage->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

        $custompage->delete();
        notify()->success("Page Delete Succefully");
        return back();
    }
}
