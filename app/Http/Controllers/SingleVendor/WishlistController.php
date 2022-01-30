<?php

namespace App\Http\Controllers\SingleVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    function customer_wishlist(){
        return array(
            'view_wish' => view('frontend_theme.single_vendor.user.customer.customer_wishlist')->render(),
          );
    }
}
