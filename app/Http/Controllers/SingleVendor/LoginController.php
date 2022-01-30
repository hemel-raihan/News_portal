<?php

namespace App\Http\Controllers\SingleVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('frontend_theme.single_vendor.pages.login');
    }
    public function register(){
        return view('frontend_theme.single_vendor.pages.register');
    }
}
