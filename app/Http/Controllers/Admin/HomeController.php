<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * General site settings.
     */
    public function settings()
    {
        $settings = Setting::find(1);
        $admin_user = Auth::guard('admins')->user();
        return view('admin.setting', compact('settings', 'admin_user'));
    }

    public function updateSettings(Request $request)
    {
        $this->validate($request, [
            'admin_email' => 'required|email|max:255',
            'site_title' => 'required|max:255',
            'contact_email' => 'required|email',
            'contact_name' => 'required|max:255',
            // 'contact_phone' => 'required',
            'site_logo' => 'mimes:jpg,jpeg,png,bmp|max:10000',
        ],
            [
                'site_logo.mimes' => 'Please upload site logo of type jpg,jpeg,png,bmp',
                'site_logo.max' => 'Maximum of 10 MB is allowed for site logo'
            ]);
        $input = $request->all();
        $admin_user = Auth::guard('admins')->user();
        $admin_user->email = $input['admin_email'];
        if($input['admin_pass'] != '')
        {
            $admin_user->password = bcrypt($input['admin_pass']);
        }
        $admin_user->save();

        $time = time();
        $settings = Setting::find(1);
        $settings->fill($input);

        /* Logo Image upload */
        if($request->hasFile('site_logo')){
            $old_image = 'assets/upload/site_logo/'.$settings->site_logo;
            \File::delete($old_image);

            $path   = public_path().'/assets/upload/site_logo/';
            $image  = $request->file('site_logo');
            $save_name = $time.str_random(10).'.'.$image->getClientOriginalExtension();
            Image::make($image->getRealPath())->save($path . $save_name, 100);
            $settings->site_logo = $save_name;

        }

        $settings->save();
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
