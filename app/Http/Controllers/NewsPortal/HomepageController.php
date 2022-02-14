<?php

namespace App\Http\Controllers\NewsPortal;

use Carbon\Carbon;
use App\Models\blog\Post;
use Illuminate\Http\Request;
use App\Models\blog\category;
use App\Models\Program\Program;
use App\Http\Controllers\Controller;
use App\Models\Frontmenu\Frontmenuitem;
use App\Models\Program\Programcategory;

class HomepageController extends Controller
{
    public function index(){

        return view('frontend_theme.news_portal.homepage');

    }

    public function categories($slug,Request $request)
    {
        $menuitem = Frontmenuitem::where('slug',$slug)->firstOrFail();
        $blogcategory = category::all();
        $blogcategoryid = $menuitem->blogcategory_id;
        foreach($blogcategory  as $blogcat)
        {
            if($blogcat->id == $blogcategoryid)
            {
                if($request->ajax())
                {
                    $single_category = category::find($blogcategoryid);
                    $view = view('frontend_theme.news_portal.loadmore_data',compact('single_category'))->render();
                    return response()->json(['html'=>$view]);
                }
                $single_category = category::find($blogcategoryid);
                $newses = $single_category->posts()->get();
                return view('frontend_theme.news_portal.categorypage',compact('newses','single_category'));

            }
        }


    }

    public function categories_all($slug)
    {
        $single_category = category::where('slug',$slug)->first();
        // $view = view('frontend_theme.news_portal.loadmore_data',compact('single_category'))->render();
        // return response()->json(['html'=>$view]);
        $newses = $single_category->posts()->get();
        return view('frontend_theme.news_portal.categorypage',compact('newses','single_category'));
    }

    public function fetchnews($id)
    {
        $data = [];
        $category = category::find($id);
        $catpost = $category->childrenRecursive()->get();
        foreach($catpost as $cat)
        {
            $news = $cat->posts;
            $data[] = $news;
            // $decode = json_encode($data);
        }
        return array(
            'news' => view('frontend_theme.news_portal.newsdata',compact('data'))->render()
        );
        // return response()->json([
        //     'news' => $data,
        // ]);
        // foreach($category->childrenRecursive as $key => $subcat)
        // {
        //     foreach ($subcat->posts as $news)
        //     {
        //         return response()->json([
        //             'news' => $news,
        //         ]);
        //     }
        // }


    }

    public function news_details($slug)
    {
        $news = Post::where('slug',$slug)->first();
        foreach ($news->categories as $category)
        {
            $category_id = $category->parent;
        }
        return view('frontend_theme.news_portal.news_details',compact('news','category_id'));
    }

    public function video_gallary()
    {
        $categories = Programcategory::all();
        $today = date("Y/m/d h:i a");
        $to_day=date("Y-m-d h:i a",strtotime($today));
        $programs = Program::where('end_datetime','<',$to_day)->get();
        return view('frontend_theme.news_portal.video_gallary',compact('categories','programs'));
    }


    public function video()
    {
        $date = date("Y/m/d");
        $only_date=date("Y-m-d",strtotime($date));
        $today = date("Y/m/d h:i a");
        $to_day=date("Y-m-d h:i a",strtotime($today));
        $mytime = Carbon::now();
        $start = Carbon::parse($mytime)->format('h:i a');
        //  $programs = Program::where([['start_date','<=', $to_day],['end_date','>=', $to_day],['start_time','<=', $start],['end_time','<=', $start]])->pluck('video');
        // $programs = Program::where([['start_date','<=', $to_day],['start_time','<=', $start]])->where([['end_date','>=', $to_day],['end_time','>=', $start]])->pluck('video');

        $prog_video = Program::where([['start_date','<=', $only_date],['end_date','>=', $only_date]])->get();
        $program_start = Program::where([['start_datetime','<=', $to_day],['end_datetime','>=', $to_day]])->pluck('start_datetime');
        $program_end = Program::where([['start_datetime','<=', $to_day],['end_datetime','>=', $to_day]])->pluck('end_datetime');
        //$test = Program::where([['start_datetime','<=', $to_day],['end_datetime','>=', $to_day]])->pluck('video');
        $programs = Program::where([['start_datetime','<=', $to_day],['end_datetime','>=', $to_day]])->pluck('video');
        $embed_video = Program::where([['start_datetime','<=', $to_day],['end_datetime','>=', $to_day]])->where('embed_code','!=',null)->pluck('embed_code');
        return response()->json([
            'programs' => $programs,
            'prog_video' => $prog_video,
            'embed_video' => $embed_video,
            //'test' => $test,
            'program_start' => $program_start,
            'program_end' => $program_end,
        ]);


    }
}
