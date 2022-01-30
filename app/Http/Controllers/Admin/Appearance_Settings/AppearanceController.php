<?php

namespace App\Http\Controllers\Admin\Appearance_Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appearance_Settings\Navbarsetting;

class AppearanceController extends Controller
{
    public function index()
    {
        $setting = Navbarsetting::find(1);
        return view('backend.admin.appearance_settings.navbar_setting',compact('setting'));
    }

    public function update(Request $request,Navbarsetting $setting)
    {
        // $this->validate($request,[
        //     'facebook_link' => 'required',
        //     'logo' => 'required',
        //     'contact' => 'required',
        // ]);

        $setting->update([
            'navbar_style' => $request->navbar_style,
        ]);



        notify()->success("Video Successfully Updated","Update");
        return redirect()->route('admin.navbar.settings');
    }
}
