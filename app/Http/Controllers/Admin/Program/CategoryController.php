<?php

namespace App\Http\Controllers\Admin\Program;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Program\Programcategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Programcategory::all();
        return view('backend.admin.program.category.form',compact('categories'));
    }

    public function fetchcategory()
    {
        $categories = Programcategory::all();
        return response()->json([
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.program.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:programcategories',
        ]);
        $slug = Str::slug($request->name);


        $category = Programcategory::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        // notify()->success("Tax Successfully created","Added");
        // return redirect()->route('admin.taxes.index');
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }


    public function status($id)
    {
        $category = Programcategory::find($id);
        if($category->status == true)
        {
            $category->status = false;
            $category->save();

            notify()->success('Successfully Deactiveated Post');
        }
        elseif($category->status == false)
        {
            $category->status = true;
            $category->save();

            notify()->success('Removed the Activeated Approval');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program\Programcategory  $programcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Programcategory $programcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program\Programcategory  $programcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Programcategory $programcategory)
    {
        $programcategoryy = Programcategory::find($programcategory);
        if($programcategoryy)
        {
            return response()->json(
                [
                    'status' => 200,
                    'programcategory' => $programcategoryy,
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Category Not Found'
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program\Programcategory  $programcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programcategory $programcategory)
    {
        $category = Programcategory::find($request->id);
        $slug = Str::slug($request->name);
        $category->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Data Updated successfully'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program\Programcategory  $programcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programcategory $programcategory)
    {
        $programcategory->delete();
        notify()->success('Category Deleted Successfully','Delete');
        return back();
    }
}
