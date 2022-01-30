<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Models\User;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Productstock;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function all_orders(Request $request)
    {

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $sort_search = null;
        $delivery_status = null;

        $orders = Order::orderBy('id', 'desc');
        // if ($request->has('search')) {
        //     $sort_search = $request->search;
        //     $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        // }
        if ($request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($start_date != null && $end_date != null) {
            $orders = $orders->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
        }
        $orders = $orders->paginate(15);
        return view('backend.admin.sales.order.index', compact('orders', 'sort_search', 'delivery_status','start_date','end_date'));
    }

    public function all_orders_show($id)
    {
        $order = Order::findOrFail($id);
        //$order_shipping_address = json_decode($order->shipping_address);
        // $delivery_boys = User::where('city', $order_shipping_address->city)
        //     ->where('user_type', 'delivery_boy')
        //     ->get();

        return view('backend.admin.sales.order.show', compact('order'));
    }

    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = '0';
        $order->delivery_status = $request->status;
        $order->save();


        // if ($request->status == 'cancelled' && $order->payment_type == 'wallet') {
        //     $user = User::where('id', $order->user_id)->first();
        //     $user->balance += $order->grand_total;
        //     $user->save();
        // }

        // if (Auth::user()->user_type == 'seller') {
        //     foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail) {
        //         $orderDetail->delivery_status = $request->status;
        //         $orderDetail->save();

        //         if ($request->status == 'cancelled') {
        //             $variant = $orderDetail->variation;
        //             if ($orderDetail->variation == null) {
        //                 $variant = '';
        //             }

        //             $product_stock = ProductStock::where('product_id', $orderDetail->product_id)
        //                 ->where('variant', $variant)
        //                 ->first();

        //             if ($product_stock != null) {
        //                 $product_stock->qty += $orderDetail->quantity;
        //                 $product_stock->save();
        //             }
        //         }
        //     }
        // } else {
            foreach ($order->orderDetails as $key => $orderDetail) {

                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();

                if ($request->status == 'cancelled') {
                    $variant = $orderDetail->variation;
                    if ($orderDetail->variation == null) {
                        $variant = '';
                    }

                    $product_stock = Productstock::where('product_id', $orderDetail->product_id)
                        ->where('variant', $variant)
                        ->first();

                    if ($product_stock != null) {
                        $product_stock->qty += $orderDetail->quantity;
                        $product_stock->save();
                    }
                }


            }
        //}
        // if (addon_is_activated('otp_system') && SmsTemplate::where('identifier', 'delivery_status_change')->first()->status == 1) {
        //     try {
        //         SmsUtility::delivery_status_change(json_decode($order->shipping_address)->phone, $order);
        //     } catch (\Exception $e) {

        //     }
        // }

        //sends Notifications to user
        // NotificationUtility::sendNotification($order, $request->status);
        // if (get_setting('google_firebase') == 1 && $order->user->device_token != null) {
        //     $request->device_token = $order->user->device_token;
        //     $request->title = "Order updated !";
        //     $status = str_replace("_", "", $order->delivery_status);
        //     $request->text = " Your order {$order->code} has been {$status}";

        //     $request->type = "order";
        //     $request->id = $order->id;
        //     $request->user_id = $order->user->id;

        //     NotificationUtility::sendFirebaseNotification($request);
        // }


        // if (addon_is_activated('delivery_boy')) {
        //     if (Auth::user()->user_type == 'delivery_boy') {
        //         $deliveryBoyController = new DeliveryBoyController;
        //         $deliveryBoyController->store_delivery_history($order);
        //     }
        // }

        return 1;
    }

    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status_viewed = '0';
        $order->save();

        // if (Auth::user()->user_type == 'seller') {
        //     foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail) {
        //         $orderDetail->payment_status = $request->status;
        //         $orderDetail->save();
        //     }
        // } else {
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        //}

        $status = 'paid';
        foreach ($order->orderDetails as $key => $orderDetail) {
            if ($orderDetail->payment_status != 'paid') {
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();


        // if ($order->payment_status == 'paid' && $order->commission_calculated == 0) {
        //     calculateCommissionAffilationClubPoint($order);
        // }

        //sends Notifications to user
        // NotificationUtility::sendNotification($order, $request->status);
        // if (get_setting('google_firebase') == 1 && $order->user->device_token != null) {
        //     $request->device_token = $order->user->device_token;
        //     $request->title = "Order updated !";
        //     $status = str_replace("_", "", $order->payment_status);
        //     $request->text = " Your order {$order->code} has been {$status}";

        //     $request->type = "order";
        //     $request->id = $order->id;
        //     $request->user_id = $order->user->id;

        //     NotificationUtility::sendFirebaseNotification($request);
        // }


        // if (addon_is_activated('otp_system') && SmsTemplate::where('identifier', 'payment_status_change')->first()->status == 1) {
        //     try {
        //         SmsUtility::payment_status_change(json_decode($order->shipping_address)->phone, $order);
        //     } catch (\Exception $e) {

        //     }
        // }
        return 1;
    }


    public function destroy($id)
    {
        $order = Order::find($id);
       $order->delete();
        notify()->success('Order Deleted Successfully','Delete');
        return back();
    }
}
