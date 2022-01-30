<?php

namespace App\Http\Controllers\Corporate;

use App\Models\blog\Post;
use Illuminate\Http\Request;
use App\Models\blog\category;
use App\Models\Product\Product;
use App\Models\Service\Service;
use App\Models\Pagebuilder\Element;
use App\Models\Portfolio\Portfolio;
use App\Models\Pricing_Table\Price;
use App\Http\Controllers\Controller;
use App\Models\Pagebuilder\Custompage;
use App\Models\Product\Productcategory;
use App\Models\Service\Servicecategory;
use Illuminate\Support\Facades\Artisan;
use App\Models\general_content\Contentpost;
use App\Models\Portfolio\Portfoliocategory;
use App\Models\Pricing_Table\Pricecategory;
use App\Models\general_content\Contentcategory;

class HomepageController extends Controller
{
    public function index()
    {
        // $categories = category::all();

        // $randomvideos = Video::where('type','=','Random Video')->get();
        // $othersvideos = Video::where('type','=','Others Video')->get();
        // $banner_img  = Slide::where([['type','home-banner'],['status',true]])->orderBy('id','desc')->first();
        // $notices = Notice::all();
        // $links = Link::where('status',1)->orderBy('id','desc')->limit(5)->get();
        // $posts = Post::where('scrollable',1)->orderBy('id','desc')->limit(5)->get();

        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        foreach($page->pagebuilders as $test)
        {
            foreach($test->elements as $tes)
            {
                if($tes->module_type == 'Blog Category')
                {
                    $blogcategories = category::all();
                }
                else
                {
                    $blogcategories = category::all();
                }

                if($tes->module_type == 'Service Category')
                {
                    $servicecategories = Servicecategory::all();
                }
                else
                {
                    $servicecategories = Servicecategory::all();
                }

                if($tes->module_type == 'General Category')
                {
                    $generalcategories = Contentcategory::all();
                }
                else
                {
                    $generalcategories = Contentcategory::all();
                }

                if($tes->module_type == 'Portfolio Category')
                {
                    $portfoliocategories = Portfoliocategory::all();
                }
                else
                {
                    $portfoliocategories = Portfoliocategory::all();
                }
                if($tes->module_type == 'Price-Table Category')
                {
                    $pricecategories = Pricecategory::all();
                }
                else
                {
                    $pricecategories = Pricecategory::all();
                }
                if($tes->module_type == 'Product Category')
                {
                    $productcategories = Productcategory::all();
                }
                else
                {
                    $productcategories = Productcategory::all();
                }
                if($tes->module_type == 'Blog Post')
                {
                    $blogposts = Post::where('status',1)->orderBy('id','desc')->limit($tes->post_qty)->get();
                }
                else
                {
                    $qty = Element::where('module_type','Blog Post')->orderBy('id','desc')->first();
                    $blogposts = Post::where('status',1)->orderBy('id','desc')->limit($qty->post_qty)->get();
                }
                if($tes->module_type == 'General Post')
                {
                    $generalposts = Contentpost::where('status',1)->orderBy('id','desc')->limit($tes->post_qty)->get();
                }
                else
                {
                    $qty = Element::where('module_type','General Post')->orderBy('id','desc')->first();
                    $generalposts = Contentpost::where('status',1)->orderBy('id','desc')->limit($qty->post_qty)->get();
                }
                if($tes->module_type == 'Service Post')
                {
                    $serviceposts = Service::all();
                }
                else
                {
                    $serviceposts = Service::all();
                }
                if($tes->module_type == 'Portfolio Post')
                {
                    $portfolioposts = Portfolio::all();
                }
                else
                {
                    $portfolioposts = Portfolio::all();
                }
                if($tes->module_type == 'Price-Table Post')
                {
                    $priceposts = Price::all();
                }
                else
                {
                    $priceposts = Price::all();
                }
                if($tes->module_type == 'Product Post')
                {
                    $productposts = Product::all();

                }
                else
                {
                    $productposts = Product::all();
                }


            }


        }

        Artisan::call('cache:clear');

        if ($page->pagebuilders()->exists())
        {
            return view('frontend_theme.corporate.homepage',compact('page','blogcategories','servicecategories','generalcategories','portfoliocategories','pricecategories','blogposts'
            ,'generalposts','serviceposts','portfolioposts','priceposts','productcategories','productposts','test'));
        }
        else
        {
            return view('frontend_theme.corporate.homepage',compact('page'));
        }

    }

    public function portfolios($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $portfoliocategory = Portfoliocategory::find($id);
        $portfoliocategoryposts = $portfoliocategory->portfolios()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.all_posts',compact('portfoliocategoryposts','portfoliocategory','page'));
    }

    public function portfoliodetails($id)
    {

        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $portfolio = Portfolio::find($id);
        foreach($portfolio->portfoliocategories as $categories)
        {
            $portfolio_id = $categories->id;
        }

        $portfoliocategory = Portfoliocategory::find($portfolio_id);
        $portfoliocategoryposts = $portfoliocategory->portfolios()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.posts_singlepage',compact('portfolio','portfoliocategoryposts','page'));
    }

    public function services($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $servicecategory = Servicecategory::find($id);
        $servicecategoryposts = $servicecategory->services()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.all_posts',compact('servicecategoryposts','servicecategory','page'));
    }

    public function servicedetails($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $service = Service::find($id);
        foreach($service->servicecategories as $categories)
        {
            $service_id = $categories->id;
        }
        $servicecategory = Servicecategory::find($service_id);
        $servicecategoryposts = $servicecategory->services()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.posts_singlepage',compact('service','servicecategoryposts','page'));
    }

    public function prices($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $pricecategory = Pricecategory::find($id);
        $pricecategoryposts = $pricecategory->prices()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.all_posts',compact('pricecategoryposts','pricecategory','page'));
    }

    public function pricedetails($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $price = Price::find($id);
        foreach($price->pricecategories as $categories)
        {
            $price_id = $categories->id;
        }
        $pricecategory = Pricecategory::find($price_id);
        $pricecategoryposts = $pricecategory->prices()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.posts_singlepage',compact('price','pricecategoryposts','page'));
    }

    public function blogs($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $blogcategory = category::find($id);
        $blogcategoryposts = $blogcategory->posts()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.all_posts',compact('blogcategoryposts','blogcategory','page'));
    }

    public function blogdetails($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $blog = Post::find($id);
        foreach($blog->categories as $blogcategories)
        {
            $blog_id = $blogcategories->id;
        }
        $blogcategory = category::find($blog_id);
        $blogcategoryposts = $blogcategory->posts()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.posts_singlepage',compact('blog','blogcategoryposts','page'));
    }

    public function generals($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $contentcategory = Contentcategory::find($id);
        $contentcategoryposts = $contentcategory->contentposts()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.all_posts',compact('contentcategoryposts','contentcategory','page'));
    }

    public function generaldetails($id)
    {
        $page = Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
        $content = Contentpost::find($id);
        foreach($content->contentcategories as $categories)
        {
            $content_id = $categories->id;
        }
        $contentcategory = Contentcategory::find($content_id);
        $contentcategoryposts = $contentcategory->contentposts()->get();
        Artisan::call('cache:clear');
        return view('frontend_theme.corporate.posts_singlepage',compact('content','contentcategoryposts','page'));
    }

    public function contact()
    {
        return view('frontend_theme.corporate.contact_form');
    }
}
