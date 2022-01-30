<?php

namespace App\Http\Controllers\Admin\frontmenu;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Frontmenu\Frontmenu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.front.menus.self');
        $menus = Frontmenu::all();
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.frontmenu.index',compact('menus','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.front.menus.create');
        return view('backend.admin.frontmenu.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.front.menus.create');
        $this->validate($request,[
            'title' => 'required',
        ]);

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }


        $menu = Frontmenu::create([
            'title' => Str::slug($request->title),
            'type' => $request->type,
            'status' => $status,
        ]);


        notify()->success("Menu Successfully created","Added");
        return redirect()->route('admin.frontmenus.index');
    }

    public function status_approval($id)
    {
        Gate::authorize('app.front.menus.status');
        $menu = Frontmenu::find($id);

        $mainmenu = Frontmenu::where('type','=','main-menu')->get();
            foreach($mainmenu as $mmenu)
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
     * @param  \App\Models\Frontmenu\Frontmenu  $frontmenu
     * @return \Illuminate\Http\Response
     */
    public function show(Frontmenu $frontmenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frontmenu\Frontmenu  $frontmenu
     * @return \Illuminate\Http\Response
     */
    public function edit(Frontmenu $frontmenu)
    {
        Gate::authorize('app.front.menus.edit');
        return view('backend.admin.frontmenu.form',compact('frontmenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frontmenu\Frontmenu  $frontmenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frontmenu $frontmenu)
    {
        Gate::authorize('app.front.menus.edit');
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

        $frontmenu->update([
            'title' => Str::slug($request->title),
            'type' => $request->type,
            'status' => $status,
        ]);


        notify()->success("Menu Successfully Updated","Update");
        return redirect()->route('admin.frontmenus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frontmenu\Frontmenu  $frontmenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frontmenu $frontmenu)
    {
        Gate::authorize('app.front.menus.destroy');
        $frontmenu->delete();
        notify()->success("Menu Delete Succefully");
        return back();
    }
}
