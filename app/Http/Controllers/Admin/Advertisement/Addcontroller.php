<?php

namespace App\Http\Controllers\Admin\Advertisement;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Models\Advertisement\Advertisement;

class Addcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = Advertisement::paginate(10);
        return view('backend.admin.advertisement.index',compact('advertisements'));
    }

    public function fetchadd()
    {
        $advertisements = Advertisement::all();
        return response()->json([
            'advertisements' => $advertisements,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.advertisement.form');
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
            'title' => 'required|unique:advertisements',
            'banner' => 'mimes:png,jpg,jpeg,bmp|max:1024',
            'position' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        //get form image
        $image = $request->file('banner');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

             $addphotoPath = public_path('uploads/advertisement');
            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($addphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename =null;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $advertisement = Advertisement::create([
            'title' => $request->title,
            'url' => $request->url,
            'banner' => $imagename,
            'text_add' => $request->test_add,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $status,

        ]);

        notify()->success("Advertisement Successfully created","Added");
        return redirect()->route('admin.advertisements.index');
    }

    public function status($id)
    {
        $advertisement = Advertisement::find($id);
        if($advertisement->status == true)
        {
            $advertisement->status = false;
            $advertisement->save();

            return response()->json(
                [
                    'status' => 200,
                    'advertisement' => $advertisement,
                ]
            );
        }
        elseif($advertisement->status == false)
        {
            $advertisement->status = true;
            $advertisement->save();

            return response()->json(
                [
                    'status' => 200,
                    'advertisement' => $advertisement,
                ]
            );
        }

        //return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        return view('backend.admin.advertisement.form',compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        $this->validate($request,[
            'title' => 'required',
            'banner' => 'mimes:png,jpg,jpeg,bmp|max:1024',
            'position' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        //get form image
        $image = $request->file('banner');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $addphotoPath = public_path('uploads/advertisement');

            $addphoto_path = public_path('uploads/advertisement/'.$advertisement->banner);  // Value is not URL but directory file path
            if (file_exists($addphoto_path)) {

                @unlink($addphoto_path);

            }
            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($addphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $advertisement->banner;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $advertisement->update([
            'title' => $request->title,
            'url' => $request->url,
            'banner' => $imagename,
            'text_add' => $request->test_add,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $status,

        ]);

        notify()->success("Advertisement Successfully Updated","Update");
        return redirect()->route('admin.advertisements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        notify()->success('advertisement Deleted Successfully','Delete');
        return back();
    }
}
