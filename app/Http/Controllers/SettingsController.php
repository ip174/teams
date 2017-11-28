<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\UserDetail;
use App\Postedjobs;
use App\JobSkillMap;
use App\JobAssesments;
use App\Budget;
use App\ExperienceLevel;
use App\ProjectLength;
use App\TurnAroundTime;
use App\Skill;
use App\CategorySubcategory;
use App\JobType;
use App\JobProposalAmount;
use App\JobProposal;
use App\JobproviderTransaction;
use App\UserTransaction;
use App\ProjectSetting;
use App\UserGeneralSetting;
use App\SecurityQuestion;
use App\NotificationMaster;
use App\UpdateMaster;
use App\UserWantsNotification;
use App\UserWantsUpdate;
use App\UserNdaSetting;
use App\MonthlyBidDetail;
use App\JobBidCreditList;
use Image;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use Stripe;
use StripeCharge;
use StripeCustomer;

class SettingsController extends Controller
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
	
	public function viewProjectSettings($job_id=0)
	{
		if( !isset($job_id) || (int)$job_id < 1 ){
			return redirect('/user/dashboard')->with('error', 'Something mismatched!');
		}
		if(checkPrivilege(2)){
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$activeMenu = 'Settings'; //Which menu will active in tabber
		$activeMenuHeader = 'Jobs';
		
		$jobDetails = Postedjobs::where(['job_id'=>$job_id])->first();

		//Only job provider can access this page
		if(isset($jobDetails->posted_by_user) && $jobDetails->posted_by_user!= $authUser){
			return redirect('/user/dashboard')->with('error', 'Unauthorised Access!');
		}
		
		$projectSettings = ProjectSetting::where(['job_id'=>$job_id])->first();

		return view('settings/project_settings', compact(
			'authUser',
			'activeMenu',
			'job_id',
			'jobDetails',
			'projectSettings',
			'activeMenuHeader'
		));
	}

	public function saveProjectSettings(Request $request){
		$input_data = $request->all();
		//print_r($_POST); exit;

		$job_id = $request->job_id;
		$id = $request->id;
		$working_days_from = $request->working_days_from;
		$working_days_to = $request->working_days_to;
		$working_hours = $request->working_hours;

		$insertUpdateArray['working_days_from'] = $working_days_from;
		$insertUpdateArray['working_days_to'] = $working_days_to;
		$insertUpdateArray['working_hours'] = $working_hours;

		if(ProjectSetting::find($id)){
			ProjectSetting::where(['id'=>$id, 'job_id'=>$job_id])->update($insertUpdateArray);
		}else{
			$insertUpdateArray['job_id'] = $job_id;
			ProjectSetting::insert($insertUpdateArray);
		}

		return redirect()->back()->with('message', 'Saved Successfully!');
	}

	public function UserGeneralSettings()
	{
		$authUser = Auth::user()->id;
		$authUserSignature = isset(Auth::user()->profile_signature) ? Auth::user()->profile_signature : '';
		$activeMenu = ''; //Which menu will active in tabber
		$immediateTask = app('request')->get('q');

		$JobBidCreditList = JobBidCreditList::where(['status'=>'A'])->get();

		$generalSettings = UserGeneralSetting::where(['user_id'=>$authUser])->first();
		$SecurityQuestions = SecurityQuestion::where(['is_active'=>'Y'])->get();
		$availableFrom = Auth::user()->available_from;
		$availableTo = Auth::user()->available_to;

		$notificationMasterArray = NotificationMaster::where(['is_active'=>'Y'])->get();
		$updateMasterArray = UpdateMaster::where(['is_active'=>'Y'])->get();

		$UserNdaSetting = UserNdaSetting::where('user_id', $authUser)->first();

		$transaction_type='C';
		$amount_type='';
		$creditBids = getTotalBidCreditsDebits($authUser, $transaction_type, $amount_type);

		$transaction_type='D';
		$amount_type='';
		$debitBids = getTotalBidCreditsDebits($authUser, $transaction_type, $amount_type);

		return view('settings/user_general_settings', compact(
			'authUser',
			'activeMenu',
			'generalSettings',
			'SecurityQuestions',
			'availableFrom',
			'availableTo',
			'notificationMasterArray',
			'updateMasterArray',
			'UserNdaSetting',
			'authUserSignature',
			'JobBidCreditList',
			'creditBids',
			'debitBids',
			'immediateTask'
		));
	}

	public function changePassword(Request $request)
	{
		if(!Auth::Check()){
			$json_array['logout_status'] = 1;
			return \Response::json($json_array);
		}

		$input_data = $request->all();
		$json_array['err_status'] = 1;
		$json_array['msg_class'] = "alert alert-danger";

		$old_password = $request->old_password;
		$password = $request->password;
		$password_confirmation = $request->password_confirmation;

		if(Auth::Check()){
			$request_data = $request->All();

			/*$validator = Validator::make($request->all(), [
	            'old_password' => 'required|min:5|max:25',
	            'password' => 'required|min:5|max:25',
	            'password_confirmation' => 'required|min:5|max:25'
	        ]);
	        print_r($validator); exit;*/

	        if($password == $password_confirmation){
				$current_password = Auth::User()->password;           
				if(Hash::check($request_data['old_password'], $current_password)){
					//print_r($request_data); exit;
					$user_id = Auth::User()->id;
					$obj_user = User::find($user_id);
					$obj_user->password = Hash::make($request_data['password']);
					$obj_user->save();
					$json_array['err_status'] = 0;
					$json_array['msg'] = "Password successfully changed!";
					$json_array['msg_class'] = "alert alert-success";
				}else{           
					$json_array['err_status'] = 1;
					$json_array['msg'] = "Please enter correct old password";
				}
			}else{
				$json_array['err_status'] = 1;
				$json_array['msg'] = "Password & confirm password not matched!";
			}
		}

		return \Response::json($json_array);
	}

	public function changeSecurityQuestion(Request $request){
		if(!Auth::Check()){
			$json_array['logout_status'] = 1;
			return \Response::json($json_array);
		}
		$authUser = Auth::user()->id;

		$input_data = $request->all();
		$json_array['err_status'] = 1;
		$json_array['msg_class'] = "alert alert-danger";

		if(!empty($request->security_question) && !empty($request->security_question_answer)){
			$security_question = $request->security_question;
			$security_question_answer = $request->security_question_answer;

			$update_array['question_id'] = $security_question;
			$update_array['answer'] = $security_question_answer;

			//$find_user = User::find($authUser);
			User::where(['id'=>$authUser])->update($update_array);

			$json_array['err_status'] = 1;
			$json_array['msg'] = "Saved successfully!";
			$json_array['msg_class'] = "alert alert-success";
		}else{
			$json_array['err_status'] = 1;
			$json_array['msg'] = "Please fillup the form!";
		}

		return \Response::json($json_array);
	}

	public function changeAvailability(Request $request){
		if(!Auth::Check()){
			$json_array['logout_status'] = 1;
			return \Response::json($json_array);
		}
		$authUser = Auth::user()->id;

		$input_data = $request->all();
		$json_array['err_status'] = 1;
		$json_array['msg_class'] = "alert alert-danger";

		if(!empty($request->working_days_from) && !empty($request->working_days_to)){
			$working_days_from = $request->working_days_from;
			$working_days_to = $request->working_days_to;

			$update_array['available_from'] = $working_days_from;
			$update_array['available_to'] = $working_days_to;

			User::where(['id'=>$authUser])->update($update_array);

			$json_array['err_status'] = 0;
			$json_array['msg'] = "Saved successfully!";
			$json_array['msg_class'] = "alert alert-success";
		}else{
			$json_array['err_status'] = 1;
			$json_array['msg'] = "Please provide appropriate value for availability!";
		}

		return \Response::json($json_array);
	}

	public function updateUser(Request $request){
		if(!Auth::Check()){
			$json_array['logout_status'] = 1;
			return \Response::json($json_array);
		}
		$authUser = Auth::user()->id;

		$postData = $request->all();
		
		$check_exist = User::find($authUser);
		//exit;
		
		
		$updateUserDet[$postData['field_name']] = @$postData['field_data'];
		if(count($check_exist)>=1){
			User::where('id', $authUser)
				->update($updateUserDet);
		}

		$response = array(
			'status' => 'success',
			'msg' => 'Successfully save',
			'msg_class'=>'alert alert-success'
		);
		return \Response::json($response);
		//exit;
	}

	public function changeNotificationSettings(Request $request){
		$inputData = $request->all();
		$authUser = Auth::user()->id;

		UserWantsNotification::where(['user_id'=>$authUser])->delete();
		if($inputData['notificationsOptions']){
			$notificationsOptionsArray = explode(' ', $inputData['notificationsOptions']);

			for($i=0; $i<sizeof($notificationsOptionsArray); $i++){
				$notification_id = trim($notificationsOptionsArray[$i]);
				if(!empty($notification_id)){
					$UserWantsNotification = new UserWantsNotification;
					$UserWantsNotification->notification_id = $notificationsOptionsArray[$i];
					$UserWantsNotification->user_id = $authUser;
					$UserWantsNotification->save();
				}
			}
		}

		$userNotificationUpdate = getNotificationsUpdateByUsers($authUser);
		$notificationValues = array('None');
		if(count($userNotificationUpdate) > 0){
			$notificationValues = array();
			foreach($userNotificationUpdate as $row){
				$notificationValues[] = $row->details;
			}
		}
		$notificationValues = implode(', ', $notificationValues);

		//$usersNotificationDetails = Auth::user()->

		$response = array(
			'status' => 'success',
			'msg' => 'Successfully saved!',
			'msg_class'=>'alert alert-success',
			'notificationValues'=>$notificationValues
		);
		return \Response::json($response);
	}

	public function changeUpdateNeedsSettings(Request $request){
		$inputData = $request->all();
		$authUser = Auth::user()->id;

		UserWantsUpdate::where(['user_id'=>$authUser])->delete();
		if($inputData['needUpdateOptions']){
			$needUpdateOptionsArray = explode(' ', $inputData['needUpdateOptions']);

			for($i=0; $i<sizeof($needUpdateOptionsArray); $i++){
				$notification_id = trim($needUpdateOptionsArray[$i]);
				if(!empty($notification_id)){
					$UserWantsUpdate = new UserWantsUpdate;
					$UserWantsUpdate->update_id = $needUpdateOptionsArray[$i];
					$UserWantsUpdate->user_id = $authUser;
					$UserWantsUpdate->save();
				}
			}
		}

		$usersNeedUpdate = getUpdateNeedsByUsers($authUser);
		$needforUpdatesValues = array('None');
		if(count($usersNeedUpdate) > 0){
			$needforUpdatesValues = array();
			foreach($usersNeedUpdate as $row){
				$needforUpdatesValues[] = $row->details;
			}
		}
		$needforUpdatesValues = implode(', ', $needforUpdatesValues);

		//$usersNotificationDetails = Auth::user()->

		$response = array(
			'status' => 'success',
			'msg' => 'Successfully saved!',
			'msg_class'=>'alert alert-success',
			'needforUpdatesValues'=>$needforUpdatesValues
		);
		return \Response::json($response);
	}

	
	public function changeNdaSettings(Request $request){
		if(!Auth::Check()){
			$json_array['logout_status'] = 1;
			return \Response::json($json_array);
		}
		$authUser = Auth::user()->id;
		$postData = $request->all();
		
		$check_exist = UserNdaSetting::where('user_id', $authUser)->first();
		
		$updateUserDet[$postData['field_name']] = @$postData['field_data'];
		if(count($check_exist)>=1)
		{
			unset($updateUserDet['user_id']);
			UserNdaSetting::where('user_id', $authUser)->update($updateUserDet);
		}
		else
		{
			$updateUserDet['user_id'] = $authUser;
			UserNdaSetting::insert($updateUserDet);
		}

		$response = array(
			'status' => 'success',
			'msg' => 'Successfully saved!',
			'msg_class'=>'alert alert-success'
		);
		return \Response::json($response);
		//exit;
	}

	public function uploadProfileSignature(Request $request){
		$input_data = $request->all();
		$authUser = Auth::user()->id;
		$authUserFname = Auth::user()->first_name;
		$authUserLname = Auth::user()->last_name;
		$authUserSignature = Auth::user()->profile_signature;
		//print_r($input_data); exit;

		$this->validate($request, [
			'profileSignatureImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		$destinationPath = public_path('/assets/upload/profile_signature/');
		if(isset($authUserSignature)){
			unlink($destinationPath.$authUserSignature);
		}

		$image = $request->file('profileSignatureImage');
		//echo $image; exit;
		$input['imagename'] = $authUserFname.'-'.$authUserLname.$authUser.time().'.'.$image->getClientOriginalExtension();
		$image->move($destinationPath, $input['imagename']);
		//$this->postImage->add($input);
		//exit;
		User::where(['id'=>$authUser])->update(['profile_signature'=>$input['imagename']]);

		/*$response = array(
			'status' => 'success',
			'msg' => 'Successfully saved!',
			'msg_class'=>'alert alert-success'
		);
		return \Response::json($response);*/
		return redirect()->back()->with('message', 'Saved Successfully!');
	}

	public function checkAvailableBidCredit(Request $request)
	{
		$authUser = Auth::user()->id;
		$json_array['status'] = 0;
		$json_array['status_msg'] = "";

		$jobSettings = getJobSettings();

		$usersAvailableBids = getBidCreditsDebits(Auth::user()->id, date('m-Y'));
		$freeBidCredit = isset($usersAvailableBids->freeBidCredit) ? $usersAvailableBids->freeBidCredit : '0';
		$freeBidDebit = isset($usersAvailableBids->freeBidDebit) ? $usersAvailableBids->freeBidDebit : '0';
		$paidBidCredit = isset($usersAvailableBids->paidBidCredit) ? $usersAvailableBids->paidBidCredit : '0';
		$paidBidDebit = isset($usersAvailableBids->paidBidDebit) ? $usersAvailableBids->paidBidDebit : '0';
		$availableFreeBid = ($freeBidCredit-$freeBidDebit);
		$availablePaidBid = ($paidBidCredit-$paidBidDebit);
		/*print_r($usersAvailableBids); exit;
		echo $freeBidCredit;
		echo $freeBidDebit;
		echo $paidBidCredit;
		echo $paidBidDebit;
		exit;*/
		if($availableFreeBid < $jobSettings->normal_fee_per_bid && $availablePaidBid < $jobSettings->normal_fee_per_bid){
			$json_array['status'] = 1;
			$json_array['status_msg'] = "You don't have available bid to send proposal respect this job. Please buy new bid.";
		}

		return \Response::json($json_array);
	}

	public function buyBidCredit(Request $request)
	{
		$authUser = Auth::user()->id;
		$bid_purchase_id = $request->creditextra;

		$bid_details = JobBidCreditList::find($bid_purchase_id);
		$creditLimit = $bid_details->credit_limit;
		$amount = $bid_details->amount;

        $debitedBalance = getTotalDebitedOrCreditedBalance($authUser, 'D');
        $creditedBalance = getTotalDebitedOrCreditedBalance($authUser, 'C');
        $availableFunds = $creditedBalance - $debitedBalance;
        if($availableFunds >= $amount){
        	return redirect('/settings/deduct-from-wallet-for-bid-purchase/'.$bid_purchase_id.'/'.$creditLimit.'/'.$amount);
        }else{
        	return redirect('/settings/pay-now-for-bid-purchase/'.$bid_purchase_id.'/'.$creditLimit.'/'.$amount);
        }
	}

	public function payNowBuyBid($bid_purchase_id=0, $creditLimit=0, $amount='0.00')
	{
		
		$user = Auth::user()->id;
		
        $jobprovider_transaction = new JobproviderTransaction;
        $jobprovider_transaction->user_id = $user;
        $jobprovider_transaction->job_id= '';
        //$jobprovider_transaction->proposal_id = $proposal_id;
        $jobprovider_transaction->payment_type = 'S';
        $jobprovider_transaction->amount = $amount;
        $jobprovider_transaction_id = $jobprovider_transaction->save();
        //dd($jobprovider_transaction_id);
        $jobprovider_transaction->transaction_no = "WO".generatePin()."-".$jobprovider_transaction->id.'-'.$bid_purchase_id;
        $jobprovider_transaction->save();

        $config = [];
        $key = config('constants.FIXED_ENCRYPT_STRING');
        $encryptedTXNID = encrypt($jobprovider_transaction->transaction_no, $key);

        if($jobprovider_transaction->payment_type == "S")
        {
            return redirect('/settings/stripe-form-for-bid-purchase/'.$encryptedTXNID);
        }

        //return response()->json($config);
	}

	public function deductBalanceFromWalletBuyBid($bid_purchase_id=0, $creditLimit=0, $amount='0.00')
    {
    	$user_transaction = new UserTransaction;
        $user_transaction->user_id = 0;
        $user_transaction->job_id = 0;
        $user_transaction->proposal_id = 0;
        $user_transaction->transaction_id = "WO".generatePin()."-".$bid_purchase_id;
        $user_transaction->amount = $amount;
        $user_transaction->paid_by = 'D';
        $user_transaction->transaction_type = "C";
        $user_transaction->payment_for = "Bid credit";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        $user_transaction = new UserTransaction;
        $user_transaction->user_id = Auth::user()->id;
        $user_transaction->job_id = 0;
        $user_transaction->proposal_id = 0;
        $user_transaction->transaction_id = "WO".generatePin()."-".$bid_purchase_id;
        $user_transaction->amount = $amount;
        $user_transaction->paid_by = 'D';
        $user_transaction->transaction_type = "D";
        $user_transaction->payment_for = "Bid credit";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        $MonthlyBidDetail = new MonthlyBidDetail;
        $MonthlyBidDetail->user_id = Auth::user()->id;
        $MonthlyBidDetail->bid_debited_credit_amount = $creditLimit;
        $MonthlyBidDetail->type = 'C';
        $MonthlyBidDetail->amount_type = 'P';
        $MonthlyBidDetail->created_at = date('Y-m-d H:i:s');
        $MonthlyBidDetail->updated_at = date('Y-m-d H:i:s');
        $MonthlyBidDetail->save();

        return redirect('/settings/user-general-settings')->with('success', 'Successfully credited!');
    }
	
	public function stripeFormBuyBid($txn=0)
    {
		if(!empty(trim($txn)))
		{
			$key = config('constants.FIXED_ENCRYPT_STRING');
			$txnDecrypt = decrypt($txn, $key);
			$txnArray = explode("-", $txnDecrypt);
			$bid_purchase_id = isset($txnArray[2]) ? $txnArray[2] : 0;
			$JobproviderTransaction = JobproviderTransaction::where(['transaction_no'=>$txnDecrypt])->first();

			if(isset($bid_purchase_id) && (int)$bid_purchase_id > 0)
			{
				$amount = $JobproviderTransaction->amount;
				return view('settings/stripe_form_for_bid_purchase', compact('amount', 'txn'));
			}
			else
			{
				//echo $txn; exit;
				return redirect('/user/dashboard');
			}
		}
		else
		{
			//echo $txn; exit;
			return redirect('/user/dashboard');
		}
    }
	
	public function stripePaymentBuyBid($txn=0, Request $request)
    {
    	//print_r($_POST); exit;
		if(!empty(trim($txn)))
		{
			$key = config('constants.FIXED_ENCRYPT_STRING');
			$encryptedTXNID = $txn;
			$txn = decrypt($txn, $key);
			$txnArray = explode("-", $txn);
			$bid_purchase_id = isset($txnArray[2]) ? $txnArray[2] : 0;
			$amount = $request->amount;
			$saughtTurnAroundTime = isset($txnArray[3]) ? $txnArray[3] : 0;
			
			if(isset($bid_purchase_id) && (int)$bid_purchase_id > 0 && $amount > 0)
			{
				$input = $request->all();
				//print_r($input); exit;
				
				$paid_membership = User::find(Auth::user()->id);
				$request_price = $amount;
				$request_price = $request_price*100;
				$stripeToken = isset($input['stripeToken']) ? $input['stripeToken'] : '';
				
				try
				{
					// Create a Customer
					Stripe::setApiKey(env('STRIPE_SECRET'));
					$stripe_customer_id = Auth::user()->stripe_customer_id;
					//debug($stripe_customer_id); exit;
					if($stripe_customer_id == NULL)
					{
						$customer = StripeCustomer::create(array(
								"source" => $stripeToken,
								"description" => $paid_membership->first_name.' '.$paid_membership->last_name." JobProvider",
								"email" =>Auth::user()->email
							)
						);
						$user = User::find(Auth::user()->id);
						$user->stripe_customer_id = $customer->id;
						$user->save();
						$stripe_customer_id = $user->stripe_customer_id;
					}

					// Charge the Customer instead of the card
					$response=StripeCharge::create(array(
						"amount" => $request_price, # amount in pence, again
						"currency" => env('STRIPE_CURRENCY'),
						"customer" => $stripe_customer_id)
					);
					//debug($response); exit;

				   $retrieve = StripeCharge::retrieve($response->id);
				   //debug($retrieve); exit;
				   $this->successfulPaymentBuyBid($encryptedTXNID);
				   $this->notifyPaymentBuyBid($txn, response()->json($retrieve));
				   return redirect('/settings/user-general-settings')->with('success', 'Successfully credited!');
				}
				catch(\Stripe\Error\Card $e)
				{
					$body = $e->getJsonBody();
					$err  = $body['error'];
					$this->cancelPaymentBuyBid($txn);
					$this->notifyPaymentBuyBid($txn, response()->json($err));
					return redirect('/settings/user-general-settings');
				}
			}
			else
			{
				//echo $txn; exit;
				return redirect('/user/dashboard');
			}
		}
		else
		{
			//echo $txn; exit;
			return redirect('/user/dashboard');
		}
    }

    public function paypalReturnBuyBid($txn)
    {
	   $this->successfulPayment($txn);
	   return redirect('/settings/user-general-settings')->with('success', 'Successfully done!');
    }
	
    public function paypalNotifyBuyBid($txn,Request $request)
    {
        $input =$request->all();
        $this->notifyPaymentBuyBid($txn, response()->json($input));
    }
	
    public function paypalCancelBuyBid($txn)
    {
        $this->cancelPaymentBuyBid($txn);
        return redirect('/settings/user-general-settings')->with('error', 'Transaction failed!');
    }
	
    private function successfulPaymentBuyBid($txn)
    {
    	$key = config('constants.FIXED_ENCRYPT_STRING');
		$encryptedTXNID = $txn;
		$txn = decrypt($txn, $key);

    	$authUserId = Auth::user()->id;
		$authUserName = Auth::user()->first_name.' '.Auth::user()->last_name;

		$txnArray = explode("-", $txn);
		$bid_purchase_id = isset($txnArray[2]) ? $txnArray[2] : 0;
		$bid_details = JobBidCreditList::find($bid_purchase_id);
		$saughtTurnAroundTime = isset($txnArray[3]) ? $txnArray[3] : 0;
		
		$jobprovider_transaction = JobproviderTransaction::where('transaction_no', $txn)->first();
        $jobprovider_transaction->payment_status = "S";
        $jobprovider_transaction->save();

        $user_transaction = new UserTransaction;
        $user_transaction->user_id = 0;
        $user_transaction->job_id = 0;
        $user_transaction->proposal_id = 0;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "C";
        $user_transaction->payment_for = "Bid credit";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        $MonthlyBidDetail = new MonthlyBidDetail;
        $MonthlyBidDetail->user_id = Auth::user()->id;
        $MonthlyBidDetail->bid_debited_credit_amount = $bid_details->credit_limit;
        $MonthlyBidDetail->type = 'C';
        $MonthlyBidDetail->amount_type = 'P';
        $MonthlyBidDetail->created_at = date('Y-m-d H:i:s');
        $MonthlyBidDetail->updated_at = date('Y-m-d H:i:s');
        $MonthlyBidDetail->save();
    }
	
    private function cancelPaymentBuyBid($txn)
    {
        $jobprovider_transaction = JobproviderTransaction::where('transaction_no',$txn)->first();
        $jobprovider_transaction->payment_status = "C";
        $jobprovider_transaction->save();
    }
	
    private function notifyPaymentBuyBid($txn,$response)
    {
        $jobprovider_transaction = JobproviderTransaction::where('transaction_no',$txn)->first();
        $jobprovider_transaction->payment_gateway_response = $response;
        $jobprovider_transaction->save();
    }
	
	public function jobsListByUser($id=0, Request $request)
	{
		if(checkPrivilege(2)){
			return redirect('/user/dashboard');
		}
		
		$data = [];
		$user = Auth::user();
		$json_array['response_status'] = 0;
		$json_array['response_data'] = '';
		$activeMenuHeader = 'Jobs';
		
		$where['posted_by_user'] = $user->id;
		
		//In progress
		$where['job_status'] = '2';
		$inprogressJobList = Postedjobs::where($where)
						->orderBy('job_id', 'desc')
						->get()->count();
		
		//Pending
		$where['job_status'] = '1';
		$pendingJobList = Postedjobs::where($where)
						->orderBy('job_id', 'desc')
						->get()->count();
		
		//Completed
		$where['job_status'] = '4';
		$completedJobList = Postedjobs::where($where)
						->orderBy('job_id', 'desc')
						->get()->count();
		
		if($request->isAjax)
		{
			//echo $id; exit;
			
			switch($id)
			{
				case 1:
					$jobList = Postedjobs::where('job_status', '!=', '4')
						->where(['posted_by_user'=>$user->id])
						->orderBy('job_id', 'desc')
						->get();
					break;
				case 2:
					$jobList = Postedjobs::where(['job_status'=>'2'])
						->where(['posted_by_user'=>$user->id])
						->orderBy('job_id', 'desc')
						->get();
					break;
				case 3:
					$jobList = Postedjobs::whereOr(['job_status'=>'1','job_status'=>'5'])
						->where(['posted_by_user'=>$user->id])
						->orderBy('job_id', 'desc')
						->get();
					break;
				case 4:
					$jobList = Postedjobs::where(['job_status'=>'4'])
						->where(['posted_by_user'=>$user->id])
						->orderBy('job_id', 'desc')
						->get();
					break;
				default:
					$jobList = Postedjobs::where(['job_status'=>'0'])
						->where(['posted_by_user'=>$user->id])
						->orderBy('job_id', 'desc')
						->get();
					break;
			}
			
			
			$returnHTML = view('jobs/job_datalist', compact(
				'jobList'
			))->render();
			$json_array['response_status'] = 1;
			$json_array['allJobList'] = count($jobList);
			$json_array['inprogressJobList'] = $inprogressJobList;
			$json_array['pendingJobList'] = $pendingJobList;
			$json_array['completedJobList'] = $completedJobList;
			$json_array['response_data'] = $returnHTML;
			
			return \Response::json($json_array);
		}
		else
		{
			$where['job_status'] = '1';
			$allJobList = Postedjobs::where('job_status', '!=', '4')
							->where(['posted_by_user'=>$user->id])
							->orderBy('job_id', 'desc')
							->get();
		}
		//dd($allJobList); exit;
		
		return view('jobs/job_list', compact(
			'data',
			'allJobList',
			'inprogressJobList',
			'pendingJobList',
			'completedJobList',
			'activeMenuHeader'
		));
	}
	
	public function editPostedJob($id, Request $request)
	{
		if(checkPrivilege(2)){
			return redirect('/user/dashboard');
		}
		
		$data = [];
		$successMsg = '';
		$authUser = Auth::user()->id;
		$activeMenuHeader = 'Jobs';
		
		
		$jobDetToEdit = Postedjobs::where('job_id', $id)->get();
		$jobDet = isset($jobDetToEdit[0]) ? $jobDetToEdit[0] : array();
		if($jobDet->posted_by_user != $authUser || $jobDet->job_status=='2' || $jobDet->job_status=='4'){
			return redirect('/user/dashboard')->with('error', 'Unauthorised Access!');
		}

		$requiredSkills = getSkillsByJobId($id);
		$requiredSkillsAry = array();
		foreach($requiredSkills as $eachReqSkill){
			$requiredSkillsAry[] = $eachReqSkill->skill_id;
		}
		
		$assesments = JobAssesments::where('job_id', $id)
						->get();
		
		$explevel_where['status'] = '1';
		$experiencelevel = ExperienceLevel::where($explevel_where)->get();
		//dd($experiencelevel); exit;
		
		$budget_where['status'] = '1';
		$budget = Budget::where($budget_where)->get();
		//dd($budget); exit;

		$jobtype_where['status'] = '1';
		$JobType = JobType::where($jobtype_where)->get();
		//dd($budget); exit;
		
		$projectLength_where['status'] = '1';
		$projectLength = ProjectLength::where($projectLength_where)->get();
		//dd($projectLength); exit;
		
		$turn_around_time_where['status'] = '1';
		$turn_around_time = TurnAroundTime::where($turn_around_time_where)->get();
		//dd($turn_around_time); exit;
		
		$skill_where['status'] = '1';
		$all_skills = Skill::where($skill_where)->orderBy('skill_name', 'ASC')->get();
		//dd($all_skills); exit;
		
		$all_category = getCategorySubcategory(array('parent_category_id'=>'0', 'status'=>'1'), 0);
		
		$all_subCategory = getCategorySubcategory(array('status'=>'1'), 1);
		//dd($all_subCategory); exit;
		
		return view('jobs/edit_jobs', compact(
			'data',
			'experiencelevel',
			'budget',
			'projectLength',
			'turn_around_time',
			'all_skills',
			'all_category',
			'all_subCategory',
			'successMsg',
			'jobDet',
			'requiredSkillsAry',
			'assesments',
			'activeMenuHeader',
			'JobType'
		));
	}
}
