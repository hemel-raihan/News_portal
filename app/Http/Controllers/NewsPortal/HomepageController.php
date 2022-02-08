<?php

namespace App\Http\Controllers\NewsPortal;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\blog\category;
use App\Models\Program\Program;
use App\Http\Controllers\Controller;
use App\Models\Frontmenu\Frontmenuitem;

class HomepageController extends Controller
{
    public function index(){
        return view('frontend_theme.news_portal.homepage');
    }

    public function categories($slug)
    {
        $menuitem = Frontmenuitem::where('slug',$slug)->firstOrFail();
        $blogcategory = category::all();
        $blogcategoryid = $menuitem->blogcategory_id;
        foreach($blogcategory  as $blogcat)
        {
            if($blogcat->id == $blogcategoryid)
            {
                $category = category::where('id',$blogcategoryid)->first();
                $newses = $category->posts()->get();
                return view('frontend_theme.news_portal.categorypage',compact('newses','category'));
            }

        }

    }

    public function fetchnews($id)
    {
        $data = [];
        $category = category::find($id);
        $catpost = $category->childrenRecursive()->get();
        foreach($catpost as $cat)
        {
            $news = $cat->posts()->orderBy('id', 'desc')->take(2)->get();
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


    public function video()
    {
        $today = date("Y/m/d");
        $to_day=date("Y-m-d",strtotime($today));
        $mytime = Carbon::now();
        $start = Carbon::parse($mytime)->format('h:i a');
        //  $programs = Program::where([['start_date','<=', $to_day],['end_date','>=', $to_day],['start_time','<=', $start],['end_time','<=', $start]])->pluck('video');
        $programs = Program::where([['start_date','<=', $to_day],['start_time','<=', $start]])->where([['end_date','>=', $to_day],['end_time','>=', $start]])->pluck('video');

                    return response()->json([
                        'programs' => $programs,
                    ]);
    }
}
