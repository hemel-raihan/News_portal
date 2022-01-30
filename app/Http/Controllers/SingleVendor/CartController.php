<?php

namespace App\Http\Controllers\SingleVendor;

use Session;
use App\Models\Cart\Cart;
use Illuminate\Http\Request;
use App\Models\Address\Address;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product\Productcategory;

class CartController extends Controller
{
    public function index(Request $request){

        $categories = Productcategory::all();
        if(auth()->user() != null) {
            $user_id = Auth::user()->id;
            if($request->session()->get('temp_user_id')) {
                Cart::where('temp_user_id', $request->session()->get('temp_user_id'))
                        ->update(
                                [
                                    'user_id' => $user_id,
                                    'temp_user_id' => null
                                ]
                );

                Session::forget('temp_user_id');
            }
            $carts = Cart::where('user_id', $user_id)->get();

           
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            // $carts = Cart::where('temp_user_id', $temp_user_id)->get();
            $carts = ($temp_user_id != null) ? Cart::where('temp_user_id', $temp_user_id)->get() : [] ;
        }
        //dd($carts);

        return view('frontend_theme.single_vendor.pages.cart', compact('categories', 'carts'));
    }

    //Show add to card modal
    public function showCartModal(Request $request)
    {
        $product = Product::find($request->id);
        return view('frontend_theme.single_vendor.partials.addToCart', compact('product'));
    }

