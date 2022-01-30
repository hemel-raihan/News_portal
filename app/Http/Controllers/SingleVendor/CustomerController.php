<?php

namespace App\Http\Controllers\SingleVendor;

use Auth;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Models\Address\Address;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(){
        // $orders = Order::where('user_id', Auth::user()->id)->orderBy('code', 'desc')->paginate(2);

      //   return array(
      //     'view_dashboard' => view('frontend_theme.single_vendor.user.customer.dashboard_home',compact('orders'))->render(),
      // );
          return view('frontend_theme.single_vendor.user.customer.dashboard');
    }

    public function dashboard_home(){
      return view('frontend_theme.single_vendor.user.customer.dashboard_home');
    }

    public function address(){

      return array(
        'view_address' => view('frontend_theme.single_vendor.user.customer.address')->render(),
      );
      // return view('frontend_theme.single_vendor.user.customer.address');
    }
    public function account_details(){

      return array(
        'view_account' => view('frontend_theme.single_vendor.user.customer.account_details')->render(),
      );
      // return view('frontend_theme.single_vendor.user.customer.address');
    }


    public function userProfileUpdate(Request $request){
      $user = Auth::user();
      $user->name = $request->name;
      $user->phone = $request->phone;
      $user->save();

      return back()->with('success','User Profile Updated');
    }

    public function storeAddress(Request $request){
      $address = new Address;
      $address->user_id = Auth::user()->id;
      $address->address = $request->address;
      $address->country_id = $request->country_id;
      $address->state_id = $request->state_id;
      $address->city_id = $request->city_id;
      $address->postal_code = $request->postal_code;
      $address->phone = $request->phone;
      $address->save();

      return back()->with('success','Address Created Successfully');

    }

}
