<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        Artisan::call('cache:clear');
        return view('backend.admin.dashboard');
    }
    public function author()
    {
        Artisan::call('cache:clear');
        return view('admin.author');
    }
}
