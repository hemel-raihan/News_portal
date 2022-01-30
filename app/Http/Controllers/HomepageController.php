<?php

namespace App\Http\Controllers;

use App\Models\blog\Post;
use App\Models\Admin\Video;
use Illuminate\Http\Request;
use App\Models\blog\category;
use App\Models\Teams\Teampost;
use App\Models\Admin\Link\Link;
use App\Models\Admin\Slide\Slide;
use App\Models\Admin\Notice\Notice;
use App\Models\Frontmenu\Frontmenu;
use App\Models\Frontmenu\Frontmenuitem;
use Illuminate\Support\Facades\Artisan;
use App\Models\general_content\Contentpost;
use App\Models\general_content\Contentcategory;

class HomepageController extends Controller
{
    public function index()
    {
        $categories = category::all();

        $randomvideos = Video::where('type','=','Random Video')->get();
        $othersvideos = Video::where('type','=','Others Video')->get();
        $banner_img  = Slide::where([['type','home-banner'],['status',true]])->orderBy('id','desc')->first();
        $notices = Notice::all();
        $links = Link::where('status',1)->orderBy('id','desc')->limit(5)->get();
        $posts = Post::where('scrollable',1)->orderBy('id','desc')->limit(5)->get();

        Artisan::call('cache:clear');
        $proggaponcategories = Contentcategory::whereIn('name', ['আদেশ/প্রজ্ঞাপন', 'নীতিমালা/পরিপত্র/আইন/বিধি'])->get();

        return view('frontend_theme.default.homepage',compact('categories','randomvideos','othersvideos',
            'banner_img','proggaponcategories','notices','links','posts'));
    }

    public function contentdetails($id)
    {
        $post = Contentpost::find($id);
        Artisan::call('cache:clear');
        return view('frontend_theme.default.contentpost_details',compact('post'));
    }

    public function teamdetails($id)
    {
        $teampost = Teampost::find($id);
        Artisan::call('cache:clear');
        return view('frontend_theme.default.contentpost_details',compact('teampost'));
    }

    public function blogposts($id)
    {
        $category = category::find($id);
        $blogcategoryposts = $category->posts()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.default.all_blogpost',compact('blogcategoryposts','category'));
    }

    public function postdetails($id)
    {
        $post = Post::find($id);
        Artisan::call('cache:clear');
        return view('frontend_theme.default.blogpost_details',compact('post'));
    }

    public function generalposts($id)
    {
        $title = Contentcategory::find($id);
        $category = Contentcategory::find($id);
        $contentcategoryposts = $category->contentposts()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.default.all_contentpost',compact('contentcategoryposts','title'));
    }

    public function generaldetails($id)
    {
        $post = Contentpost::find($id);
        Artisan::call('cache:clear');
        return view('frontend_theme.default.blogpost_details',compact('post'));
    }

    public function noticedetails($id)
    {
        $notice = Notice::find($id);
        Artisan::call('cache:clear');
        return view('frontend_theme.default.front_layout.single-notice',compact('notice'));
    }

    public function hhotlinksdetails($id)
    {
        $link = Link::find($id);
        Artisan::call('cache:clear');
        return view('frontend_theme.default.front_layout.single-link',compact('link'));
    }


}
