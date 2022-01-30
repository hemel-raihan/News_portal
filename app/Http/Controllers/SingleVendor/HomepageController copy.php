<?php

namespace App\Http\Controllers\SingleVendor;

use Illuminate\Http\Request;
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
    public function load_hot_deals_section(){
        return view('frontend_theme.single_vendor.partials.home-hotdeals');
    }
    public function load_special_offer_section(){
        return view('frontend_theme.single_vendor.partials.home-special_offer');
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
        $category = Productcategory::find(1);
        return $category;
        $products = $category->products()->get();
        return view('frontend_theme.single_vendor.pages.shop',compact('products'));
    }
    public function view_cart(){
        return view('frontend_theme.single_vendor.pages.cart');
    }
    public function checkout(){
        return view('frontend_theme.single_vendor.pages.checkout');
    }

    public function order_success(){
        return view('frontend_theme.single_vendor.pages.order_success');
    }



}
