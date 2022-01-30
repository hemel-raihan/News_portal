<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::paginate(10);
        return view('backend.admin.product.color.index',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.product.color.form');
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
            'name' => 'required|unique:colors',
            'code' => 'required|unique:colors',

        ]);

        $color = new Color;
        $color->name = $request->name;
        $color->code = $request->code;
        $color->save();

        notify()->success("Color Successfully created","Added");
        return redirect()->route('admin.colors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('backend.admin.product.color.form',compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $this->validate($request,[
            'name' => 'required',
            'code' => 'required',

        ]);

        $color->update([
            'name' => $request->name,
            'desc' => $request->color,
        ]);

        notify()->success("Color Successfully Updated","Update");
        return redirect()->route('admin.colors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {

            $color->delete();
            notify()->success('Color Deleted Successfully','Delete');

        return back();
    }
}
