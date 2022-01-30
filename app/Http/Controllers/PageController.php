<?php

namespace App\Http\Controllers;

use App\Models\Admin\Page;
use Illuminate\Http\Request;
use App\Models\blog\category;
use App\Models\Frontmenu\Frontmenuitem;
use App\Models\Teams\Teamcategory;
use Illuminate\Support\Facades\Artisan;
use App\Models\general_content\Contentcategory;

class PageController extends Controller
{
    public function index($slug)
    {
        $contentcategory = Contentcategory::all();
        $teamcategory = Teamcategory::all();
        $blogcategory = category::all();
        $pages = Page::all();

        $menuitem = Frontmenuitem::where('slug',$slug)->firstOrFail();

        $page_id = $menuitem->page_id;
        foreach($pages  as $page)
        {
            if($page->id == $page_id)
            {
                $page = Page::where('id',$page_id)->firstOrFail();
                Artisan::call('cache:clear');
                return $page;
                //return view('frontend_theme.default.default_pages',compact('page','slug'));
            }

        }

        $blogcategoryid = $menuitem->blogcategory_id;
        foreach($blogcategory  as $blogcat)
        {
            if($blogcat->id == $blogcategoryid)
            {
                $blog = category::where('id',$blogcategoryid)->firstOrFail();
                $blogposts = $blog->posts()->get();
                Artisan::call('cache:clear');
                return $blogposts;

                //return view('frontend_theme.default.default_pages',compact('page','slug'));
            }

        }

        $contentcategoryid = $menuitem->contentcategory_id;
        foreach($contentcategory  as $contentcat)
        {
            if($contentcat->id == $contentcategoryid)
            {
                $content = Contentcategory::where('id',$contentcategoryid)->firstOrFail();
                $contentposts = $content->contentposts()->get();
                Artisan::call('cache:clear');
                return $contentposts;

                //return view('frontend_theme.default.default_pages',compact('page','slug'));
            }

        }



        // foreach($category  as $cat)
        // {
        //     if($cat->slug == $slug)
        //     {
        //         $title = Contentcategory::findBySlug($slug);
        //         $contentcategory = Contentcategory::findBySlug($slug);
        //         $contentcategoryposts = $contentcategory->contentposts()->get();
        //         Artisan::call('cache:clear');
        //         return view('frontend_theme.default.all_contentpost',compact('contentcategoryposts','title'));
        //     }

        // }

        // foreach($teamcategory  as $teamcat)
        // {
        //     if($teamcat->slug == $slug)
        //     {
        //         $title = Teamcategory::findBySlug($slug);
        //         $teamcategory = Teamcategory::findBySlug($slug);
        //         $teamcategoryposts = $teamcategory->teamposts()->get();
        //         Artisan::call('cache:clear');
        //         return view('frontend_theme.default.all_contentpost',compact('teamcategoryposts','title'));
        //     }

        // }

        // foreach($blogcategory  as $blogcat)
        // {
        //     if($blogcat->slug == $slug)
        //     {
        //         $title = category::findBySlug($slug);
        //         $category = category::findBySlug($slug);
        //         $categoryposts = $category->posts()->get();
        //         Artisan::call('cache:clear');
        //         return view('frontend_theme.default.all_contentpost',compact('categoryposts','title'));
        //     }

        // }
    }



}





