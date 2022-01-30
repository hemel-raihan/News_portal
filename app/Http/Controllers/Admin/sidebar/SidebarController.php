<?php

namespace App\Http\Controllers\Admin\sidebar;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SidebarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.sidebars.self');
        $sidebars = Sidebar::all();
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.sidebar.index',compact('sidebars','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.sidebars.create');
        return view('backend.admin.sidebar.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.sidebars.create');
        $this->validate($request,[
            'title' => 'required',
            'type' => 'required',
        ]);

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }


        $sidebar = Sidebar::create([
            'title' => Str::slug($request->title),
            'type' => $request->type,
            'status' => $status,
        ]);


        notify()->success("Sidebar Successfully created","Added");
        return redirect()->route('admin.sidebars.index');
    }


    public function status_approval($id)
    {
        Gate::authorize('app.sidebars.status');
        $sidebar = Sidebar::find($id);
        if($sidebar->status == true)
        {
            $sidebar->status = false;
            $sidebar->save();

            notify()->success('Successfully Deactiveated Sidebar');
        }
        elseif($sidebar->status == false)
        {
            $sidebar->status = true;
            $sidebar->save();

            notify()->success('Successfully Activeated Sidebar');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function show(Sidebar $sidebar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function edit(Sidebar $sidebar)
    {
        Gate::authorize('app.sidebars.edit');
        return view('backend.admin.sidebar.form',compact('sidebar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sidebar $sidebar)
    {
        Gate::authorize('app.sidebars.edit');
        $this->validate($request,[
            'title' => 'required',
            'type' => 'required',
        ]);


        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $sidebar->update([
            'title' => Str::slug($request->title),
            'type' => $request->type,
            'status' => $status,
        ]);


        notify()->success("Sidebar Successfully Updated","Update");
        return redirect()->route('admin.sidebars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sidebar $sidebar)
    {
        Gate::authorize('app.sidebars.destroy');
        $sidebar->delete();
        notify()->success("Sidebar Delete Succefully");
        return back();
    }
}
