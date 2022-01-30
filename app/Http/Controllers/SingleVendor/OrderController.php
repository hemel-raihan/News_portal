<?php

namespace App\Http\Controllers\SingleVendor;

use Session;
use App\Models\Cart\Cart;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Models\Address\Address;
use App\Models\Product\Product;
use App\Models\Order\OrderDetail;
use App\Models\Order\CombinedOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request){
        $carts = Cart::where('user_id', Auth::user()->id)->get();


        if ($carts->isEmpty()) {
            // flash(translate('Your cart is empty'))->warning();
            return redirect()->route('home');
        }

        $address = Address::where('id', $carts[0]['address_id'])->first();

        //update address
        $address->address = $request->address;
        $address->country_id = $request->country_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->postal_code = $request->postal_code;
        $address->phone = $request->phone;
        $address->save();

        $shippingAddress = [];

        //This is also okey as per 

        if ($address != null) {
            $shippingAddress['name']        = Auth::user()->name;
            $shippingAddress['email']       = Auth::user()->email;
            $shippingAddress['address']     = $address->address;
            $shippingAddress['country']     = $address->country->name;
            $shippingAddress['state']       = $address->state->name;
            $shippingAddress['city']        = $address->city->name;
            $shippingAddress['postal_code'] = $address->postal_code;
            $shippingAddress['phone']       = $address->phone;
            if ($address->latitude || $address->longitude) {
                $shippingAddress['lat_lang'] = $address->latitude . ',' . $address->longitude;
            }
        }

        $combined_order = new CombinedOrder;
        $combined_order->user_id = Auth::user()->id;
        $combined_order->shipping_address = json_encode($shippingAddress);
        $combined_order->save();
        

        $seller_products = array();
        foreach ($carts as $cartItem){
            $product_ids = array();
            $product = Product::find($cartItem['product_id']);
            if(isset($seller_products[$product->user_id])){
                $product_ids = $seller_products[$product->user_id];
            }
            array_push($product_ids, $cartItem);
            $seller_products[$product->user_id] = $product_ids;
        }

        foreach ($seller_products as $seller_product) {
            $order = new Order;
            $order->combined_order_id = $combined_order->id;
            $order->user_id = Auth::user()->id;
            $order->shipping_address = $combined_order->shipping_address;

            $order->payment_type = $request->payment_type;
            $order->delivery_viewed = '0';
            $order->payment_status_viewed = '0';
            $order->code = date('Ymd-His') . rand(10, 99);
            $order->date = strtotime('now');
            $order->save();

            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            $coupon_discount = 0;

            //Order Details Storing
            foreach ($seller_product as $cartItem) {
                $product = Product::find($cartItem['product_id']);

                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                $tax += $cartItem['tax'] * $cartItem['quantity'];
                $coupon_discount += $cartItem['discount'];

                // dd($cartItem['variation']);

                $product_variation = $cartItem['variation'];

                $product_stock = $product->stocks->where('variant', $product_variation)->first();
                // dd($product_stock);
                if ($product->digital != 1 && $cartItem['quantity'] > $product_stock->qty) {
                    // flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();
                    $order->delete();
                    return redirect()->route('cart')->send();
                } elseif ($product->digital != 1) {
                    $product_stock->qty -= $cartItem['quantity'];
                    $product_stock->save();
                }

                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->seller_id = $product->user_id;
                $order_detail->product_id = $product->id;
                $order_detail->variation = $product_variation;
                $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                $order_detail->shipping_type = $request->shipping_type;
                $order_detail->product_referral_code = $cartItem['product_referral_code'];
                $order_detail->shipping_cost = $cartItem['shipping_cost'];

                $shipping += $order_detail->shipping_cost;

                if ($cartItem['shipping_type'] == 'pickup_point') {
                    $order_detail->pickup_point_id = $cartItem['pickup_point'];
                }
                //End of storing shipping cost

                $order_detail->quantity = $cartItem['quantity'];
                $order_detail->save();

                $product->num_of_sale += $cartItem['quantity'];
                $product->save();

                $order->seller_id = $product->user_id;

                if ($product->added_by == 'seller' && $product->user->seller != null){
                    $seller = $product->user->seller;
                    $seller->num_of_sale += $cartItem['quantity'];
                    $seller->save();
                }

                // if (addon_is_activated('affiliate_system')) {
                //     if ($order_detail->product_referral_code) {
                //         $referred_by_user = User::where('referral_code', $order_detail->product_referral_code)->first();

                //         $affiliateController = new AffiliateController;
                //         $affiliateController->processAffiliateStats($referred_by_user->id, 0, $order_detail->quantity, 0, 0);
                //     }
                // }
            }

            $order->grand_total = $subtotal + $tax + $shipping;

            if ($seller_product[0]->coupon_code != null) {
                // if (Session::has('club_point')) {
                //     $order->club_point = Session::get('club_point');
                // }
                // $order->coupon_discount = $coupon_discount;
                // $order->grand_total -= $coupon_discount;

                // $coupon_usage = new CouponUsage;
                // $coupon_usage->user_id = Auth::user()->id;
                // $coupon_usage->coupon_id = Coupon::where('code', $seller_product[0]->coupon_code)->first()->id;
                // $coupon_usage->save();
            }

            $combined_order->grand_total += $order->grand_total;

            //$order->save();
            if($order->save()){
                foreach($carts as $cart){
                    $cart->delete();
                }
            }
        }

        $combined_order->save();

        $request->session()->put('combined_order_id', $combined_order->id);

        return redirect()->route('order.success');

    }

    //order confirmed
    public function order_confirmed(){
        $combined_order = CombinedOrder::findOrFail(Session::get('combined_order_id'));
        Cart::where('user_id', $combined_order->user_id)->delete();

        // $first_order = $combined_order->orders->first();

        // dd($first_order);

        return view('frontend_theme.single_vendor.pages.order_success', compact('combined_order'));
    }
}
