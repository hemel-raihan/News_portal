<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\blog\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Artisan::call('cache:clear');
        return view('backend.user.dashboard');
    }

    public function video()
    {
        return view('video');
    }

    public function video_upload(Request $request)
    {
        $file = $request->file('video');


        // $currentDate = Carbon::now()->toDateString();
        //     $videoname = $currentDate.'-'.uniqid().'.'.$video->getClientOriginalExtension();
            $file->move('uploads',$file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();

            $post = Post::create([
                'admin_id' => Auth::id(),
                'video' => $file_name,
                'video_name' => $file,
            ]);
            return back();
    }


}
