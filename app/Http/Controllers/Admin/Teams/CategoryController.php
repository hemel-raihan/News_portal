<?php

namespace App\Http\Controllers\Admin\Teams;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Teams\Teamcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.team.categories.self');
        $categories = Teamcategory::all();
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.team.category.index',compact('categories','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.team.categories.create');
        $categories = Teamcategory::where('parent_id', '=', 0)->get();
        $subcat = Teamcategory::all();
        return view('backend.admin.team.category.form',compact('categories','subcat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.team.categories.create');
        $this->validate($request,[
            'name' => 'required|unique:teamcategories',

        ]);



        if(!$request->parent_id)
        {
            $parent_id = 0;
        }
        else
        {
            $parent_id = $request->parent_id;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $slug = Str::slug('teams-'.$request->name);

        $category = Teamcategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'parent_id' => $parent_id,
            'status' => $status,

        ]);

        notify()->success("Category Successfully created","Added");
        return redirect()->route('admin.teamcategories.index');
    }


    public function approval($id)
    {
        Gate::authorize('app.team.categories.approve');
        $category = Teamcategory::find($id);
        if($category->status == true)
        {
            $category->status = false;
            $category->save();

            notify()->success('Successfully approved category');
        }
        elseif($category->status == false)
        {
            $category->status = true;
            $category->save();

            notify()->success('Removed the Category Approval');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teams\Teamcategory  $teamcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Teamcategory $teamcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teams\Teamcategory  $teamcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Teamcategory $teamcategory)
    {
        Gate::authorize('app.team.categories.edit');
        $categories = Teamcategory::where('parent_id', '=', 0)->get();
        $subcat = Teamcategory::all();
        return view('backend.admin.team.category.form',compact('teamcategory','categories','subcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teams\Teamcategory  $teamcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teamcategory $teamcategory)
    {
        Gate::authorize('app.team.categories.edit');
        $this->validate($request,[
            'name' => 'required',

        ]);
        $slug = Str::slug('teams-'.$request->name);

        if(!$request->parent_id)
        {
            $parent_id = 0;
        }
        else
        {
            $parent_id = $request->parent_id;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $teamcategory->update([
            'name' => $request->name,
            'slug' => $slug,
            'parent_id' => $parent_id,
            'status' => $status,

        ]);

        notify()->success("Category Successfully Updated","Update");
        return redirect()->route('admin.teamcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teams\Teamcategory  $teamcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teamcategory $teamcategory)
    {
        Gate::authorize('app.team.categories.destroy');

        if($teamcategory->childrenRecursive->count()>0)
        {
            notify()->error('You Can not Delete this Item !! Sub-category exist','Alert');
        }
        elseif($teamcategory->teamposts()->count() >0)
        {
            notify()->error('You Can not Delete this Item !! Post exist under this category','Alert');
        }
        else
        {
            $teamcategory->delete();
            notify()->success('Category Deleted Successfully','Delete');
        }


        return back();
    }
}
