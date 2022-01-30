<?php

namespace App\Http\Controllers\SingleVendor;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Models\Product\Productcategory;

class HomepageController extends Controller
{
    public function index(){
        return view('frontend_theme.single_vendor.pages.homepage');
    }

    public function load_category_section(){
        return view('frontend_theme.single_vendor.partials.home-category');
    }
    public function load_flashdeal_section(){
        return view('frontend_theme.single_vendor.partials.home-flashdeal');
    }
    public function load_hot_deals_section(){
        return view('frontend_theme.single_vendor.partials.home-hotdeals');
    }

    public function load_best_selling_section(){
        return view('frontend_theme.single_vendor.partials.home-best_selling');
    }

    public function load_special_offer_section(){
        return view('frontend_theme.single_vendor.partials.home-special_offer');
    }

    public function load_featured_section(){
        return view('frontend_theme.single_vendor.partials.home-featured_product');
    }

    public function load_brand_section(){
        return view('frontend_theme.single_vendor.partials.home-brand');
    }
    public function load_call_section(){
        return view('frontend_theme.single_vendor.partials.home-call_section');
    }
    public function load_recent_section(){
        return view('frontend_theme.single_vendor.partials.home-recent_product');
    }
    public function single_product_details($slug){
        $product = \App\Models\Product\Product::where('slug',$slug)->first();
        // $photo = explode('|',$product->gallaryimage);
        // dd($photo);
        //$colors = json_decode($product->colors);
        //dd($color);
        return view('frontend_theme.single_vendor.pages.single-product',compact('product'));
    }
    public function shop($slug)
    {
        $category = Productcategory::where('slug',$slug)->first();
        $products = $category->products()->get();
        return view('frontend_theme.single_vendor.pages.shop',compact('products'));
    }
    public function filter($catId,$id)
    {
        $category = Productcategory::find($catId);
        $productcolor = Product::find($id);
        $products = $category->products()->where('colors',$productcolor->colors)->get();
        return view('frontend_theme.single_vendor.pages.shop',compact('products'));
    }
    public function filterAttribute($catId,$id)
    {
        $category = Productcategory::find($catId);
        $productattribute = Product::find($id);
        foreach(json_decode($productattribute->choice_options) as $key => $choice)
        {
            foreach ($choice->values as $key => $value)
            {
                $products = $category->products()->where('choice_options', 'like', '%'.$value.'%')->get();
            }
        }
        return view('frontend_theme.single_vendor.pages.shop',compact('products'));
    }
    public function view_cart(){
        return view('frontend_theme.single_vendor.pages.cart');
    }
    public function checkout(){
        return view('frontend_theme.single_vendor.pages.checkout');
    }





}
