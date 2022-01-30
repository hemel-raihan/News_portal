<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Models\Product\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.product.attributes.self');
        $attributes = Attribute::all();
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.product.attribute.index',compact('attributes','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.product.attributes.create');
        return view('backend.admin.product.attribute.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.product.attributes.create');
        $this->validate($request,[
            'name' => 'required|unique:attributes',

        ]);



        $attribute = Attribute::create([
            'name' => $request->name,

        ]);

        notify()->success("Attribute Successfully created","Added");
        return redirect()->route('admin.attributes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        Gate::authorize('app.product.attributes.edit');
        return view('backend.admin.product.attribute.form',compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        Gate::authorize('app.product.attributes.edit');
        $this->validate($request,[
            'name' => 'required',

        ]);



        $attribute->update([
            'name' => $request->name,
        ]);

        notify()->success("Attribute Successfully Updated","Update");
        return redirect()->route('admin.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        Gate::authorize('app.product.attributes.destroy');


            $attribute->delete();
            notify()->success('Attribute Deleted Successfully','Delete');

        return back();
    }
}
