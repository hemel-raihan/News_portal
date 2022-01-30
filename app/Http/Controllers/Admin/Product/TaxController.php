<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product\Tax;
use Illuminate\Http\Request;
use App\Models\Portfolio\Portfolio;
use App\Http\Controllers\Controller;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Tax::all();
        return view('backend.admin.product.tax.form',compact('taxes'));
    }

    public function fetchtax()
    {
        $taxes = Tax::all();
        return response()->json([
            'taxes' => $taxes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.product.tax.form');
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
            'name' => 'required|unique:taxes',
        ]);



        $tax = Tax::create([
            'name' => $request->name,
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
        $tax = Tax::find($id);
        if($tax->status == true)
        {
            $tax->status = false;
            $tax->save();

            notify()->success('Successfully Deactiveated Post');
        }
        elseif($tax->status == false)
        {
            $tax->status = true;
            $tax->save();

            notify()->success('Removed the Activeated Approval');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        $taxx = Tax::find($tax);
        if($taxx)
        {
            return response()->json(
                [
                    'status' => 200,
                    'tax' => $taxx,
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Tax Not Found'
                ]
            );
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tax $tax)
    {
        // $this->validate($request,[
        //     'name' => 'required',
        // ]);


        $taxx = Tax::find($request->id);
        $taxx->update([
            'name' => $request->name,
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
     * @param  \App\Models\Product\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();
        notify()->success('Tax Deleted Successfully','Delete');
        return back();
    }
}
