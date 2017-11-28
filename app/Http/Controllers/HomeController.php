<?php

namespace App\Http\Controllers;

use DB;
use App\Country;
use App\User;
use App\UserLogin;
use App\UserDetail;
use App\UserSkills;
use App\UserPortfolio;
use App\HirerSubscription;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site_home = 1;
        $class_for_home = 'beforelogin';

        return view('index', compact(
            'site_home',
            'class_for_home'
        ));
    }

    public function howItWorks()
    {
        return view('how_it_works');
    }

    public function helpCentre()
    {
        return view('help_centre');
    }

    public function serviceFee()
    {
        return view('service_fee');
    }

    public function contactUs()
    {
        return view('contact_us');
    }
    public function Community()
    {
        return view('community');
    }
    public function Dispute()
    {
        return view('dispute');
    }

    public function hirerSubscription(Request $request)
    {
        $json_array['color'] = "#ff3300";
        $json_array['fontweight'] = "bold";
        $json_array['ret_msg'] = "";

        $emailAddress = $request->email;
        if(!empty($emailAddress)){
            //echo $emailAddress; exit;
            $checkExist = HirerSubscription::where(['emailAddress'=>$emailAddress])->first();
            //print_r($checkExist);exit;
            if(count($checkExist) == 0)
            {
                $HirerSubscription = new HirerSubscription;
                $HirerSubscription->emailAddress = $emailAddress;
                //$HirerSubscription->datetime = date('Y-m-d H:i:s');
                $HirerSubscription->ipaddress = $_SERVER['REMOTE_ADDR'];
                $HirerSubscription->save();
                $json_array['color'] = "#007acc";
                $json_array['ret_msg'] = "Subscription successful. We will get back to you very soon!";
            }else{
                $json_array['ret_msg'] = "Email alredy subscribed!";
            }
        }else{
            $json_array['ret_msg'] = "Email field can't be blank!";
        }

        return response()->json($json_array);
    }
}
