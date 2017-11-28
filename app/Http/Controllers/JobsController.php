<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
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
use App\Jobasset;
use App\JobRating;
use App\UserNotification;
use App\MonthlyBidDetail;
use Image;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use Stripe;
use StripeCharge;
use StripeCustomer;

class JobsController extends Controller
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
	
	public function postNewJob(Request $request)
	{
		if(checkPrivilege(2)){
			return redirect('/user/dashboard');
		}
		
		$data = [];
		$successMsg = '';
		$activeMenuHeader = 'Jobs';
		$authUser = Auth::user()->id;
		/*$myParams = array_keys($_GET);
		$postJobForUser = "0";
		$authUserName = Auth::user()->first_name.' '.Auth::user()->last_name;

		if( in_array('task', $myParams) && in_array('for', $myParams) ){
			if(count($myParams)==2){
				$encryptStr = config('constants.FIXED_ENCRYPT_STRING');
				try {
					$postJobForUser = substr(decrypt(app('request')->input('for'), $encryptStr), 3, -3);
				}
				catch (\Exception $e) {
					return redirect('/user/dashboard');
				}
			}else{
				return redirect('/user/dashboard');
			}
			//exit;
		}*/
		
		
		if( $request->isMethod('post') ){
			$post_data = $request->all();
			//debug($post_data); exit;
			$this->validate($request, [
				'experience_level'=>'required|numeric',
				'project_length'=>'required|numeric',
				'location'=>'required|string',
				'turn_around_time'=>'required|numeric',
				'budget_type'=>'required|numeric',

				'paymentType'=>'string',
				//'roundsOfRevisions'=>'string',
				
				'needs_to_design_job'=>'required|string',
				'category'=>'required|numeric',
				'subcategory'=>'required|numeric',
				'job_description'=>'required|string',
				'skills'=>'',
				'attached_file'=>'mimes:jpg,jpeg,png,pdf,doc,docx|max:10000',
				'agree_terms_conditions'=>'required|numeric',
			],[
                'attached_file.mimes' => 'Attachments should be jpg, jpeg, png, pdf, doc, docx type',
                'attached_file.max' => 'Maximum of 10 MB is allowed for attached file'
            ]);
			
			//debug($post_data); exit;
			
			$posted_skills = $post_data['skills'];
			$posted_assesments = isset($post_data['freelancer_assessment']) ? $post_data['freelancer_assessment'] : array();
			
			$postedjobs = new Postedjobs;
			
			if($request->hasFile('attached_file'))
			{
				$image  = $request->file('attached_file');
				$upload_path = public_path().'/assets/upload/post_job_files/';
				$fileName = time().str_random(10).'-DOC.'.$image->getClientOriginalExtension();
				$sourcePath = $_FILES['attached_file']['tmp_name'];
				$targetPath = $upload_path.$fileName;
				
				move_uploaded_file($sourcePath, $targetPath);
				$postedjobs->attached_file = $fileName;
			}
			//exit;
			
			$postedjobs->posted_by_user = $request->user()->id;
			$postedjobs->experience_level = isset($post_data['experience_level'])?$post_data['experience_level']:"";
			$postedjobs->project_length = isset($post_data['project_length'])?$post_data['project_length']:"";
			$postedjobs->location = isset($post_data['location'])?$post_data['location']:"";
			$turnAroundTimeId = $postedjobs->turn_around_time = isset($post_data['turn_around_time'])?$post_data['turn_around_time']:"";
			$postedjobs->job_type = isset($post_data['job_type'])?$post_data['job_type']:"";
			$postedjobs->budget_type = isset($post_data['budget_type'])?$post_data['budget_type']:"";
			$postedjobs->budget_amount = isset($post_data['budget_amount'])?$post_data['budget_amount']:"";
			$postedjobs->paymentType = isset($post_data['paymentType'])?$post_data['paymentType']:"";
			$postedjobs->roundsOfRevisions = isset($post_data['roundsOfRevisions'])?$post_data['roundsOfRevisions']:"";
			$postedjobs->needs_to_design_job = isset($post_data['needs_to_design_job'])?$post_data['needs_to_design_job']:"";
			$postedjobs->category = isset($post_data['category'])?$post_data['category']:"";
			$postedjobs->subcategory = isset($post_data['subcategory'])?$post_data['subcategory']:"";
			$postedjobs->job_description = isset($post_data['job_description'])?$post_data['job_description']:"";
			$postedjobs->created_at = date('Y-m-d H:i:s');
			$postedjobs->have_assesment = count($posted_assesments) > 0 ? '1' : '0';
			$postedjobs->job_reference_id = time().mt_rand('11111', '99999');

			$fetchDetails = TurnAroundTime::find($turnAroundTimeId);
			$isNeedPayment = '0';
			$needToPay = '0.00';
	    	if($fetchDetails->is_need_payment == 'Y'){
	    		$debitedBalance = getTotalDebitedOrCreditedBalance($authUser, 'D');
		        $creditedBalance = getTotalDebitedOrCreditedBalance($authUser, 'C');
		        $myWalletBalance = $creditedBalance - $debitedBalance;
		        if($myWalletBalance < $fetchDetails->payable_amount){
		        	$isNeedPayment = '1';
		        	$needToPay = $fetchDetails->payable_amount - $myWalletBalance;
		        	$fetchNonPayableTurnAroundTime = TurnAroundTime::where(['is_need_payment'=>'N'])->first();
		        	$postedjobs->turn_around_time = count($fetchNonPayableTurnAroundTime)?$fetchNonPayableTurnAroundTime->id:"";
		        }
	    	}
			
			$postedjobs->save();
			$insertedId = $postedjobs->id;
			//debug($insertedId); exit;
			
			if((int)$insertedId > 0){
				if(count($posted_skills) > 0){
					for($sk=0; $sk<count($posted_skills); $sk++){
						$jobsSkills = new JobSkillMap;
						$jobsSkills->job_id = $insertedId;
						$jobsSkills->skill_id = $posted_skills[$sk];
						$jobsSkills->save();
					}
				}
				
				if(count($posted_assesments) > 0){
					for($sk=0; $sk<count($posted_assesments); $sk++){
						if(!empty($posted_assesments[$sk])){
							$jobAssesments = new JobAssesments;
							$jobAssesments->job_id = $insertedId;
							$jobAssesments->assesments = $posted_assesments[$sk];
							$jobAssesments->save();
						}
					}
				}
				$successMsg = 'Successfully Created';
			}
			//exit;

			if($isNeedPayment=='1')
			{
				//echo 'A'; exit;
				//$this->payNowForJobPost($insertedId, $needToPay);
				return redirect('/jobs/pay-now-for-job-post/'.$insertedId.'/'.$turnAroundTimeId.'/'.$needToPay);
			}
			else
			{
				//echo 'B'; exit;
				//credit to admin's wallet
				if($fetchDetails->is_need_payment == 'Y')
				{
					$user_transaction = new UserTransaction;
			        $user_transaction->user_id = 0;
			        $user_transaction->job_id = $insertedId;
			        $user_transaction->proposal_id = 0;
			        $user_transaction->transaction_id = "WO".generatePin()."-".$insertedId;
			        $user_transaction->amount = $fetchDetails->payable_amount;
			        $user_transaction->paid_by = 'D';
			        $user_transaction->transaction_type = "C";
			        $user_transaction->payment_for = "Post jobs";
			        $user_transaction->payment_status = "Y";
			        $user_transaction->save();

			        //debit from user wallet
			        $user_transaction = new UserTransaction;
			        $user_transaction->user_id = Auth::user()->id;
			        $user_transaction->job_id = $insertedId;
			        $user_transaction->proposal_id = 0;
			        $user_transaction->transaction_id = "WO".generatePin()."-".$insertedId;
			        $user_transaction->amount = $fetchDetails->payable_amount;
			        $user_transaction->paid_by = 'D';
			        $user_transaction->transaction_type = "D";
			        $user_transaction->payment_for = "Post jobs";
			        $user_transaction->payment_status = "Y";
			        $user_transaction->save();
			    }
			}
		}
		//exit;
		
		
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
		
		return view('jobs/post_jobs', compact(
			'data',
			'experiencelevel',
			'budget',
			'projectLength',
			'turn_around_time',
			'all_skills',
			'all_category',
			'all_subCategory',
			'successMsg',
			'activeMenuHeader',
			'JobType'
		));
	}

	public function payNowForJobPost($job_id=0, $turnAroundTimeId=0, $payableAmnt='0.00')
	{
		
		$user = Auth::user()->id;
		
        $jobprovider_transaction = new JobproviderTransaction;
        $jobprovider_transaction->user_id = $user;
        $jobprovider_transaction->job_id= $job_id;
        //$jobprovider_transaction->proposal_id = $proposal_id;
        $jobprovider_transaction->payment_type = 'S';
        $jobprovider_transaction->amount = $payableAmnt;
        $jobprovider_transaction_id = $jobprovider_transaction->save();
        //dd($jobprovider_transaction_id);
        $jobprovider_transaction->transaction_no = "WO".generatePin()."-".$jobprovider_transaction->id.'-'.$job_id.'-'.$turnAroundTimeId;
        $jobprovider_transaction->save();

        $config = [];
        if($jobprovider_transaction->payment_type == "S")
        {
        	$key = config('constants.FIXED_ENCRYPT_STRING');
        	$encryptedTXNID = encrypt($jobprovider_transaction->transaction_no, $key);
            return redirect('/jobs/stripe-form-for-job-post/'.$encryptedTXNID);
        }

        //return response()->json($config);
	}
	
	public function stripeFormForJobPost($txn=0)
    {
		//echo $txn; exit;
		if(!empty(trim($txn)))
		{
			$key = config('constants.FIXED_ENCRYPT_STRING');
			$txn = decrypt($txn, $key);
			$txnArray = explode("-", $txn);
			$job_id = isset($txnArray[2]) ? $txnArray[2] : 0;
			$JobproviderTransaction = JobproviderTransaction::where(['transaction_no'=>$txn])->first();

			if(isset($job_id) && (int)$job_id > 0)
			{
				//dd($txn); exit;
				$amount = $JobproviderTransaction->amount;
				$txn = encrypt($txn, $key);
				return view('jobs/stripe_form_for_job_post', compact('amount','txn'));
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
	
	public function stripePaymentForJobPost($txn=0, Request $request)
    {
    	//print_r($_POST); exit;
		if(!empty(trim($txn)))
		{
			$key = config('constants.FIXED_ENCRYPT_STRING');
			$encryptedTXNID = $txn;
			$txn = decrypt($txn, $key);
			$txnArray = explode("-", $txn);
			$job_id = isset($txnArray[2]) ? $txnArray[2] : 0;
			$amount = $request->amount;
			$saughtTurnAroundTime = isset($txnArray[3]) ? $txnArray[3] : 0;
			
			if(isset($job_id) && (int)$job_id > 0 && $amount > 0)
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
				   $this->successfulPaymentForJobPost($encryptedTXNID);
				   $this->notifyPaymentForJobPost($txn, response()->json($retrieve));
				   return redirect('/jobs/send-proposal/'.$job_id);
				}
				catch(\Stripe\Error\Card $e)
				{
					$body = $e->getJsonBody();
					$err  = $body['error'];
					$this->cancelPaymentForJobPost($txn);
					$this->notifyPaymentForJobPost($txn, response()->json($err));
					return redirect('/jobs/send-proposal/'.$job_id);
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

    public function paypalReturnForJobPost($txn)
    {
	   $this->successfulPayment($txn);
	   return redirect('membership')->with('success', 'Enrolled to premium membership');
    }
	
    public function paypalNotifyForJobPost($txn,Request $request)
    {
        $input =$request->all();
        $this->notifyPaymentForJobPost($txn, response()->json($input));
    }
	
    public function paypalCancelForJobPost($txn)
    {
        $this->cancelPaymentForJobPost($txn);
        return redirect('membership')->with('error', 'Transaction failed for premium membership');
    }
	
    private function successfulPaymentForJobPost($txn)
    {
    	$key = config('constants.FIXED_ENCRYPT_STRING');
		$encryptedTXNID = $txn;
		$txn = decrypt($txn, $key);

    	$authUserId = Auth::user()->id;
		$authUserName = Auth::user()->first_name.' '.Auth::user()->last_name;

		$txnArray = explode("-", $txn);
		$job_id = isset($txnArray[2]) ? $txnArray[2] : 0;
		$saughtTurnAroundTime = isset($txnArray[3]) ? $txnArray[3] : 0;
		
		$jobprovider_transaction = JobproviderTransaction::where('transaction_no', $txn)->first();
        $jobprovider_transaction->payment_status = "S";
        $jobprovider_transaction->save();

        //Credit to user wallet
        $user_transaction = new UserTransaction;
        $user_transaction->user_id = Auth::user()->id;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "C";
        $user_transaction->payment_for = "Highlight bid";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        //debit from user wallet
        $user_transaction = new UserTransaction;
        $user_transaction->user_id = Auth::user()->id;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "D";
        $user_transaction->payment_for = "Highlight bid";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        //Credit to admin's wallet
        $user_transaction = new UserTransaction;
        $user_transaction->user_id = 0;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = 0;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "C";
        $user_transaction->payment_for = "Post jobs";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        $fetchDetails = TurnAroundTime::find($saughtTurnAroundTime);
        $restAmount = ($fetchDetails->payable_amount-$jobprovider_transaction->amount);
        if($restAmount > 0){
        	//Credit to admin's wallet
        	$user_transaction = new UserTransaction;
	        $user_transaction->user_id = 0;
	        $user_transaction->job_id = $job_id;
	        $user_transaction->proposal_id = 0;
	        $user_transaction->transaction_id = "WO".generatePin()."-".$job_id.'-'.$saughtTurnAroundTime;
	        $user_transaction->amount = $restAmount;
	        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
	        $user_transaction->transaction_type = "C";
	        $user_transaction->payment_for = "Post jobs";
	        $user_transaction->payment_status = "Y";
	        $user_transaction->save();

	        //debit from user wallet
	        $user_transaction = new UserTransaction;
	        $user_transaction->user_id = Auth::user()->id;
	        $user_transaction->job_id = $job_id;
	        $user_transaction->proposal_id = 0;
	        $user_transaction->transaction_id = "WO".generatePin()."-".$job_id.'-'.$saughtTurnAroundTime;
	        $user_transaction->amount = $restAmount;
	        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
	        $user_transaction->transaction_type = "D";
	        $user_transaction->payment_for = "Post jobs";
	        $user_transaction->payment_status = "Y";
	        $user_transaction->save();
        }
		
		$jobStatus['turn_around_time'] = $saughtTurnAroundTime;
		$jobStatus['is_urgent_assignment'] = 'Y';
		Postedjobs::where(['job_id'=>$job_id])->update($jobStatus);
    }
	
    private function cancelPaymentForJobPost($txn)
    {
        $jobprovider_transaction = JobproviderTransaction::where('transaction_no',$txn)->first();
        $jobprovider_transaction->payment_status = "C";
        $jobprovider_transaction->save();
    }
	
    private function notifyPaymentForJobPost($txn,$response)
    {
        $jobprovider_transaction = JobproviderTransaction::where('transaction_no',$txn)->first();
        $jobprovider_transaction->payment_gateway_response = $response;
        $jobprovider_transaction->save();
    }
	
	public function jobsListByUser($id=0, Request $request)
	{
		if(checkPrivilege(2))
		{
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
		$inprogressJobList = Postedjobs::where($where)->orderBy('job_id', 'desc')->get()->count();
		
		//Pending
		$where['job_status'] = '1';
		$pendingJobList = Postedjobs::where($where)->orderBy('job_id', 'desc')->get()->count();
		
		//Completed
		$where['job_status'] = '4';
		$completedJobList = Postedjobs::where($where)->orderBy('job_id', 'desc')->get()->count();
		
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
			//print_r($jobList); exit;
			
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
		if($jobDet->posted_by_user != $authUser || $jobDet->job_status=='2' || $jobDet->job_status=='4')
		{
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
		
		$all_subCategory = $jobDet->category ? getCategorySubcategory(array('status'=>'1', 'parent_category_id'=>$jobDet->category), 1) : array();
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
	
	public function updatePostedJob(Request $request)
	{
		if(checkPrivilege(2)){
			return redirect('/user/dashboard');
		}
		
		if( $request->isMethod('post') ){
			$post_data = $request->all();
			$job_id = $id = $post_data['id'];
			$authUser = Auth::user()->id;
			
			//debug($post_data); exit;
			$this->validate($request, [
				'experience_level'=>'required|numeric',
				'project_length'=>'required|numeric',
				'location'=>'required|string',
				'turn_around_time'=>'required|numeric',
				'budget_type'=>'required|numeric',

				'paymentType'=>'string',
				//'roundsOfRevisions'=>'string',
				
				'needs_to_design_job'=>'required|string',
				'category'=>'required|numeric',
				'subcategory'=>'required|numeric',
				'job_description'=>'required|string',
				'skills'=>'required',
				'attached_file'=>'mimes:jpg,jpeg,png,pdf,doc,docx|max:10000',
				'agree_terms_conditions'=>'required|numeric',
			],[
                'attached_file.mimes' => 'Attachments should be jpg, jpeg, png, pdf, doc, docx type',
                'attached_file.max' => 'Maximum of 10 MB is allowed for attached file'
            ]);
			
			//debug($post_data); exit;
			
			$posted_skills = $post_data['skills'];
			$posted_assesments = isset($post_data['freelancer_assessment']) ? $post_data['freelancer_assessment'] : array();
			
			//$postedjobs = new Postedjobs;
			$postedjobs = Postedjobs::where('job_id', $job_id)->first();
			
			$updateJob = array();
			if($request->hasFile('attached_file'))
			{
				if($postedjobs->attached_file){
					$old_file = '/assets/upload/post_job_files/'.$postedjobs->attached_file;
					\File::delete($old_file);
				}
				
				$image  = $request->file('attached_file');
				$upload_path = public_path().'/assets/upload/post_job_files/';
				$fileName = time().str_random(10).'-DOC.'.$image->getClientOriginalExtension();
				$sourcePath = $_FILES['attached_file']['tmp_name'];
				$targetPath = $upload_path.$fileName;
				
				move_uploaded_file($sourcePath, $targetPath);
				$postedjobs->attached_file = $fileName;
			}
			//exit;
			
			$updateJob['posted_by_user'] = $postedjobs->posted_by_user = $request->user()->id;
			$updateJob['experience_level'] = $postedjobs->experience_level = isset($post_data['experience_level'])?$post_data['experience_level']:"";
			$updateJob['project_length'] = $postedjobs->project_length = isset($post_data['project_length'])?$post_data['project_length']:"";
			$updateJob['location'] = $postedjobs->location = isset($post_data['location'])?$post_data['location']:"";
			
			$turnAroundTimeId = $updateJob['turn_around_time'] = $postedjobs->turn_around_time = isset($post_data['turn_around_time'])?$post_data['turn_around_time']:"";
			
			$updateJob['job_type'] = $postedjobs->job_type = isset($post_data['job_type'])?$post_data['job_type']:"";
			$updateJob['budget_type'] = $postedjobs->budget_type = isset($post_data['budget_type'])?$post_data['budget_type']:"";
			$updateJob['budget_amount'] = $postedjobs->budget_amount = isset($post_data['budget_amount'])?$post_data['budget_amount']:"";


			$updateJob['paymentType'] = $postedjobs->paymentType = isset($post_data['paymentType'])?$post_data['paymentType']:"";
			$updateJob['roundsOfRevisions'] = $postedjobs->roundsOfRevisions = isset($post_data['roundsOfRevisions'])?$post_data['roundsOfRevisions']:"";

			$updateJob['needs_to_design_job'] = $postedjobs->needs_to_design_job = isset($post_data['needs_to_design_job'])?$post_data['needs_to_design_job']:"";
			$updateJob['category'] = $postedjobs->category = isset($post_data['category'])?$post_data['category']:"";
			$updateJob['subcategory'] = $postedjobs->subcategory = isset($post_data['subcategory'])?$post_data['subcategory']:"";
			$updateJob['job_description'] = $postedjobs->job_description = isset($post_data['job_description'])?$post_data['job_description']:"";
			$updateJob['created_at'] = $postedjobs->created_at = date('Y-m-d H:i:s');
			$updateJob['have_assesment'] = $postedjobs->have_assesment = count($posted_assesments) > 0 ? '1' : '0';
			//dd($updateJob);



			$fetchDetails = TurnAroundTime::find($turnAroundTimeId);
			$isNeedPayment = '0';
			$needToPay = '0.00';
	    	if($fetchDetails->is_need_payment == 'Y' && $postedjobs->is_urgent_assignment=='N')
	    	{
	    		$debitedBalance = getTotalDebitedOrCreditedBalance($authUser, 'D');
		        $creditedBalance = getTotalDebitedOrCreditedBalance($authUser, 'C');
		        $myWalletBalance = $creditedBalance - $debitedBalance;
		        if($myWalletBalance < $fetchDetails->payable_amount)
		        {
		        	$isNeedPayment = '1';
		        	$needToPay = $fetchDetails->payable_amount - $myWalletBalance;
		        	$fetchNonPayableTurnAroundTime = TurnAroundTime::where(['is_need_payment'=>'N'])->first();
		        	$updateJob['turn_around_time'] = count($fetchNonPayableTurnAroundTime)?$fetchNonPayableTurnAroundTime->id:"";
		        }
	    	}


			//$postedjobs->save();
			Postedjobs::where('job_id', $job_id)->update($updateJob);
			$insertedId = $id;
			//debug($insertedId); exit;
			
			if((int)$insertedId > 0){
				JobSkillMap::where('job_id', $id)->delete();
				if(count($posted_skills) > 0){
					for($sk=0; $sk<count($posted_skills); $sk++){
						$jobsSkills = new JobSkillMap;
						$jobsSkills->job_id = $insertedId;
						$jobsSkills->skill_id = $posted_skills[$sk];
						$jobsSkills->save();
					}
				}
				
				JobAssesments::where('job_id', $id)->delete();
				if(count($posted_assesments) > 0){
					for($sk=0; $sk<count($posted_assesments); $sk++){
						if(!empty($posted_assesments[$sk])){
							$jobAssesments = new JobAssesments;
							$jobAssesments->job_id = $insertedId;
							$jobAssesments->assesments = $posted_assesments[$sk];
							$jobAssesments->save();
						}
					}
				}
				$successMsg = 'Successfully Created';
			}
			//exit;

			if($isNeedPayment=='1')
			{
				//echo 'A'; exit;
				//$this->payNowForJobPost($insertedId, $needToPay);
				return redirect('/jobs/pay-now-for-job-post/'.$insertedId.'/'.$turnAroundTimeId.'/'.$needToPay);
			}
			elseif($postedjobs->is_urgent_assignment=='N' && $fetchDetails->is_need_payment == 'Y')
			{
				//echo 'B'; exit;
				//Credit to admin's wallet
				$user_transaction = new UserTransaction;
		        $user_transaction->user_id = 0;
		        $user_transaction->job_id = $insertedId;
		        $user_transaction->proposal_id = 0;
		        $user_transaction->transaction_id = "WO".generatePin()."-".$insertedId;
		        $user_transaction->amount = $fetchDetails->payable_amount;
		        $user_transaction->paid_by = 'D';
		        $user_transaction->transaction_type = "C";
		        $user_transaction->payment_for = "Post jobs";
		        $user_transaction->payment_status = "Y";
		        $user_transaction->save();

		        //Debit from users wallet
		        $user_transaction = new UserTransaction;
		        $user_transaction->user_id = Auth::user()->id;
		        $user_transaction->job_id = $insertedId;
		        $user_transaction->proposal_id = 0;
		        $user_transaction->transaction_id = "WO".generatePin()."-".$insertedId;
		        $user_transaction->amount = $fetchDetails->payable_amount;
		        $user_transaction->paid_by = 'D';
		        $user_transaction->transaction_type = "D";
		        $user_transaction->payment_for = "Post jobs";
		        $user_transaction->payment_status = "Y";
		        $user_transaction->save();
			}
		}
		
		return redirect()->back()->with('success', 'Updated successfully.');
	}
	
	public function jobsSearchListByUser(Request $request)
	{
		if(checkPrivilege(1)){
			return redirect('/user/dashboard');
		}
		
		$data = [];
		$user = Auth::user();
		$json_array['response_status'] = 0;
		$json_array['response_data'] = '';
		$per_page = config('constants.JOBS_PER_PAGE');
		$activeMenuHeader = 'Jobs';
		
		$jobsAppliedByUser = JobProposal::where([
			'sent_by_user'=>$user['id']
		])->get();
		$jobIdsArray = array();
		if(count($jobsAppliedByUser) > 0){
			foreach($jobsAppliedByUser as $eachJob){
				$jobIdsArray[] = $eachJob->job_id;
			}
		}
		
		if($request->isAjax){
			//$request->isMethod('post');
			$input = $request->all();
			$subCategory = app('request')->input('subCategory');
            $project_cost = app('request')->input('project_cost');
            $job_type = app('request')->input('job_type');
            $project_length = app('request')->input('project_length');
            $location = app('request')->input('location');
            $location_surrounding = app('request')->input('location_surrounding');
            $searchText = app('request')->input('searchText');
			$pagination = app('request')->input('pagination');
			$jobs=Postedjobs::where(
					function($query) use ($subCategory, $project_cost, $job_type, $project_length, $location, $location_surrounding, $searchText){
						if($subCategory !="")
						{
							$query->whereIn('subcategory', $subCategory);
						}
						if($project_cost !="")
						{
							$query->where('budget_type', $project_cost);
						}
						if($job_type !="")
						{
							$query->where('job_type', $job_type);
						}
						if($project_length !="")
						{
							$query->where('project_length', $project_length);
						}
						if(trim($location)!="")
						{
							$query->where('location',  'like', '%'. urldecode($location).'%');
						}
						if(trim($searchText)!="")
						{
							$query->where('needs_to_design_job',  'like', '%'. urldecode($searchText).'%');
						}
					}
				)
			//->where('job_status',  '1')
			->where('job_status', '!=', '2')
			->where('job_status', '!=', '4')
			->where('job_status', '!=', '5')
            ->orderBy('job_id', 'desc')->paginate($per_page);
			//debug($jobs); exit;
			
			
			$countString = 'Search result  ' . ((((count($jobs) > 0 ? $jobs->perPage() : 0) * $jobs->currentPage())-$jobs->perPage()) +1);
			$countString .= ' to ';
			if($jobs->currentPage() < $jobs->lastPage()){
				$countString .= ($jobs->perPage() * $jobs->currentPage());
			}else{
				$countString .= $jobs->total();
			}
			$countString .= ' of ';
			$countString .= $jobs->total().' found';
			
			$returnHTML = view('jobs/postedJobDatalist', compact(
				'jobs',
				'pagination',
				'jobIdsArray'
			))->render();
			$json_array['response_status'] = 1;
			$json_array['countString'] = $countString;
			$json_array['response_data'] = $returnHTML;
			
			return \Response::json($json_array);
		}else{
			$where['job_status'] = '1';
			$jobs = Postedjobs::where('job_status', '!=', '4')
					->where('job_status', '!=', '2')
					->where('job_status', '!=', '5')
					->orderBy('job_id', 'desc')
					->paginate($per_page);
		}
		//dd($jobs); exit;
		
		$countString = 'Search result  ' . ((( (count($jobs) > 0 ? $jobs->perPage() : 0) * $jobs->currentPage())-$jobs->perPage()) +1);
		$countString .= ' to ';
		if($jobs->currentPage() < $jobs->lastPage()){
			$countString .= ($jobs->perPage() * $jobs->currentPage());
		}else{
			$countString .= $jobs->total();
		}
		$countString .= ' of ';
		$countString .= $jobs->total().' found';
		
		$locationSearchSurroundings = array('5'=>'5km', '10'=>'10km', '20'=>'20km', '50'=>'50km', '200'=>'200km');
		$cat_subcat_where['status'] = '1';
		$allCategory = CategorySubcategory::where($cat_subcat_where)->get();
		//dd($allCategory); exit;
		
		$explevel_where['status'] = '1';
		$experiencelevel = ExperienceLevel::where($explevel_where)->get();
		//dd($experiencelevel); exit;
		
		$budget_where['status'] = '1';
		$budget = Budget::where($budget_where)->get();
		//dd($budget); exit;

		$jobtype_where['status'] = '1';
		$JobType = JobType::where($jobtype_where)->get();
		//dd($JobType); exit;
		
		$projectLength_where['status'] = '1';
		$projectLength = ProjectLength::where($projectLength_where)->get();
		//dd($projectLength); exit;
		
		$turn_around_time_where['status'] = '1';
		$turn_around_time = TurnAroundTime::where($turn_around_time_where)->get();
		//dd($turn_around_time); exit;
		
		$skill_where['status'] = '1';
		$all_skills = Skill::where($skill_where)->orderBy('skill_name', 'ASC')->get();
		//dd($all_skills); exit;
		
		$jType_where['status'] = '1';
		$all_jType = JobType::where($jType_where)->orderBy('job_title', 'ASC')->get();
		//dd($all_skills); exit;
		
		$all_category = getCategorySubcategory(array('parent_category_id'=>'0', 'status'=>'1'), 0);
		
		$all_subCategory = getCategorySubcategory(array('status'=>'1'), 1);
		
		return view('jobs/job_search_list', compact(
			'data',
			'jobs',
			'countString',
			'allCategory',
			'experiencelevel',
			'budget',
			'projectLength',
			'turn_around_time',
			'all_skills',
			'all_jType',
			'all_category',
			'all_subCategory',
			'locationSearchSurroundings',
			'jobIdsArray',
			'activeMenuHeader',
			'JobType'
		));
	}
	
	public function sendJobProposal(Request $request, $job_id=0)
    {
		if(checkPrivilege(1) || (int)$job_id==0){
			return redirect('/user/dashboard');
		}
		$activeMenu = 'Overview';
		$activeMenuHeader = 'Jobs';
		$authUserId = Auth::user()->id;
		$authUserName = Auth::user()->first_name.' '.Auth::user()->last_name;
		
        //echo $job_id; exit;
		$job_id = (int)$job_id;
		$jobDetails = Postedjobs::where([
					'job_id'=>$job_id
				])
				//->where('job_status', '!=', '4')
				->first();
		//dd($jobDetails); exit;
		
		$proposalSentByUser = JobProposal::where([
			'sent_by_user'=>Auth::user()->id,
			'job_id'=>$job_id
		])->first();
		
		$proposalEstimatedAmount = array();
		if(count($proposalSentByUser) > 0){
			$proposalEstimatedAmount = JobProposalAmount::where([
				'proposal_id'=>$proposalSentByUser->proposal_id,
				'job_id'=>$job_id
			])->get();
		}
		//dd($jobDetails); exit;
		
		/*if(@$jobDetails->job_id == 0){
			return redirect('/user/dashboard');
		}*/
		
		$jobPostedByUserID = isset($jobDetails->posted_by_user) ? $jobDetails->posted_by_user : '';
		$jobUserDetails = User::where(['id'=>$jobPostedByUserID])
					->first();
		//dd($jobUserDetails); exit;
		
		$jobRequiredSkills = JobSkillMap::where(['job_id'=>$job_id])
					->get();
		//dd($jobRequiredSkills); exit;
		$requiredSkillNames = getSkillsByJobId($job_id);
		$successMsg = '';
		
		if($request->isMethod('post'))
		{
			$post_data = $request->all();
			//debug($post_data); exit;
			
			$this->validate($request, [
				'proposal_description'=>'required|string',
				'interview_question_challanges'=>'required|string',
				'attached_file'=>'required|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10000',
				'terms_conditions'=>'required|numeric',
			],[
                'attached_file.mimes' => 'Attachments should be jpg, jpeg, png, pdf, doc, docx, xls, xlsx type',
                'attached_file.max' => 'Maximum of 10 MB is allowed for attached file'
            ]);
			
			//debug($post_data); exit;
			
			$jobProposal = new JobProposal;
			
			if($request->hasFile('attached_file'))
			{
				$image  = $request->file('attached_file');
				$upload_path = public_path().'/assets/upload/job_proposal_files/';
				$fileName = time().str_random(10).'-DOC.'.$image->getClientOriginalExtension();
				$sourcePath = $_FILES['attached_file']['tmp_name'];
				$targetPath = $upload_path.$fileName;
				
				move_uploaded_file($sourcePath, $targetPath);
				$jobProposal->attached_file = $fileName;
			}
			//exit;
			
			$jobProposal->sent_by_user = Auth::user()->id;
			$jobProposal->job_id = $job_id;
			$jobProposal->description = isset($post_data['proposal_description']) ? $post_data['proposal_description'] : "";
			$jobProposal->interview_question_challanges = isset($post_data['interview_question_challanges']) ? $post_data['interview_question_challanges'] : "";
			$jobProposal->created_at = date('Y-m-d H:i:s');
			$jobProposal->proposal_referance_no = 'JP'.time().mt_rand('111', '999');
			
			$is_highlight_bid = $jobProposal->is_highlight_bid = isset($post_data['highlight_bid']) && $post_data['highlight_bid']=='1' ? 'Y' : "N";

			$isNeedPayment = '0';
			$needToPay = '0.00';
			$jobSettings = getJobSettings();
			if($is_highlight_bid == 'Y')
			{
				$debitedBalance = getTotalDebitedOrCreditedBalance($authUserId, 'D');
		        $creditedBalance = getTotalDebitedOrCreditedBalance($authUserId, 'C');
		        $myWalletBalance = $creditedBalance - $debitedBalance;
		        if(
		        	isset($jobSettings->highlight_bid_fee) && 
		        	$jobSettings->highlight_bid_fee > 0 && 
		        	$myWalletBalance < $jobSettings->highlight_bid_fee
		        ){
		        	$isNeedPayment = '1';
		        	$needToPay = $jobSettings->highlight_bid_fee - $myWalletBalance;
		        	$jobProposal->is_highlight_bid = 'N';
		        }
			}


			$jobProposal->save();
			$insertedId = $jobProposal->id;
			
			$jobDetails = Postedjobs::where(['job_id'=>$job_id])->first();
			//dd($jobDetails); exit;
			$total_proposal = $jobDetails->total_proposal +1;
			//$postedJobs = new Postedjobs;
			$postedJobs['total_proposal'] = $total_proposal;
			Postedjobs::where(['job_id'=>$job_id])->update($postedJobs);
			
			if(count($post_data['item_description']) > 0 && count($post_data['amount']) > 0)
			{
				$count = count($post_data['item_description']) > count($post_data['amount']) ? count($post_data['item_description']) : count($post_data['amount']);
				for($i=0; $i<$count; $i++)
				{
					$proposalAmount = new JobProposalAmount;
					if(trim($post_data['item_description'][$i]) != '')
					{
						//debug(); exit;
						$proposalAmount->job_id = $job_id;
						$proposalAmount->sent_by_user = Auth::user()->id;
						$proposalAmount->proposal_id = $insertedId;
						$proposalAmount->item_description = $post_data['item_description'][$i];
						$proposalAmount->amount = (int)$post_data['amount'][$i];
						$proposalAmount->save();
					}
				}

				$UserNotification = new UserNotification;
				$UserNotification->user_id = $jobDetails->posted_by_user;
				$UserNotification->sent_by_user = Auth::user()->id;
				$UserNotification->title = '';
				$notificationMsg = config("constants.SEND_PROPOSAL_NOTIFICATION_MSG");
				$UserNotification->short_description = substr(str_replace('{{NAME}}', $authUserName, $notificationMsg), 0, 255);
				$UserNotification->full_description = str_replace('{{NAME}}', $authUserName, $notificationMsg);
				$UserNotification->notification_link = '/jobs/view-project/'.$job_id;
				$UserNotification->viewed_status = 'N';
				$UserNotification->created_at = date('Y-m-d H:i:s');
				$UserNotification->save();
			}
			$successMsg = 'Proposal Sent Successfully';

			//Deduct bid credit start
			$requredBidToSendProposal = $jobSettings->normal_fee_per_bid;
			$availableBids = getBidCreditsDebits(Auth::user()->id, date('m-Y'));
			$freeBidCredit = isset($availableBids->freeBidCredit) ? $availableBids->freeBidCredit : '0';
			$freeBidDebit = isset($availableBids->freeBidDebit) ? $availableBids->freeBidDebit : '0';
			$paidBidCredit = isset($availableBids->paidBidCredit) ? $availableBids->paidBidCredit : '0';
			$paidBidDebit = isset($availableBids->paidBidDebit) ? $availableBids->paidBidDebit : '0';
			$availableFreeBid = ($freeBidCredit-$freeBidDebit);
			$availablePaidBid = ($paidBidCredit-$paidBidDebit);
			if($requredBidToSendProposal > 0){
				if($availableFreeBid>=$requredBidToSendProposal){
					$amount_type = 'F';
				}else{
					$amount_type = 'P';
				}
				$monthly_bid_detail = new MonthlyBidDetail;
				$monthly_bid_detail->user_id = Auth::user()->id;
				$monthly_bid_detail->job_id = $job_id;
				$monthly_bid_detail->proposal_id = $insertedId;
				$monthly_bid_detail->bid_debited_credit_amount = $requredBidToSendProposal;
				$monthly_bid_detail->type = 'D';
				$monthly_bid_detail->amount_type = $amount_type;
				$monthly_bid_detail->created_at = date('Y-m-d H:i:s');
				$monthly_bid_detail->save();
			}
			//Deduct bid credit end

			if($isNeedPayment=='1'){
				//echo 'A'; exit;
				//$this->payNowForJobPost($insertedId, $needToPay);
				return redirect('/jobs/pay-now-for-send-proposal/'.$job_id.'/'.$insertedId.'/'.$needToPay);
			}
			else
			{
				if($is_highlight_bid == 'Y')
				{
					//echo 'B'; exit;
					//Credit to admin's wallet
					$user_transaction = new UserTransaction;
			        $user_transaction->user_id = 0;
			        $user_transaction->job_id = $jobProposal->job_id;
			        $user_transaction->proposal_id = $insertedId;
			        $user_transaction->transaction_id = "WO".generatePin()."-".$job_id."-".$insertedId;
			        $user_transaction->amount = $jobSettings->highlight_bid_fee;
			        $user_transaction->paid_by = 'D';
			        $user_transaction->transaction_type = "C";
			        $user_transaction->payment_for = "Highlight bid";
			        $user_transaction->payment_status = "Y";
			        $user_transaction->save();

			        //Debit from users wallet
			        $user_transaction = new UserTransaction;
			        $user_transaction->user_id = Auth::user()->id;
			        $user_transaction->job_id = $job_id;
			        $user_transaction->proposal_id = $insertedId;
			        $user_transaction->transaction_id = "WO".generatePin()."-".$job_id."-".$insertedId;
			        $user_transaction->amount = $jobSettings->highlight_bid_fee;
			        $user_transaction->paid_by = 'D';
			        $user_transaction->transaction_type = "D";
			        $user_transaction->payment_for = "Highlight bid";
			        $user_transaction->payment_status = "Y";
			        $user_transaction->save();
				}
			}
			
			return redirect('/jobs/send-proposal/'.$job_id)->with('success', 'Proposal Sent Successfully');
		}
		
		
		return view('jobs/send_job_proposal', compact(
			'job_id',
			'jobPostedByUserID',
			'jobDetails',
			'jobUserDetails',
			'jobRequiredSkills',
			'requiredSkillNames',
			'successMsg',
			'proposalSentByUser',
			'proposalEstimatedAmount',
			'activeMenu',
			'activeMenuHeader'
		));
    }

    public function editJobProposal(Request $request, $job_id=0)
    {
		if(checkPrivilege(1) || (int)$job_id==0){
			return redirect('/user/dashboard');
		}
		$activeMenu = 'Overview';
		$activeMenuHeader = 'Jobs';
		$authUserId = Auth::user()->id;
		$authUserName = Auth::user()->first_name.' '.Auth::user()->last_name;
		
        //echo $job_id; exit;
		$job_id = (int)$job_id;
		$jobDetails = Postedjobs::where([
					'job_id'=>$job_id
				])
				//->where('job_status', '!=', '4')
				->first();
		//dd($jobDetails); exit;
		
		$proposalSentByUser = JobProposal::where([
			'sent_by_user'=>Auth::user()->id,
			'job_id'=>$job_id
		])->first();
		
		$proposalEstimatedAmount = array();
		if(count($proposalSentByUser) > 0){
			$proposalEstimatedAmount = JobProposalAmount::where([
				'proposal_id'=>$proposalSentByUser->proposal_id,
				'job_id'=>$job_id
			])->get();
		}
		//print_r($proposalSentByUser); exit;
		
		/*if(@$jobDetails->job_id == 0){
			return redirect('/user/dashboard');
		}*/
		
		$jobPostedByUserID = isset($jobDetails->posted_by_user) ? $jobDetails->posted_by_user : '';
		$jobUserDetails = User::where(['id'=>$jobPostedByUserID])
					->first();
		//dd($jobUserDetails); exit;
		
		$jobRequiredSkills = JobSkillMap::where(['job_id'=>$job_id])
					->get();
		//dd($jobRequiredSkills); exit;
		$requiredSkillNames = getSkillsByJobId($job_id);
		$successMsg = '';
		
		if($request->isMethod('post'))
		{
			$post_data = $request->all();
			$proposal_id = $post_data['proposal_id'];
			//debug($post_data); exit;
			
			$this->validate($request, [
				'proposal_description'=>'required|string',
				'interview_question_challanges'=>'required|string',
				'attached_file'=>'mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10000',
				'terms_conditions'=>'required|numeric',
			],[
                'attached_file.mimes' => 'Attachments should be jpg, jpeg, png, pdf, doc, docx, xls, xlsx type',
                'attached_file.max' => 'Maximum of 10 MB is allowed for attached file'
            ]);
			
			//debug($post_data); exit;
			
			//$jobProposal = new JobProposal;
			$jobProposal = array();
			
			$oldProposal = JobProposal::where(['proposal_id'=>$post_data['proposal_id']])->first();

			if($request->hasFile('attached_file'))
			{
				$ImgPath = "assets/upload/job_proposal_files/".$oldProposal->attached_file;
				unlink($ImgPath);

				$image  = $request->file('attached_file');
				$upload_path = public_path().'/assets/upload/job_proposal_files/';
				$fileName = time().str_random(10).'-DOC.'.$image->getClientOriginalExtension();
				$sourcePath = $_FILES['attached_file']['tmp_name'];
				$targetPath = $upload_path.$fileName;
				
				move_uploaded_file($sourcePath, $targetPath);
				$jobProposal->attached_file = $fileName;
			}
			//exit;
			
			//$jobProposal->sent_by_user = Auth::user()->id;
			//$jobProposal->job_id = $job_id;
			$jobProposal['description'] = isset($post_data['proposal_description']) ? $post_data['proposal_description'] : "";
			$jobProposal['interview_question_challanges'] = isset($post_data['interview_question_challanges']) ? $post_data['interview_question_challanges'] : "";
			$jobProposal['updated_at'] = date('Y-m-d H:i:s');
			//$jobProposal->proposal_referance_no = 'JP'.time().mt_rand('111', '999');
			
			if($oldProposal->is_highlight_bid=='N'){
				$is_highlight_bid = $jobProposal['is_highlight_bid'] = isset($post_data['highlight_bid']) && $post_data['highlight_bid']=='1' ? 'Y' : "N";

				$isNeedPayment = '0';
				$needToPay = '0.00';
				if($is_highlight_bid == 'Y')
				{
					$jobSettings = getJobSettings();
					$debitedBalance = getTotalDebitedOrCreditedBalance($authUserId, 'D');
			        $creditedBalance = getTotalDebitedOrCreditedBalance($authUserId, 'C');
			        $myWalletBalance = $creditedBalance - $debitedBalance;
			        if(
			        	isset($jobSettings->highlight_bid_fee) && 
			        	$jobSettings->highlight_bid_fee > 0 && 
			        	$myWalletBalance < $jobSettings->highlight_bid_fee
			        ){
			        	$isNeedPayment = '1';
			        	$needToPay = $jobSettings->highlight_bid_fee - $myWalletBalance;
			        	$jobProposal['is_highlight_bid'] = 'N';
			        }
				}
			}

			JobProposal::where(['proposal_id'=>$post_data['proposal_id']])->update($jobProposal);
			$insertedId = $proposal_id;
			
			$jobDetails = Postedjobs::where(['job_id'=>$job_id])->first();
			//dd($jobDetails); exit;
			//$total_proposal = $jobDetails->total_proposal +1;
			//$postedJobs = new Postedjobs;
			//$postedJobs['total_proposal'] = $total_proposal;
			//Postedjobs::where(['job_id'=>$job_id])->update($postedJobs);
			
			if(count($post_data['item_description']) > 0 && count($post_data['amount']) > 0)
			{
				JobProposalAmount::where(['proposal_id'=>$proposal_id])->delete();
				$count = count($post_data['item_description']) > count($post_data['amount']) ? count($post_data['item_description']) : count($post_data['amount']);
				for($i=0; $i<$count; $i++)
				{
					$proposalAmount = new JobProposalAmount;
					if(trim($post_data['item_description'][$i]) != '')
					{
						//debug(); exit;
						$proposalAmount->job_id = $job_id;
						$proposalAmount->sent_by_user = Auth::user()->id;
						$proposalAmount->proposal_id = $insertedId;
						$proposalAmount->item_description = $post_data['item_description'][$i];
						$proposalAmount->amount = (int)$post_data['amount'][$i];
						$proposalAmount->save();
					}
				}

				/*$UserNotification = new UserNotification;
				$UserNotification->user_id = $jobDetails->posted_by_user;
				$UserNotification->sent_by_user = Auth::user()->id;
				$UserNotification->title = '';
				$notificationMsg = config("constants.SEND_PROPOSAL_NOTIFICATION_MSG");
				$UserNotification->short_description = substr(str_replace('{{NAME}}', $authUserName, $notificationMsg), 0, 255);
				$UserNotification->full_description = str_replace('{{NAME}}', $authUserName, $notificationMsg);
				$UserNotification->viewed_status = 'N';
				$UserNotification->created_at = date('Y-m-d H:i:s');
				$UserNotification->save();*/
			}
			$successMsg = 'Proposal Sent Successfully';

			if($oldProposal->is_highlight_bid=='N'){
				if($isNeedPayment=='1'){
					//echo 'A'; exit;
					//$this->payNowForJobPost($insertedId, $needToPay);
					return redirect('/jobs/pay-now-for-send-proposal/'.$job_id.'/'.$insertedId.'/'.$needToPay);
				}
				else
				{
					if($is_highlight_bid == 'Y')
					{
						//echo 'B'; exit;
						//Credit to admin's wallet
						$user_transaction = new UserTransaction;
				        $user_transaction->user_id = 0;
				        $user_transaction->job_id = $job_id;
				        $user_transaction->proposal_id = $insertedId;
				        $user_transaction->transaction_id = "WO".generatePin()."-".$job_id."-".$insertedId;
				        $user_transaction->amount = $jobSettings->highlight_bid_fee;
				        $user_transaction->paid_by = 'D';
				        $user_transaction->transaction_type = "C";
				        $user_transaction->payment_for = "Highlight bid";
				        $user_transaction->payment_status = "Y";
				        $user_transaction->save();

				        //Debit from users wallet
				        $user_transaction = new UserTransaction;
				        $user_transaction->user_id = Auth::user()->id;
				        $user_transaction->job_id = $job_id;
				        $user_transaction->proposal_id = $insertedId;
				        $user_transaction->transaction_id = "WO".generatePin()."-".$job_id."-".$insertedId;
				        $user_transaction->amount = $jobSettings->highlight_bid_fee;
				        $user_transaction->paid_by = 'D';
				        $user_transaction->transaction_type = "D";
				        $user_transaction->payment_for = "Highlight bid";
				        $user_transaction->payment_status = "Y";
				        $user_transaction->save();
					}
				}
			}
			
			return redirect('/jobs/edit-proposal/'.$job_id)->with('success', 'Proposal Sent Successfully');
		}
		
		
		return view('jobs/edit_job_proposal', compact(
			'job_id',
			'jobPostedByUserID',
			'jobDetails',
			'jobUserDetails',
			'jobRequiredSkills',
			'requiredSkillNames',
			'successMsg',
			'proposalSentByUser',
			'proposalEstimatedAmount',
			'activeMenu',
			'activeMenuHeader'
		));
    }

    public function payNowForSendProposal($job_id=0, $proposal_id=0, $payableAmnt='0.00')
	{
		//echo $job_id; exit;
		$user = Auth::user()->id;
		
        $jobprovider_transaction = new JobproviderTransaction;
        $jobprovider_transaction->user_id = $user;
        $jobprovider_transaction->job_id= $job_id;
        $jobprovider_transaction->proposal_id = $proposal_id;
        $jobprovider_transaction->payment_type = 'S';
        $jobprovider_transaction->amount = $payableAmnt;
        $jobprovider_transaction_id = $jobprovider_transaction->save();
        //dd($jobprovider_transaction_id);
        $jobprovider_transaction->transaction_no = "WO".generatePin()."-".$jobprovider_transaction->id."-".$job_id."-".$proposal_id;
        $jobprovider_transaction->save();

        $config = [];
        if($jobprovider_transaction->payment_type == "S")
        {
        	$key = config('constants.FIXED_ENCRYPT_STRING');
        	$encryptedTXNID = encrypt($jobprovider_transaction->transaction_no, $key);
            return redirect('/jobs/stripe-form-for-send-proposal/'.$encryptedTXNID);
        }

        //return response()->json($config);
	}
	
	public function stripeFormForSendProposal($txn=0)
    {
		//echo $txn; exit;
		if(!empty(trim($txn)))
		{
			$key = config('constants.FIXED_ENCRYPT_STRING');
			$txn = decrypt($txn, $key);
			$txnArray = explode("-", $txn);
			$job_id = isset($txnArray[2]) ? $txnArray[2] : 0;
			$proposal_id = isset($txnArray[3]) ? $txnArray[3] : 0;
			$JobproviderTransaction = JobproviderTransaction::where(['transaction_no'=>$txn])->first();

			//echo $txn; exit;
			if(isset($job_id) && (int)$job_id > 0 && isset($proposal_id) && (int)$proposal_id > 0)
			{
				//dd($txn); exit;
				$amount = $JobproviderTransaction->amount;
				$txn = encrypt($txn, $key);
				return view('jobs/stripe_form_for_send_proposal', compact('amount','txn'));
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
	
	public function stripePaymentForSendProposal($txn=0, Request $request)
    {
    	//print_r($_POST); exit;
		if(!empty(trim($txn)))
		{
			$key = config('constants.FIXED_ENCRYPT_STRING');
			$encryptedTXNID = $txn;
			$txn = decrypt($txn, $key);
			$txnArray = explode("-", $txn);
			$job_id = isset($txnArray[2]) ? $txnArray[2] : 0;
			$proposal_id = isset($txnArray[3]) ? $txnArray[3] : 0;
			$amount = $request->amount;
			
			if(isset($job_id) && (int)$job_id > 0 && $amount > 0)
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
				   $this->successfulPaymentForSendProposal($encryptedTXNID);
				   $this->notifyPaymentForSendProposal($txn, response()->json($retrieve));
				   return redirect('/jobs/send-proposal/'.$job_id);
				}
				catch(\Stripe\Error\Card $e)
				{
					$body = $e->getJsonBody();
					$err  = $body['error'];
					$this->cancelPayment($txn);
					$this->notifyPaymentForSendProposal($txn, response()->json($err));
					return redirect('/jobs/send-proposal/'.$job_id);
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

    public function paypalReturnForSendProposal($txn)
    {
	   $this->successfulPayment($txn);
	   return redirect('/jobs/search-jobs')->with('success', 'Transaction successful!');
    }
	
    public function paypalNotifyForSendProposal($txn,Request $request)
    {
        $input =$request->all();
        $this->notifyPaymentForJobPost($txn, response()->json($input));
    }
	
    public function paypalCancelForSendProposal($txn)
    {
        $this->cancelPaymentForJobPost($txn);
        return redirect('/jobs/search-jobs')->with('error', 'Transaction failed!');
    }
	
    private function successfulPaymentForSendProposal($txn)
    {
    	$key = config('constants.FIXED_ENCRYPT_STRING');
		$encryptedTXNID = $txn;
		$txn = decrypt($txn, $key);

    	$authUserId = Auth::user()->id;
		$authUserName = Auth::user()->first_name.' '.Auth::user()->last_name;

		$txnArray = explode("-", $txn);
		$job_id = isset($txnArray[2]) ? $txnArray[2] : 0;
		$proposal_id = isset($txnArray[3]) ? $txnArray[3] : 0;
		
		$jobprovider_transaction = JobproviderTransaction::where('transaction_no', $txn)->first();
        $jobprovider_transaction->payment_status = "S";
        $jobprovider_transaction->save();

        //Credit to user wallet
        $user_transaction = new UserTransaction;
        $user_transaction->user_id = Auth::user()->id;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "C";
        $user_transaction->payment_for = "Highlight bid";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        //debit from user wallet
        $user_transaction = new UserTransaction;
        $user_transaction->user_id = Auth::user()->id;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "D";
        $user_transaction->payment_for = "Highlight bid";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        //Credit to admin's wallet
        $user_transaction = new UserTransaction;
        $user_transaction->user_id = 0;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "C";
        $user_transaction->payment_for = "Highlight bid";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        $jobSettings = getJobSettings();
        $restAmount = ($jobSettings->highlight_bid_fee-$jobprovider_transaction->amount);
        if($restAmount > 0){
        	//Credit to admin's wallet
        	$user_transaction = new UserTransaction;
	        $user_transaction->user_id = 0;
	        $user_transaction->job_id = $job_id;
	        $user_transaction->proposal_id = $proposal_id;
	        $user_transaction->transaction_id = "WO".generatePin()."-".$job_id.'-'.$proposal_id;
	        $user_transaction->amount = $restAmount;
	        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
	        $user_transaction->transaction_type = "C";
	        $user_transaction->payment_for = "Highlight bid";
	        $user_transaction->payment_status = "Y";
	        $user_transaction->save();

	        //debit from user wallet
	        $user_transaction = new UserTransaction;
	        $user_transaction->user_id = Auth::user()->id;
	        $user_transaction->job_id = $job_id;
	        $user_transaction->proposal_id = $proposal_id;
	        $user_transaction->transaction_id = "WO".generatePin()."-".$job_id.'-'.$proposal_id;
	        $user_transaction->amount = $restAmount;
	        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
	        $user_transaction->transaction_type = "D";
	        $user_transaction->payment_for = "Highlight bid";
	        $user_transaction->payment_status = "Y";
	        $user_transaction->save();
        }
		
		$proposalStatus['is_highlight_bid'] = 'Y';
		JobProposal::where(['proposal_id'=>$proposal_id])->update($proposalStatus);
    }
	
    private function notifyPaymentForSendProposal($txn,$response)
    {
        $jobprovider_transaction = JobproviderTransaction::where('transaction_no',$txn)->first();
        $jobprovider_transaction->payment_gateway_response = $response;
        $jobprovider_transaction->save();
    }

    public function previewJobProposal(Request $request, $job_id=0)
    {
		if(checkPrivilege(1) || (int)$job_id==0){
			return redirect('/user/dashboard');
		}
		$activeMenu = 'Overview';
		$activeMenuHeader = 'Jobs';
		
        //echo $job_id; exit;
		$job_id = (int)$job_id;
		$jobDetails = Postedjobs::where([
					'job_id'=>$job_id
				])
				->where('job_status', '!=', '4')
				->first();
		//dd($jobDetails); exit;
		
		$proposalSentByUser = JobProposal::where([
			'sent_by_user'=>Auth::user()->id,
			'job_id'=>$job_id
		])->first();
		
		$proposalEstimatedAmount = array();
		if(count($proposalSentByUser) > 0){
			$proposalEstimatedAmount = JobProposalAmount::where([
				'proposal_id'=>$proposalSentByUser->proposal_id,
				'job_id'=>$job_id
			])->get();
		}
		
		/*if(@$jobDetails->job_id == 0){
			return redirect('/user/dashboard');
		}*/
		
		$jobPostedByUserID = isset($jobDetails->posted_by_user) ? $jobDetails->posted_by_user : '';
		$jobUserDetails = User::where(['id'=>$jobPostedByUserID])
					->first();
		//dd($jobUserDetails); exit;
		
		$jobRequiredSkills = JobSkillMap::where(['job_id'=>$job_id])
					->get();
		//dd($jobRequiredSkills); exit;
		$requiredSkillNames = getSkillsByJobId($job_id);
		
		
		return view('jobs/view_job_details', compact(
			'job_id',
			'jobPostedByUserID',
			'jobDetails',
			'jobUserDetails',
			'jobRequiredSkills',
			'requiredSkillNames',
			'proposalSentByUser',
			'proposalEstimatedAmount',
			'activeMenu',
			'activeMenuHeader'
		));
    }
	
	public function viewProjectProposals(Request $request, $job_id=0){
		if(checkPrivilege(2) || (int)$job_id==0){
			return redirect('/user/dashboard');
		}
		$activeMenu = 'Proposals';
		$activeMenuHeader = 'Jobs';
		
		$proposal_per_page = config('constants.PROPOSAL_PER_PAGE');
		//echo $proposal_per_page; exit;
		
		//echo $job_id; exit;
		$job_id = (int)$job_id;
		$jobDetails = Postedjobs::where([
					'job_id'=>$job_id
				])
				->first();
		//dd($jobDetails); exit;
		
		$allProposals = JobProposal::where([
			'job_id'=>$job_id,
			'is_shortlisted'=>'N'
		])
		->orderBy('proposal_id', 'desc')
		->paginate($proposal_per_page);
		//dd($allProposals); exit;
		
		$shortlistedProposals = JobProposal::where([
			'job_id'=>$job_id,
			'is_shortlisted'=>'Y'
		])
		->orderBy('proposal_id', 'desc')
		->paginate($proposal_per_page);
		//dd($shortlistedProposals); exit;

		$getAcceptedProposal = JobProposal::where(['is_accepted'=>'Y', 'job_id'=>$job_id])->get();
		
		$jobPostedByUserID = isset($jobDetails->posted_by_user) ? $jobDetails->posted_by_user : '';
		$jobUserDetails = User::where(['id'=>$jobPostedByUserID])
					->first();
		//dd($jobUserDetails); exit;
		
		$jobRequiredSkills = JobSkillMap::where([
					'job_id'=>$job_id
				])
				->get();
		//dd($jobRequiredSkills); exit;
		$requiredSkillNames = getSkillsByJobId($job_id);
		$successMsg = '';
		
		if($request->ajax())
		{
			$datas = $request->all();
			$searchfor = $datas['searchfor'];
			if($searchfor == 'all'){
				$html = view('jobs.ajaxAllUneffectedProposals', compact(
					'allProposals',
					'getAcceptedProposal'
				))->render();
			}else{
				$html = view('jobs.ajaxShortlistedProposals', compact(
					'shortlistedProposals',
					'getAcceptedProposal'
				))->render();
			}
            
			$json_array['html'] = $html;
			$json_array['searchfor'] = $searchfor;
			return response()->json($json_array);
        }
		
		return view('jobs/view_project_proposals', compact(
			'job_id',
			'jobDetails',
			'requiredSkillNames',
			'jobUserDetails',
			'allProposals',
			'shortlistedProposals',
			'activeMenu',
			'getAcceptedProposal',
			'activeMenuHeader'
		));
	}

    public function viewProjectProposalById(Request $request)
	{
		if(checkPrivilege(2)){
			return redirect('/user/dashboard');
		}
		$activeMenuHeader = 'Jobs';
		
		if($request->isAjax)
		{
			$json_array['response_status'] = 0;
			$input = $request->all();
			$proposal_id = $input['proposal_id'];
			
			$proposalDetails = JobProposal::where(['proposal_id'=>$proposal_id])->first();
			$porposalAmount = array();
			//$porposalSentByUserDetails = array();
			if(count($proposalDetails) > 0)
			{
				$json_array['response_status'] = 1;
				$porposalAmount = JobProposalAmount::where([
					'proposal_id'=>$proposalDetails->proposal_id
				])->get();
			}

			$job_id = $proposalDetails->job_id;

			$getAcceptedProposal = JobProposal::where(['is_accepted'=>'Y', 'job_id'=>$job_id])->get();
			
			$returnHTML = view('jobs/modalJobProposal', compact(
				'proposalDetails',
				'porposalAmount',
				'getAcceptedProposal',
				'job_id'
			))->render();
			
			$json_array['response_data'] = $returnHTML;
			
			return \Response::json($json_array);
		}
	}
	
	public function shortlistProjectProposalById(Request $request)
	{
		if(checkPrivilege(2)){
			return redirect('/user/dashboard');
		}
		$activeMenuHeader = 'Jobs';
		
		if($request->isAjax)
		{
			//$json_array['response_status'] = 0;
			$proposal_per_page = config('constants.PROPOSAL_PER_PAGE');
			//echo $proposal_per_page; exit;
			$input = $request->all();
			$proposal_id = (int)$input['proposal_id'];
			$job_id = (int)$input['job_id'];
			
			JobProposal::where([
					'proposal_id'=>$proposal_id
				])
				->update(['is_shortlisted'=>'Y']);
			
			$allProposals = JobProposal::where([
					'job_id'=>$job_id,
					'is_shortlisted'=>'N'
				])
				->orderBy('proposal_id', 'desc')
				->paginate($proposal_per_page);
				//dd($allProposals); exit;
			$allProposals->setPath(url('/jobs/view-project/'.$job_id));
			
			$shortlistedProposals = JobProposal::where([
					'job_id'=>$job_id,
					'is_shortlisted'=>'Y'
				])
				->orderBy('proposal_id', 'desc')
				->paginate($proposal_per_page);
				//dd($shortlistedProposals); exit;
			$shortlistedProposals->setPath(url('/jobs/view-project/'.$job_id));

			$getAcceptedProposal = JobProposal::where(['is_accepted'=>'Y', 'job_id'=>$job_id])->get();
			
			$returnHTML = view('jobs/ajaxViewProposals', compact(
				'allProposals',
				'shortlistedProposals',
				'getAcceptedProposal'
			))->render();
			
			$json_array['response_data'] = $returnHTML;
			
			return \Response::json($json_array);
		}
	}
	
	public function acceptProjectProposalById(Request $request)
	{
		if(checkPrivilege(2)){
			return redirect('/user/dashboard');
		}
		$activeMenuHeader = 'Jobs';
		
		if($request->isAjax)
		{
			//$json_array['response_status'] = 0;
			$proposal_per_page = config('constants.PROPOSAL_PER_PAGE');
			//echo $proposal_per_page; exit;
			$input = $request->all();
			$proposal_id = (int)$input['proposal_id'];
			$job_id = (int)$input['job_id'];
			$accept_type = $input['accept_type'];
			$json_array['accept_type'] = $accept_type;
			$returnHTMLproposal = '';
			$returnHTMLpayment = '';
			
			if($accept_type=='Y')
			{
				$proposalDetails = JobProposal::where(['proposal_id'=>$proposal_id])->first();
				$porposalAmount = JobProposalAmount::where([
						'proposal_id'=>$proposal_id
					])->get();
			}
			elseif($accept_type=='N')
			{
				JobProposal::where([
					'proposal_id'=>$proposal_id
				])
				->update(['is_shortlisted'=>'N']);
			}
			
			$allProposals = JobProposal::where([
					'job_id'=>$job_id,
					'is_shortlisted'=>'N'
				])
				->orderBy('proposal_id', 'desc')
				->paginate($proposal_per_page);
				//dd($allProposals); exit;
			$allProposals->setPath(url('/jobs/view-project/'.$job_id));
			
			$shortlistedProposals = JobProposal::where([
					'job_id'=>$job_id,
					'is_shortlisted'=>'Y'
				])
				->orderBy('proposal_id', 'desc')
				->paginate($proposal_per_page);
				//dd($shortlistedProposals); exit;
			$shortlistedProposals->setPath(url('/jobs/view-project/'.$job_id));

			$getAcceptedProposal = JobProposal::where(['is_accepted'=>'Y', 'job_id'=>$job_id])->get();
			
			if($accept_type=='Y')
			{
				$returnHTMLpayment = view('jobs/modalAcceptProposal', compact(
						'proposalDetails',
						'porposalAmount',
						'job_id',
						'proposal_id',
						'getAcceptedProposal',
						'activeMenuHeader'
					))->render();
			}
			elseif($accept_type=='N')
			{
				$returnHTMLproposal = view('jobs/ajaxViewProposals', compact(
						'allProposals',
						'shortlistedProposals',
						'getAcceptedProposal',
						'activeMenuHeader'
					))->render();
			}
			
			$json_array['response_data'] = $returnHTMLproposal;
			$json_array['response_data_payment'] = $returnHTMLpayment;
			
			return \Response::json($json_array);
		}
	}
	
	public function payNow(Request $request)
	{
		
		$input =$request->all();
		$user = Auth::user()->id;
		//print_r($input); exit;
		
		$job_id = $input['job_id'];
		$proposal_id = $input['proposal_id'];
		
		$porposalAmount = JobProposalAmount::where([
			'proposal_id'=>$proposal_id
		])->get();
		
		$totalEstimatedAmount=0;
		if(count($porposalAmount) > 0){
			foreach($porposalAmount as $eachAmount){
				$totalEstimatedAmount += $eachAmount->amount;
			}
		}
		
        $jobprovider_transaction = new JobproviderTransaction;
        $jobprovider_transaction->user_id = Auth::user()->id;
        $jobprovider_transaction->job_id= $job_id;
        $jobprovider_transaction->proposal_id= $proposal_id;
        $jobprovider_transaction->payment_type = $input['paymentoption'];
        $jobprovider_transaction->amount = $totalEstimatedAmount;
        $jobprovider_transaction_id = $jobprovider_transaction->save();
        //dd($jobprovider_transaction_id);
        $jobprovider_transaction->transaction_no = "WO".generatePin()."-".$jobprovider_transaction->id.'-'.$proposal_id;
        $jobprovider_transaction->save();

        $config = [];
        if($input['paymentoption'] == "S")
        {
            return redirect('/jobs/stripe-form/'.$jobprovider_transaction->transaction_no);
        }

        //return response()->json($config);
	}
	
	public function stripeForm($txn=0)
    {
		//echo $txn; exit;
		if(!empty(trim($txn)))
		{
			$txnArray = explode("-", $txn);
			$proposal_id = isset($txnArray[2]) ? $txnArray[2] : 0;
			if(isset($proposal_id) && (int)$proposal_id > 0)
			{
				//echo $txn; exit;
				$proposalDetails = JobProposal::where(['proposal_id'=>$proposal_id])->first();
				$porposalAmount = JobProposalAmount::where([
					'proposal_id'=>$proposal_id
				])->get();
				
				$data = [
					'proposalDetails' => $proposalDetails,
					'porposalAmount' => $porposalAmount,
					'txn' => $txn
				];
				return view('jobs.stripe_form', $data);
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
	
	public function stripePayment($txn=0, Request $request)
    {
    	//print_r($_POST); exit;
		if(!empty(trim($txn)))
		{
			$txnArray = explode("-", $txn);
			$proposal_id = isset($txnArray[2]) ? $txnArray[2] : 0;
			
			$proposalDetails = JobProposal::where(['proposal_id'=>$proposal_id])->first();
			if(isset($proposal_id) && (int)$proposal_id > 0 && isset($proposalDetails->job_id) && $proposalDetails->job_id > 0)
			{
				$input = $request->all();
				//print_r($input); exit;
				
				$porposalAmount = JobProposalAmount::where([
					'proposal_id'=>$proposal_id
				])->get();
				
				$paid_membership = User::find(Auth::user()->id);
				$request_price = 0;
				if(count($porposalAmount) > 0){
					foreach($porposalAmount as $eachAmount){
						$request_price += $eachAmount->amount;
					}
				}
				$request_price = $request_price*100;
				$stripeToken = isset($input['stripeToken']) ? $input['stripeToken'] : '';
				
				try
				{
					// Create a Customer
					Stripe::setApiKey(env('STRIPE_SECRET'));
					$stripe_customer_id = Auth::user()->stripe_customer_id;
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

				   $retrieve = StripeCharge::retrieve($response->id);
				   $this->successfulPayment($txn);
				   $this->notifyPayment($txn, response()->json($retrieve));
				   return redirect('/jobs/view-project/'.$proposalDetails->job_id)->with('success', 'Payment successful');
				}
				catch(\Stripe\Error\Card $e)
				{
					$body = $e->getJsonBody();
					$err  = $body['error'];
					$this->cancelPayment($txn);
					$this->notifyPayment($txn, response()->json($err));
					return redirect('/jobs/view-project/'.$proposalDetails->job_id)->with('error', 'Transaction failed for premium membership');
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

    public function paypalReturn($txn)
    {
	   $this->successfulPayment($txn);
	   return redirect('membership')->with('success', 'Enrolled to premium membership');
    }
	
    public function paypalNotify($txn,Request $request)
    {
        $input =$request->all();
        $this->notifyPayment($txn, response()->json($input));
    }
	
    public function paypalCancel($txn)
    {
        $this->cancelPayment($txn);
        return redirect('membership')->with('error', 'Transaction failed for premium membership');
    }
	
    private function successfulPayment($txn)
    {
    	$authUserId = Auth::user()->id;
		$authUserName = Auth::user()->first_name.' '.Auth::user()->last_name;

		$txnArray = explode("-", $txn);
		$proposal_id = isset($txnArray[2]) ? $txnArray[2] : 0;
		$proposalDetails = JobProposal::where(['proposal_id'=>$proposal_id])->first();

		$job_id = isset($proposalDetails->job_id) ? $proposalDetails->job_id : 0;
		
		$jobprovider_transaction = JobproviderTransaction::where('transaction_no', $txn)->first();
        //dd($jobprovider_transaction);
        $jobprovider_transaction->payment_status = "S";
        //$jobprovider_transaction->start_date = time();
        //$jobprovider_transaction->expiry_date = $jobprovider_transaction->start_date + (30*24*60*60);
        $jobprovider_transaction->save();

        $user_transaction = new UserTransaction;
        $user_transaction->user_id = $jobprovider_transaction->user_id;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "C";
        $user_transaction->payment_for = "Proposal amount";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        $user_transaction = new UserTransaction;
        $user_transaction->user_id = $jobprovider_transaction->user_id;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "D";
        $user_transaction->payment_for = "Proposal amount";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();

        $user = User::find(Auth::user()->id);
        //$user->membership_id = $jobprovider_transaction->membership_id;
        $user->save();
		
		$acceptProposal['is_shortlisted'] = 'Y';
		$acceptProposal['is_accepted'] = 'Y';
		JobProposal::where(['proposal_id'=>$proposal_id])->update($acceptProposal);

		$UserNotification = new UserNotification;
		$UserNotification->user_id = $proposalDetails->sent_by_user;
		$UserNotification->sent_by_user = Auth::user()->id;
		$UserNotification->title = '';
		$notificationMsg = config("constants.ACCEPT_PROPOSAL_NOTIFICATION_MSG");
		$UserNotification->short_description = substr(str_replace('{{NAME}}', $authUserName, $notificationMsg), 0, 255);
		$UserNotification->full_description = str_replace('{{NAME}}', $authUserName, $notificationMsg);
		$UserNotification->notification_link = '/jobs/send-proposal/'.$job_id;
		$UserNotification->viewed_status = 'N';
		$UserNotification->created_at = date('Y-m-d H:i:s');
		$UserNotification->save();
		
		$jobStatus['job_status'] = '2';
		Postedjobs::where(['job_id'=>$job_id])->update($jobStatus);
    }
	
    private function cancelPayment($txn)
    {
        $jobprovider_transaction = JobproviderTransaction::where('transaction_no',$txn)->first();
        $jobprovider_transaction->payment_status = "C";
        $jobprovider_transaction->save();
    }
	
    private function notifyPayment($txn,$response)
    {
        $jobprovider_transaction = JobproviderTransaction::where('transaction_no',$txn)->first();
        $jobprovider_transaction->payment_gateway_response = $response;
        $jobprovider_transaction->save();
    }
	
	public function FreelancerWorkstream(Request $request, $status=0)
	{
		if(checkPrivilege(2))
		{
			return redirect('/user/dashboard');
		}
		
		$userId = Auth::user()->id;
		$per_page = config('constants.JOBS_PER_PAGE');
		$input_data = $request->all();
		$activeMenuHeader = 'Jobs';
		
		if($request->ajax())
		{
			$type = $input_data['type'];
			if((int)$type > 0)
			{
				$json_array['response_status'] = 0;
				$json_array['response_data'] = '';
				$json_array['type'] = $type;
				
				switch($type)
				{
					case 1:
					$allJobDetails = DB::table('job_proposals')
						->leftJoin('postedjobs', 'job_proposals.job_id', '=', 'postedjobs.job_id')
						->where('job_proposals.sent_by_user', '=', $userId )
						->where('postedjobs.job_status', '!=', '4')
						//->paginate($per_page);
						->get();
					break;
					
					case 2:
					$allJobDetails = DB::table('job_proposals')
						->leftJoin('postedjobs', 'job_proposals.job_id', '=', 'postedjobs.job_id')
						->where('job_proposals.sent_by_user', '=', $userId )
						->where('postedjobs.job_status', '=', '2')
						->get();
					break;
					
					case 3:
					$allJobDetails = DB::table('job_proposals')
						->leftJoin('postedjobs', 'job_proposals.job_id', '=', 'postedjobs.job_id')
						->where('job_proposals.sent_by_user', '=', $userId )
						->where('postedjobs.job_status', '=', '1')
						->get();
					break;
					
					case 4:
					$allJobDetails = DB::table('job_proposals')
						->leftJoin('postedjobs', 'job_proposals.job_id', '=', 'postedjobs.job_id')
						->where('job_proposals.sent_by_user', '=', $userId )
						->where('postedjobs.job_status', '=', '4')
						->get();
					break;
					
					default:
					$allJobDetails = array();
					
				}
				
				$json_array['response_status'] = 1;
				$returnHTML = view('jobs/work_stream_ajax_data_list', compact(
						'allJobDetails'
					))->render();
				$json_array['response_data'] = $returnHTML;
			
				return \Response::json($json_array);
			}
		}
		
		//All Jobs
		$allJobDetails = DB::table('job_proposals')
			->leftJoin('postedjobs', 'job_proposals.job_id', '=', 'postedjobs.job_id')
			->where('job_proposals.sent_by_user', '=', $userId)
			->where('postedjobs.job_status', '!=', '4')
			//->paginate($per_page);
			->get();
		//dd($allJobDetails); exit;
		
		//In Progress Jobs
		$inProgress = DB::table('job_proposals')
			->leftJoin('postedjobs', 'job_proposals.job_id', '=', 'postedjobs.job_id')
			->where('job_proposals.sent_by_user', '=', $userId )
			->where('postedjobs.job_status', '=', '2')
			->get();
		//dd($inProgress); exit;
		
		//Pending Jobs
		$pending = DB::table('job_proposals')
			->leftJoin('postedjobs', 'job_proposals.job_id', '=', 'postedjobs.job_id')
			->where('job_proposals.sent_by_user', '=', $userId )
			->where('postedjobs.job_status', '=', '1')
			->get();
		//dd($pending); exit;
		
		//Completed Jobs
		$completed = DB::table('job_proposals')
			->leftJoin('postedjobs', 'job_proposals.job_id', '=', 'postedjobs.job_id')
			->where('job_proposals.sent_by_user', '=', $userId )
			->where('postedjobs.job_status', '=', '4')
			->get();
		//dd($completed); exit;

		$totalReviewsDetails = DB::select('SELECT count(review_for_user) as totalReviews, SUM(rating) as totalRating FROM '.config('constants.TBL_JOB_RATINGS').' WHERE review_for_user="'.Auth::user()->id.'"');
		
		
		return view('jobs.freelancer_work_stream_list', compact(
			'allJobDetails',
			'inProgress',
			'pending',
			'completed',
			'activeMenuHeader',
			'totalReviewsDetails'
		));
	}

	public function JobAssets(Request $request, $job_id=0,$parent_id=0)
    {
		if(checkPrivilege(1) || (int)$job_id==0)
		{
			return redirect('/user/dashboard');
		}
		$activeMenu = 'Assets';
		$job_id = (int)$job_id;
		$parent_id = (int)$parent_id;
		$per_page = config('constants.JOBS_ASSETS_PER_PAGE');
		$activeMenuHeader = 'Jobs';
		$jobDetails = Postedjobs::where(['job_id'=>$job_id])
				//->where('job_status', '!=', '4')
				->first();
		$jobAsssetDetails = Jobasset::where(['job_id'=>$job_id, 'parent_id'=>$parent_id])
				->orderBy('updated_at', 'desc')->paginate($per_page);
				//->get();
		return view('jobs/view_job_assets', compact(
			'job_id',
			'jobDetails',
			'parent_id',
			'jobAsssetDetails',
			'activeMenu',
			'activeMenuHeader'
		))->render();
    }

    public function createAssetFolder(Request $request,$job_id=0,$parent_id=0)
    {
    	$post_data = $request->all();
    	$this->validate($request, [
			'name'=>'required|string'
		]);
    	$job_id = (int)$job_id;
    	$parent_id = (int)$parent_id;
		$jobasset = new Jobasset;
		$jobasset->name = $post_data['name'];
		$jobasset->is_file = '0';
		$jobasset->parent_id = $parent_id;
		$jobasset->mime_type = '';//(isset($post_data['mime_type']))?$post_data['mime_type']:'';
		$jobasset->asset_file_path = '';
		$jobasset->size = '';
		$jobasset->job_id = $job_id;
		$jobasset->user_id = '';
		$jobasset->updated_at = date('Y-m-d H:i:s');
		$jobasset->created_at = date('Y-m-d H:i:s');
		$jobasset->save();
		$insertedId = $jobasset->id;
		if((int)$insertedId > 0){

		}
		return redirect()->back();
    }

    public function createAssetFile(Request $request,$job_id=0,$parent_id=0){
    	$post_data = $request->all();
    	$this->validate($request, [
			'asset_file'=>'mimes:jpg,jpeg,png,pdf,doc,docx|max:10000',
		]);
		$job_id = (int)$job_id;
		$parent_id = (int)$parent_id;
		$jobasset = new Jobasset;
		if($request->hasFile('asset_file')) {
			$image  = $request->file('asset_file');
			$upload_path = public_path().'/assets/upload/job_assets/';
			$fileName = time().str_random(10).'-DOC.'.$image->getClientOriginalExtension();
			$sourcePath = $_FILES['asset_file']['tmp_name'];
			$targetPath = $upload_path.$fileName;
			move_uploaded_file($sourcePath, $targetPath);
			$jobasset->asset_file_path = $fileName;
			$jobasset->name = $_FILES['asset_file']['name'];
			$jobasset->is_file = 1;;
			$jobasset->parent_id = $parent_id;
			$jobasset->mime_type = $_FILES['asset_file']['type'];
			$jobasset->size = $_FILES['asset_file']['size'];
			$jobasset->job_id = $job_id;
			$jobasset->user_id = '';
			$jobasset->updated_at = date('Y-m-d H:i:s');
			$jobasset->created_at = date('Y-m-d H:i:s');
			$jobasset->save();
			$insertedId = $jobasset->id;
			if((int)$insertedId > 0){
				
			}
		}
		return redirect()->back();
    }

    public function downloadAssetFile($asset_id){
    	$asset_id = (int)$asset_id;
    	$assetDetails = Jobasset::where([
					'id'=>$asset_id
				])
				->first();
		$asset_path = public_path().'/assets/upload/job_assets/'.$assetDetails->asset_file_path;
		return response()->download($asset_path);
    }

    public function addJobsReview(Request $request){
    	$json_array['return_status'] = 0;
    	$json_array['return_msg'] = "";
    	$authUser = Auth::user()->id;
    	$authUserName = Auth::user()->first_name.' '.Auth::user()->last_name;
    	$modal_job_id = $request->modal_job_id;
    	$ratingVal = $request->ratingVal;
    	$reviewComment = $request->reviewComment;
    	$userType = $request->userType;

    	$notificationForUser = 0;
    	if($userType == 'F'){
    		$where['job_id'] = $modal_job_id;
    		$jobsDetails = getJobsDetails($where);
    		$notificationForUser = isset($jobsDetails[0]->posted_by_user) ? $jobsDetails[0]->posted_by_user : '0';
		}
		if($userType == 'JP'){
			$user_id = 0;
    		$job_id = $modal_job_id;
    		$isShortlisted = '';
    		$isAccepted = 'Y';
			$proposalDetails = getProposalDetails($user_id, $job_id, $isShortlisted, $isAccepted);
			$notificationForUser = isset($proposalDetails[0]->sent_by_user) ? $proposalDetails[0]->sent_by_user : '0';
		}
		$review_for_user = $notificationForUser;

    	if(!empty($authUser) && !empty($modal_job_id) && !empty($ratingVal) && !empty($reviewComment))
    	{
    		$JobRating = new JobRating;
	    	$JobRating->job_id = $modal_job_id;
	    	$JobRating->review_for_user = $review_for_user;
	    	$JobRating->review_by_user = $authUser;
	    	$JobRating->rating = $ratingVal;
	    	$JobRating->review_feedback = $reviewComment;
	    	$JobRating->created_at = date('Y-m-d H:i:s');
	    	$JobRating->save();
    		$json_array['return_status'] = 1;
    		$json_array['return_msg'] = "Successfully saved!";

    		$UserNotification = new UserNotification;
			$UserNotification->user_id = $notificationForUser;
			$UserNotification->sent_by_user = Auth::user()->id;
			$UserNotification->title = '';
			$notificationMsg = "";
			if($userType == 'F'){
				$notificationMsg = config("constants.REVIEW_NOTIFICATION_MSG_FREELANCER");
				$UserNotification->notification_link = '/jobs/my-workstream';
			}
			if($userType == 'JP'){
				$notificationMsg = config("constants.REVIEW_NOTIFICATION_MSG_JOB_PROVIDER");
				$UserNotification->notification_link = '/jobs/my-jobs-list';
			}
			$UserNotification->short_description = substr(str_replace('{{NAME}}', $authUserName, $notificationMsg), 0, 255);
			$UserNotification->full_description = str_replace('{{NAME}}', $authUserName, $notificationMsg);
			$UserNotification->viewed_status = 'N';
			$UserNotification->created_at = date('Y-m-d H:i:s');
			$UserNotification->save();
    	}
    	else
    	{
    		$json_array['return_status'] = 0;
    		$json_array['return_msg'] = "Please fillup the review form!";
    	}

    	return \Response::json($json_array);
    }

    public function checkIsNeedPayment(Request $request){
    	$json_array['return_status'] = 0;
    	$json_array['return_msg'] = "";
    	$turnAroundTimeId = $request->id;

    	$fetchDetails = TurnAroundTime::find($turnAroundTimeId);
    	if($fetchDetails->is_need_payment == 'Y')
    	{
    		//$json_array['payableAmount'] = $fetchDetails->payable_amount;
    		$json_array['return_status'] = 1;
    		if($fetchDetails->payable_amount > 0){
    			$json_array['return_msg'] = "If 'Turn around' for any job is 'Urgent' then, you should have to pay £ ".$fetchDetails->payable_amount." respect each job. If paid already, please ignore.";
    		}else{
    			$json_array['return_msg'] = "";
    		}
    		
    	}

    	return \Response::json($json_array);
    }

    public function fetchSubCategory(Request $request)
    {
    	$json_array['return_status'] = 0;

    	$category_id = $request->category_id;
    	$subCategories = CategorySubcategory::where(['parent_category_id'=>$category_id])->get();
    	$data = '<option value=""> Select </option>';
    	if(count($subCategories) > 0){
    		$json_array['return_status'] = 1;
    		foreach($subCategories as $eachSubCategories)
    		{
    			$data .= '<option value="'.$eachSubCategories->category_id.'">'.$eachSubCategories->category_name.'</option>';
    		}
    	}
    	$json_array['data'] = $data;
    	return \Response::json($json_array);
    }
}
