<?php

namespace App\Http\Controllers\SingleVendor;

use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseHistoryController extends Controller
{
    public function purchaseOrders(){

         //$orders = Order::where('user_id', Auth::user()->id)->orderBy('code', 'desc')->paginate(12);

        return array(
            'view_orders' => view('frontend_theme.single_vendor.user.customer.purchase-history')->render(),
          );

        // return view('frontend_theme.single_vendor.user.customer.purchase-history',compact('orders'));

    }
    public function purchase_history_details(Request $request){
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = 1;
        $order->payment_status_viewed = 1;
        $order->save();
        return view('frontend_theme.single_vendor.user.order_details_customer',compact('order'));
    }
}
