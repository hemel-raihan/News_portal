<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);
        return view('backend.admin.settings.site_setting',compact('setting'));
    }

    public function update(Request $request,Setting $setting)
    {
        // $this->validate($request,[
        //     'facebook_link' => 'required',
        //     'logo' => 'required',
        //     'contact' => 'required',
        // ]);

        //get form image
        $image = $request->file('logo');

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $settingPath = public_path('uploads/settings');

            $setting_path = public_path('uploads/settings/'.$setting->logo);  // Value is not URL but directory file path
            if (file_exists($setting_path)) {

                @unlink($setting_path);

            }

            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($settingPath.'/'.$imagename);

        }
        else
        {
            $imagename = $setting->logo;
        }

        $setting->update([
            'facebook_link' => $request->facebook_link,
            'logo' => $imagename,
            'contact' => $request->contact,
        ]);



        notify()->success("Site Successfully Updated","Update");
        return redirect()->route('admin.settings');
    }

    public function mail()
    {
        $setting = Setting::find(1);
        return view('backend.admin.settings.smtp_setting',compact('setting'));
    }

    public function mailupdate(Request $request,Setting $setting)
    {
        $setting->update([
            'MAIL_MAILER' => $request->MAIL_MAILER,
            'MAIL_HOST' => $request->MAIL_HOST,
            'MAIL_PORT' => $request->MAIL_PORT,
            'MAIL_USERNAME' => $request->MAIL_USERNAME,
            'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
            'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
            'MAIL_FROM_ADDRESS' => $request->MAIL_FROM_ADDRESS,
            'MAIL_FROM_NAME' => $request->MAIL_FROM_NAME,
        ]);

        Artisan::call("env:set MAIL_MAILER='" . $request->get('MAIL_MAILER') . "'");
        Artisan::call("env:set MAIL_HOST='" . $request->get('MAIL_HOST') . "'");
        Artisan::call("env:set MAIL_PORT='" . $request->get('MAIL_PORT') . "'");
        Artisan::call("env:set MAIL_USERNAME='" . $request->get('MAIL_USERNAME') . "'");
        Artisan::call("env:set MAIL_PASSWORD='" . $request->get('MAIL_PASSWORD') . "'");
        Artisan::call("env:set MAIL_ENCRYPTION='" . $request->get('MAIL_ENCRYPTION') . "'");
        Artisan::call("env:set MAIL_FROM_ADDRESS='" . $request->get('MAIL_FROM_ADDRESS') . "'");
        Artisan::call("env:set MAIL_FROM_NAME='" . $request->get('MAIL_FROM_NAME') . "'");


        notify()->success("SMTP Settings Successfully Updated","Update");
        return redirect()->route('admin.mail.settings');
    }

}
