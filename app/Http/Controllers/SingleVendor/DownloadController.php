<?php

namespace App\Http\Controllers\SingleVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index(){

        return array(
            'view_download' => view('frontend_theme.single_vendor.user.customer.download')->render(),
        );

        // return view('frontend_theme.single_vendor.user.customer.download');
    }
}