    public function addToCart(Request $request){
       
        $product = Product::find($request->id);
        $carts = array();
        $data = array();

        if(auth()->user() != null) {
            $user_id = Auth::user()->id;
            $data['user_id'] = $user_id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            if($request->session()->get('temp_user_id')) {
                $temp_user_id = $request->session()->get('temp_user_id');
            } else {
                $temp_user_id = bin2hex(random_bytes(10));
                $request->session()->put('temp_user_id', $temp_user_id);
            }
            $data['temp_user_id'] = $temp_user_id;
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }

        $data['product_id'] = $product->id;
        $data['owner_id'] = $product->user_id;

        $str = '';
        $tax = 0;
        if($product->auction_product == 0){
            if($product->digital != 1 && $request->quantity < $product->min_qty) {
                // return array(
                //     'status' => 0,
                //     'cart_count' => count($carts),
                //     'modal_view' => view('frontend.partials.minQtyNotSatisfied', [ 'min_qty' => $product->min_qty ])->render(),
                //     'nav_cart_view' => view('frontend.partials.cart')->render(),
                // );
                //return back();
                return array(
                    'cart_count' => count($carts),
                    'single_product_view' => view('frontend_theme.single_vendor.partials.single-product-view', compact('carts'))->render(),
                    'nav_cart_view' => view('frontend_theme.single_vendor.partials.nav-cart')->render(),
                );
            }

            //check the color enabled or disabled for the product
            if($request->has('color')) {
                $str = $request['color'];
            }

            if ($product->digital != 1) {
                //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
                foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
                    if($str != null){
                        $str .= '-'.str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
                    }
                    else{
                        $str .= str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
                    }
                }
            }

            $data['variation'] = $str;

            $product_stock = $product->stocks->where('variant', $str)->first();
            $price = $product_stock->price;

            // if($product->wholesale_product){
            //     $wholesalePrice = $product_stock->wholesalePrices->where('min_qty', '<=', $request->quantity)->where('max_qty', '>=', $request->quantity)->first();
            //     if($wholesalePrice){
            //         $price = $wholesalePrice->price;
            //     }
            // }

            $quantity = $product_stock->qty;

            if($quantity < $request['quantity']){
                //return back();
                return array(
                    'cart_count' => count($carts),
                    'single_product_view' => view('frontend_theme.single_vendor.partials.single-product-view', compact('carts'))->render(),
                    'nav_cart_view' => view('frontend_theme.single_vendor.partials.nav-cart')->render(),
                );
            }

            //discount calculation
            $discount_applicable = false;

            if ($product->discount_start_date == null) {
                $discount_applicable = true;
            }
            elseif (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
                $discount_applicable = true;
            }

            if ($discount_applicable) {
                if($product->discount_type == 'percent'){
                    $price -= ($price*$product->discount)/100;
                }
                elseif($product->discount_type == 'amount'){
                    $price -= $product->discount;
                }
            }

            //calculation of taxes
            foreach ($product->taxes as $product_tax) {
                if($product_tax->tax_type == 'percent'){
                    $tax += ($price * $product_tax->tax) / 100;
                }
                elseif($product_tax->tax_type == 'amount'){
                    $tax += $product_tax->tax;
                }
            }

            $data['address_id'] = $request->address_id;
            $data['quantity'] = $request['quantity'];
            $data['price'] = $price;
            $data['tax'] = $tax;
            //$data['shipping'] = 0;
            $data['shipping_cost'] = 0;
            $data['product_referral_code'] = null;
            $data['cash_on_delivery'] = 'COD';
 

            if ($request['quantity'] == null){
                $data['quantity'] = 1;
            }

            if(Cookie::has('referred_product_id') && Cookie::get('referred_product_id') == $product->id) {
                $data['product_referral_code'] = Cookie::get('product_referral_code');
            }

            if($carts && count($carts) > 0){
                $foundInCart = false;

                foreach ($carts as $key => $cartItem){
                    $product = Product::where('id', $cartItem['product_id'])->first();
                    if($product->auction_product == 1){
                        return back();
                    }

                    if($cartItem['product_id'] == $request->id) {
                        $product_stock = $product->stocks->where('variant', $str)->first();
                        $quantity = $product_stock->qty;
                        if($quantity < $cartItem['quantity'] + $request['quantity']){
                            // return back();
                            return array(
                                'status' => 0,
                                'cart_count' => count($carts),
                                'single_product_view' => view('frontend_theme.single_vendor.partials.single-product-view', compact('carts'))->render(),
                                'nav_cart_view' => view('frontend_theme.single_vendor.partials.nav-cart')->render(),
                            );
                        }
                        if(($str != null && $cartItem['variation'] == $str) || $str == null){
                            $foundInCart = true;

                            $cartItem['quantity'] += $request['quantity'];

                            if($product->wholesale_product){
                                $wholesalePrice = $product_stock->wholesalePrices->where('min_qty', '<=', $request->quantity)->where('max_qty', '>=', $request->quantity)->first();
                                if($wholesalePrice){
                                    $price = $wholesalePrice->price;
                                }
                            }

                            $cartItem['price'] = $price;

                            $cartItem->save();
                        }
                    }
                }
                if (!$foundInCart) {
                    Cart::create($data);
                }
            }
            else{
                Cart::create($data);
            }

            if(auth()->user() != null) {
                $user_id = Auth::user()->id;
                $carts = Cart::where('user_id', $user_id)->get();
            } else {
                $temp_user_id = $request->session()->get('temp_user_id');
                $carts = Cart::where('temp_user_id', $temp_user_id)->get();
            }
            
            // return back();
            return array(
                'cart_count' => count($carts),
                'single_product_view' => view('frontend_theme.single_vendor.partials.single-product-view', compact('carts'))->render(),
                'nav_cart_view' => view('frontend_theme.single_vendor.partials.nav-cart')->render(),
                'modal_view' => view('frontend_theme.single_vendor.partials.addedToCart', compact('product', 'data'))->render(),
            );
        }
        else{
            $price = $product->bids->max('amount');

            foreach ($product->taxes as $product_tax) {
                if($product_tax->tax_type == 'percent'){
                    $tax += ($price * $product_tax->tax) / 100;
                }
                elseif($product_tax->tax_type == 'amount'){
                    $tax += $product_tax->tax;
                }
            }

            $data['address_id'] = $request->address_id;
            $data['quantity'] = 1;
            $data['price'] = $price;
            $data['tax'] = $tax;
            $data['shipping_cost'] = 0;
            $data['product_referral_code'] = null;
            $data['cash_on_delivery'] = 'COD';

            if(count($carts) == 0){
                Cart::create($data);
            }
            if(auth()->user() != null) {
                $user_id = Auth::user()->id;
                $carts = Cart::where('user_id', $user_id)->get();
            } else {
                $temp_user_id = $request->session()->get('temp_user_id');
                $carts = Cart::where('temp_user_id', $temp_user_id)->get();
            }
            return array(
                'cart_count' => count($carts),
                'single_product_view' => view('frontend_theme.single_vendor.partials.single-product-view', compact('carts'))->render(),
                'nav_cart_view' => view('frontend_theme.single_vendor.partials.nav-cart')->render(),
            );

            // return back();
        }

    }

    //removeFromCart
    function removeFromCart(Request $request){
        Cart::destroy($request->id);

        if(auth()->user() != null) {
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }

        return array(
            'cart_count' => count($carts),
            'cart_view' => view('frontend_theme.single_vendor.partials.cart_details', compact('carts'))->render(),
            'nav_cart_view' => view('frontend_theme.single_vendor.partials.nav-cart')->render(),
        );

        // return response()->json([
        //     'status'=>200
        // ]);
    }

        //updated the quantity for a cart item
        public function updateQuantity(Request $request)
        {
            $cartItem = Cart::findOrFail($request->id);
    
            if($cartItem['id'] == $request->id){
                $product = Product::find($cartItem['product_id']);
                $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                $quantity = $product_stock->qty;
                $price = $product_stock->price;
    
                if($quantity >= $request->quantity) {
                    if($request->quantity >= $product->min_qty){
                        $cartItem['quantity'] = $request->quantity;
                    }
                }
    
                if($product->wholesale_product){
                    $wholesalePrice = $product_stock->wholesalePrices->where('min_qty', '<=', $request->quantity)->where('max_qty', '>=', $request->quantity)->first();
                    if($wholesalePrice){
                        $price = $wholesalePrice->price;
                    }
                }
    
                $cartItem->save();
            }
    
            if(auth()->user() != null) {
                $user_id = Auth::user()->id;
                $carts = Cart::where('user_id', $user_id)->get();
            } else {
                $temp_user_id = $request->session()->get('temp_user_id');
                $carts = Cart::where('temp_user_id', $temp_user_id)->get();
            }
    
            return array(
                'cart_count' => count($carts),
                'cart_view' => view('frontend_theme.single_vendor.partials.cart_details', compact('carts'))->render(),
                'nav_cart_view' => view('frontend_theme.single_vendor.partials.nav-cart')->render(),
            );
        }

    //checkout
    public function checkout(){
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $address = Address::where('id', $carts[0]['address_id'])->first();

        return view('frontend_theme.single_vendor.pages.checkout',compact('carts','address'));
    }
}
