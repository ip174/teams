<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\UserDetail;
use App\UserNotification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DateTime;


class NotificationController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->middleware('auth', ['except' => [

        ]]);
    }
	
	public function usersNotifications($user_id=0)
	{
        $authUser = Auth::user()->id;

        UserNotification::where(['user_id'=>$authUser])->where('viewed_status', '!=', 'D')->update(['viewed_status'=>'Y']);
        $UserNotifications = UserNotification::where(['user_id'=>$authUser])->where('viewed_status', '!=', 'D')->orderBy('id', 'DESC')->get();
		return view('notifications/users_notifications', compact('UserNotifications'));
	}

    public function deleteNotification(Request $request)
    {
        $notificationId = $request->notificationId;
        $authUser = Auth::user()->id;
        $json_array['response_status'] = 1;
        $json_array['response_msg'] = '';

        if((int)$notificationId > 0){
            $UserNotifications = UserNotification::where(['user_id'=>$authUser, 'id'=>$notificationId])->where('viewed_status', '!=', 'D')->first();
            if(count($UserNotifications) > 0){
                //UserNotification::where(['user_id'=>$authUser, 'id'=>$notificationId])->delete();
                UserNotification::where(['user_id'=>$authUser, 'id'=>$notificationId])->update(['viewed_status'=>'D']);
                $json_array['response_status'] = 1;
                $json_array['response_msg'] = 'Successfully deleted!';
            }else{
                $json_array['response_status'] = 0;
                $json_array['response_msg'] = 'Unauthorised access!';
            }
        }else{
            $json_array['response_status'] = 0;
            $json_array['response_msg'] = 'Something missmatched!';
        }

        return \Response::json($json_array);
    }



    public function deleteBulkNotification(Request $request)
    {
        $notificationIds = $request->notificationIds;
        $authUser = Auth::user()->id;
        $json_array['response_status'] = 1;
        $json_array['response_msg'] = '';

        //$a = UserNotification::whereIn('id', [$notificationIds])->delete();
        $a = UserNotification::whereIn('id', [$notificationIds])->update(['viewed_status'=>'D']);
        //print_r($a); exit;
        $json_array['response_status'] = 1;
        $json_array['response_msg'] = 'Successfully deleted!';

        return \Response::json($json_array);
    }

    public function starredNotification(Request $request){
        $notificationId = $request->notificationId;
        $authUser = Auth::user()->id;
        $json_array['response_status'] = 1;
        $json_array['response_msg'] = '';

        if((int)$notificationId > 0){
            $UserNotifications = UserNotification::where(['user_id'=>$authUser, 'id'=>$notificationId])->first();
            if(count($UserNotifications) > 0){
                $is_starredVal = $UserNotifications->is_starred == 'Y' ? 'N' : 'Y';
                UserNotification::where(['user_id'=>$authUser, 'id'=>$notificationId])->update(['is_starred'=>$is_starredVal]);
                $json_array['response_status'] = 1;
                $json_array['response_msg'] = '';
            }else{
                $json_array['response_status'] = 0;
                $json_array['response_msg'] = 'Unauthorised access!';
            }
        }else{
            $json_array['response_status'] = 0;
            $json_array['response_msg'] = 'Something missmatched!';
        }

        return \Response::json($json_array);
    }
}
