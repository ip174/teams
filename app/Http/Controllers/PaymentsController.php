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
use App\UserChat;
use App\UserChatFile;
use App\UserJobTask;
use App\TaskAttachment;
use App\TaskAssignedMember;
use App\Invoice;
use App\Setting;
use App\UserNotification;
use Image;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DateTime;
use Response;

use Stripe;
use StripeCharge;
use StripeCustomer;

class PaymentsController extends Controller
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
	
	public function viewPayments($job_id=0)
	{
		if( !isset($job_id) || (int)$job_id < 1 ){
			return redirect('/user/dashboard')->with('error', 'Something mismatched!');
		}
		if(checkPrivilege(2)){
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$activeMenu = 'Payments'; //Which menu will active in tabber
		$activeMenuHeader = 'Jobs';
		
		$jobDetails = Postedjobs::where(['job_id'=>$job_id])->first();
		/*if(isset($jobDetails->posted_by_user) && $jobDetails->posted_by_user!= $authUser){
			return redirect('/user/dashboard')->with('error', 'Unauthorised Access!');
		}*/
		$checkValidFreelance = JobProposal::where([
				'job_id'=>$job_id,
				'is_accepted'=>'Y'
			])->first();
		if($jobDetails->posted_by_user != $authUser && !isset($checkValidFreelance->sent_by_user)){
			return redirect('/user/dashboard')->with('error', 'Unauthorised Access!');
		}

		if($jobDetails->posted_by_user != $authUser && (isset($checkValidFreelance->sent_by_user) && $checkValidFreelance->sent_by_user != $authUser)){
			return redirect('/user/dashboard')->with('error', 'Unauthorised Access!');
		}
		
		$getFreelancer = JobProposal::where([
				'job_id'=>$job_id,
				'is_accepted'=>'Y'
			])->first();
		//print_r($getFreelancer); exit;

		$proposal_id = isset($getFreelancer->proposal_id) ? $getFreelancer->proposal_id : '';
		$proposalByUser = isset($getFreelancer->sent_by_user) ? $getFreelancer->sent_by_user : '';

		$UserTransaction = UserTransaction::where(['user_id'=>$authUser, 'job_id'=>$job_id, 'proposal_id'=>$proposal_id])->first();
		//print_r($UserTransaction); exit;

		$getInvoices = Invoice::where(['invoice_for_user'=>$authUser])->get();
		/*debug($proposal_id);
		debug($getFreelancer);
		debug($UserTransaction);
		debug($proposalByUser);
		exit;*/
		

		return view('payments/payments', compact(
			'authUser',
			'activeMenu',
			'job_id',
			'proposal_id',
			'jobDetails',
			'getFreelancer',
			'UserTransaction',
			'proposalByUser',
			'getInvoices',
			'activeMenuHeader'
		));
	}

	public function releasePayments(Request $request){
		//print_r($_POST); exit;
		$input_data = $request->all();
		$authUser = Auth::user()->id;
		$authUserName = Auth::user()->first_name.' '.Auth::user()->last_name;

		$job_id = trim($request->job_id);
		$proposal_id = trim($request->proposal_id);
		$invoice_for_user = trim($request->invoice_for_user);
		$milestone_id = trim($request->milestone_id);
		$gross_amt = trim($request->gross_amt);

		$create_invoices = new Invoice;
		$create_invoices->job_id = $job_id;
		$create_invoices->proposal_id = $proposal_id;
		$create_invoices->invoice_for_user = $invoice_for_user;
		$create_invoices->gross_amt = $gross_amt;

		$create_invoices->invoice_by_user = $authUser;
		$create_invoices->invoice_date = date('Y-m-d H:i:s');
		$create_invoices->status = 1;
		$create_invoices->fee_amt = '0.00';
		$invoice_no = time().'-'.$job_id.'-'.$proposal_id;
		$create_invoices->invoice_no = $invoice_no;
		$create_invoices->save();

		/*$user_transaction = new UserTransaction;
        $user_transaction->user_id = $authUser;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->milestone_id = $milestone_id;
        $user_transaction->transaction_id = $invoice_no;
        $user_transaction->amount = $gross_amt;
        $user_transaction->paid_by = 'I';
        $user_transaction->transaction_type = "D";
        $user_transaction->payment_for = "Project completion amount";
        $user_transaction->payment_status = "Y";
        $user_transaction->is_released = "Y";
        $user_transaction->updated_at = date('Y-m-d H:i:s');
        $user_transaction->save();*/

        
        $perProjectCommission = isset($projectCommission->admin_commission_per_job) ? $projectCommission->admin_commission_per_job : '0.00';
        $freelancerAmt = ($gross_amt - (($perProjectCommission/100)*$gross_amt));
        if((int)$invoice_for_user > 0 && (int)$job_id > 0 && (int)$proposal_id > 0 && (int)$milestone_id > 0)
        {
        	//Payments released for Freelancer
	        $user_transaction = new UserTransaction;
	        $user_transaction->user_id = $invoice_for_user;
	        $user_transaction->job_id = $job_id;
	        $user_transaction->proposal_id = $proposal_id;
	        $user_transaction->milestone_id = $milestone_id;
	        $user_transaction->transaction_id = $invoice_no;
	        $user_transaction->amount = $freelancerAmt;
	        $user_transaction->paid_by = 'I';
	        $user_transaction->transaction_type = "C";
	        $user_transaction->payment_for = "Project completion amount";
	        $user_transaction->payment_status = "Y";
	        $user_transaction->is_released = "Y";
	        $user_transaction->updated_at = date('Y-m-d H:i:s');
	        $user_transaction->save();


	        //Payments released for Admin
	        $adminsAmt = ($gross_amt - $freelancerAmt);
	        $user_transaction = new UserTransaction;
	        //$user_transaction->user_id = $invoice_for_user;
	        $user_transaction->job_id = $job_id;
	        $user_transaction->proposal_id = $proposal_id;
	        $user_transaction->milestone_id = $milestone_id;
	        $user_transaction->transaction_id = $invoice_no;
	        $user_transaction->amount = $adminsAmt;
	        $user_transaction->paid_by = 'I';
	        $user_transaction->transaction_type = "C";
	        $user_transaction->payment_for = "Project completion amount";
	        $user_transaction->payment_status = "Y";
	        $user_transaction->is_released = "Y";
	        $user_transaction->updated_at = date('Y-m-d H:i:s');
	        $user_transaction->save();

	        $UserNotification = new UserNotification;
			$UserNotification->user_id = $invoice_for_user;
			$UserNotification->sent_by_user = Auth::user()->id;
			$UserNotification->title = '';
			$notificationMsg = config("constants.RELEASE_MILESTONE_NOTIFICATION_MSG");
			$UserNotification->short_description = substr(str_replace('{{NAME}}', $authUserName, $notificationMsg), 0, 255);
			$UserNotification->full_description = str_replace('{{NAME}}', $authUserName, $notificationMsg);
			$UserNotification->notification_link = '/payments/view-payments/'.$job_id;
			$UserNotification->viewed_status = 'N';
			$UserNotification->created_at = date('Y-m-d H:i:s');
			$UserNotification->save();
	    }



        $updateProposalAmount['is_paid'] = '1';
        JobProposalAmount::where(['id'=>$milestone_id])->update($updateProposalAmount);

        $isAllAmountPaid = JobProposalAmount::where(['job_id'=>$job_id, 'proposal_id'=>$proposal_id, 'is_paid'=>'0'])->get();
        if(count($isAllAmountPaid) == 0)
        {
	        $updatePostedJob['job_status'] = '4';
	        $updatePostedJob['updated_at'] = date('Y-m-d H:i:s');
	        Postedjobs::where(['job_id'=>$job_id])->update($updatePostedJob);
    	}

		return redirect()->back()->with('message', 'Released Successfully!');

	}

	public function paymentsOverview(Request $request){
		if(checkPrivilege(2)){
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$activeMenu = 'Funds'; //Which menu will active in tabber

		//$allInvoice = Invoice::where(['invoice_for_user'=>$authUser])->get();

		$invoicePerPage = config('constants.INVOICE_PER_PAGE');
		$transaction_type = app('request')->input('transaction_type');
		$first_day = new DateTime('first day of this month');
		$last_day = new DateTime('last day of this month');
		$invoicedaterange = app('request')->input('invoicedaterange');
        $invoicedaterange = isset($invoicedaterange) ? $invoicedaterange : $first_day->format('d/m/Y').' - '.$last_day->format('d/m/Y');
        $from_date = '';
        $to_date = '';
        if(!empty($invoicedaterange)){
			$dateRangeArray = explode('-', $invoicedaterange);
			$from_date = isset($dateRangeArray[0]) ? trim($dateRangeArray[0]) : '';
        	$to_date = isset($dateRangeArray[1]) ? trim($dateRangeArray[1]) : '';
        }
        $search_text = app('request')->input('search_text');
		$allInvoice = Invoice::where(
					function($query) use ($transaction_type, $invoicedaterange, $from_date, $to_date, $search_text) {
						if($transaction_type !=""){
							$query->where('status', $transaction_type);
						}if($invoicedaterange !=""){
							$query->where('invoice_date', '>=', date('Y-m-d', strtotime(str_replace('/','-', $from_date.' 00:00:00'))));
							$query->where('invoice_date', '<=', date('Y-m-d', strtotime(str_replace('/','-', $to_date.' 23:59:59'))));
						}if(trim($search_text)!=""){
							$query->where('invoice_no',  'like', '%'. urldecode($search_text).'%');
						}
					}
				)
			//->where('invoice_for_user', '=', $authUser)
			->orWhere(['invoice_for_user' => $authUser, 'invoice_by_user' => $authUser])
            ->orderBy('id', 'desc')
            ->paginate($invoicePerPage);
		//dd($allInvoice); exit;

        $pagination_params = Input::except('page');

        $depositeFundsForJob = DB::select('SELECT job.needs_to_design_job, job.job_id, jp.proposal_id FROM '.config('constants.TBL_POSTED_JOBS').' job LEFT JOIN '.config('constants.TBL_PROPOSALS').' jp ON job.job_id=jp.job_id WHERE job.posted_by_user="'.$authUser.'" AND jp.is_accepted="Y"');


        $debitedBalance = getTotalDebitedOrCreditedBalance($authUser, 'D');
        $creditedBalance = getTotalDebitedOrCreditedBalance($authUser, 'C');
        $myWalletBalance = $creditedBalance - $debitedBalance;
        //dd($myWalletBalance); exit;

        
        $myJobsInprogress = DB::select('SELECT pj.* FROM '.config('constants.TBL_POSTED_JOBS').' pj WHERE pj.posted_by_user="'.$authUser.'" AND pj.job_status="2"');
        $jobsEscrowAmount = DB::select('SELECT SUM(pa.amount) as amount FROM '.config('constants.TBL_JOB_PROPOSAL_AMOUNT').' pa WHERE pa.job_id IN(SELECT job_id FROM '.config('constants.TBL_POSTED_JOBS').' pj WHERE pj.posted_by_user="'.$authUser.'" AND pj.job_status="2") AND pa.is_paid!=1');
        $myJobsEscrowAmount = isset($jobsEscrowAmount[0]->amount) ? $jobsEscrowAmount[0]->amount : '0.00';


        $myWorkstream = DB::select('SELECT pj.* FROM '.config('constants.TBL_POSTED_JOBS').' pj 
			WHERE 
			pj.job_status="2" AND 
			pj.job_id IN(
			    SELECT ps.job_id FROM '.config('constants.TBL_PROPOSALS').' ps WHERE 
			    ps.sent_by_user="'.$authUser.'" AND 
			    ps.is_accepted="Y"
			)');
        $workstreamEscrowAmount = DB::select('SELECT SUM(pa.amount) as amount FROM 
			'.config('constants.TBL_JOB_PROPOSAL_AMOUNT').' pa WHERE 
			pa.job_id IN(
			    SELECT pj.job_id FROM 
			    '.config('constants.TBL_POSTED_JOBS').' pj WHERE 
			    pj.job_id IN(
			        SELECT ps.job_id FROM 
			        '.config('constants.TBL_PROPOSALS').' ps WHERE 
			        ps.sent_by_user="'.$authUser.'" AND 
			        ps.is_accepted="Y"
			    )
			) AND 
			pa.is_paid!="1"');
        $myWorkstreamEscrowAmount = isset($workstreamEscrowAmount[0]->amount) ? $workstreamEscrowAmount[0]->amount : '0.00';
        //dd($workstreamEscrowAmount); exit;


		return view('payments/payments_overview', compact(
			'authUser',
			'activeMenu',
			'allInvoice',
			'transaction_type',
			'invoicedaterange',
			'search_text',
			'pagination_params',
			'myWalletBalance',
			'myJobsInprogress',
			'myJobsEscrowAmount',
			'myWorkstream',
			'myWorkstreamEscrowAmount',
			'depositeFundsForJob'
		));
	}

	public function calculateMyEarnings(Request $request){
		$projectCommission = Setting::find('1');

		$response['perProjectCommission'] = isset($projectCommission->admin_commission_per_job) ? $projectCommission->admin_commission_per_job : '0.00';

		return \Response::json($response);
	}

	public function moneyWithdrawRequest(Request $request){
		$authUser = Auth::user()->id;
		$response['walletBalanceZero'] = 0;

		if((int)$authUser > 0){
			$debitedBalance = getTotalDebitedOrCreditedBalance($authUser, 'D');
	        $creditedBalance = getTotalDebitedOrCreditedBalance($authUser, 'C');
	        $myWalletBalance = $creditedBalance - $debitedBalance;

	        if($myWalletBalance > 0.00 || $myWalletBalance > 0){
		        $user_transaction = new UserTransaction;
		        $user_transaction->user_id = $authUser;
		        //$user_transaction->job_id = $job_id;
		        //$user_transaction->proposal_id = $proposal_id;
		        //$user_transaction->milestone_id = $milestone_id;
		        $user_transaction->transaction_id = time().$authUser;
		        $user_transaction->amount = $myWalletBalance;
		        $user_transaction->paid_by = 'I';
		        $user_transaction->transaction_type = "D";
		        $user_transaction->payment_for = "Money withdraw request!";
		        $user_transaction->payment_status = "Y";
		        $user_transaction->is_released = "N";
		        $user_transaction->is_withdraw_request_received = "P";
		        $user_transaction->updated_at = date('Y-m-d H:i:s');
		        $user_transaction->save();
		        $response['msg'] = "Successfully request sent!";
		        $response['walletBalanceZero'] = 1;
		    }else{
		    	$response['msg'] = "Sorry, we can't process your request due to unavailability of funds!";
		    }
	    }else{
	    	$response['msg'] = "Sorry, your request is invalid!";
	    }

		return \Response::json($response);
	}

	public function createInvoice(Request $request){
		$authUser = Auth::user()->id;
		$input_data = $request->all();
		//print_r($input_data); exit;

		$job_id = trim($request->job_id);
		$proposal_id = trim($request->proposal_id);
		$invoice_for_user = trim($request->user_for_proposal);
		$invoice_by_user = trim($request->user_for_job_posted);
		$reasonForInvoice = trim($request->checkmeinvoice);

		for($i = 0; $i < sizeof($request->invoice_description); $i++){
			/*$job_proposal_amounts = new JobProposalAmount;
			$job_proposal_amounts->job_id = $job_id;
			$job_proposal_amounts->proposal_id = $proposal_id;
			$job_proposal_amounts->sent_by_user = $invoice_for_user;
			$job_proposal_amounts->item_description = trim($request->invoice_description[$i]);
			$job_proposal_amounts->amount = trim($request->amount_fixed_cost[$i]);
			$job_proposal_amounts->created_at = date('Y-m-d H:i:s');
			$job_proposal_amounts->save();*/

			$create_invoices = new Invoice;
			$create_invoices->job_id = $job_id;
			$create_invoices->proposal_id = $proposal_id;
			$create_invoices->invoice_for_user = $invoice_for_user;
			$create_invoices->invoice_by_user = $invoice_by_user;
			$create_invoices->invoice_date = date('Y-m-d H:i:s');
			$create_invoices->status = 2;
			$invoice_no = time().'-'.$job_id.'-'.$proposal_id;
			$create_invoices->invoice_no = $invoice_no;
			$create_invoices->why_raising_invoice = $reasonForInvoice == 'Others' ? trim($request->raise_invoice_others) : $reasonForInvoice;

			$create_invoices->quantity = trim($request->quantity[$i]);
			$create_invoices->invoice_type = trim($request->invoice_type[$i]);
			$create_invoices->unit_cost = trim($request->unit_cost[$i]);
			$create_invoices->time_period = trim($request->time_period[$i]);

			$create_invoices->description = trim($request->invoice_description[$i]);
			$create_invoices->gross_amt = trim($request->amount_fixed_cost[$i]);
			$create_invoices->fee_amt = '0.00';
			$create_invoices->vat_percent = trim($request->vat_percent);
			//print_r($create_invoices); exit;
			$create_invoices->save();
		}


		return redirect()->back()->with('success', 'Successfully created!');
	}

	public function payNow(Request $request)
	{
		$input =$request->all();
		$user = Auth::user()->id;
		//print_r($input); exit;

		$job_proposal_id = $request->job_project_id;
		$job_proposal_ids = explode("-", $job_proposal_id);
		
		$job_id = $job_proposal_ids[0];
		$proposal_id = $job_proposal_ids[1];
		
		$totalEstimatedAmount=$request->deposite_amount;
		
        $jobprovider_transaction = new JobproviderTransaction;
        $jobprovider_transaction->user_id = Auth::user()->id;
        $jobprovider_transaction->job_id= $job_id;
        $jobprovider_transaction->proposal_id= $proposal_id;
        $jobprovider_transaction->payment_type = $input['paymethod'];
        $jobprovider_transaction->amount = $totalEstimatedAmount;
        $jobprovider_transaction_id = $jobprovider_transaction->save();
        //dd($jobprovider_transaction_id);
        $jobprovider_transaction->transaction_no = "WO".generatePin()."-".$jobprovider_transaction->id.'-'.$proposal_id;
        $amountNeedToBePay = base64_encode($request->deposite_amount);
        $jobprovider_transaction->save();

        $config = [];
        switch($request->paymethod)
        {
			case 'VISA':
			return redirect('/payments/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			case 'PAYPAL_BILLING':
			return redirect('/payments/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			case 'CREDITCARD':
			return redirect('/payments/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			case 'PAYPAL':
			return redirect('/payments/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			case 'BANK_TRANSFER':
			return redirect('/payments/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			case 'OTHER':
			return redirect('/payments/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			default:
			return redirect()->back()->with('error', 'Please select payment method!');
			break;
		}

        //return response()->json($config);
	}
	
	public function stripeForm($txn=0, $amount='')
    {
		//echo $txn; exit;
		if(!empty(trim($txn)) && !empty(trim($amount)))
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
					'porposalAmount' => $amount,
					'txn' => $txn
				];
				return view('payments.stripe_form', $data);
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
	
	public function stripePayment($txn=0, $amount='', Request $request)
    {
    	//print_r($_POST); exit;
		if(!empty(trim($txn)) && !empty(trim($amount)))
		{
			$txnArray = explode("-", $txn);
			$proposal_id = isset($txnArray[2]) ? $txnArray[2] : 0;
			
			$proposalDetails = JobProposal::where(['proposal_id'=>$proposal_id])->first();
			if(isset($proposal_id) && (int)$proposal_id > 0 && isset($proposalDetails->job_id) && $proposalDetails->job_id > 0)
			{
				$input = $request->all();
				//print_r($input); exit;
				
				$paid_membership = User::find(Auth::user()->id);
				$request_price = base64_decode($amount);
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
				   return redirect('/payments/payments-overview')->with('success', 'Payment successful!');
				}
				catch(\Stripe\Error\Card $e)
				{
					$body = $e->getJsonBody();
					$err  = $body['error'];
					$this->cancelPayment($txn);
					$this->notifyPayment($txn, response()->json($err));
					return redirect('/payments/payments-overview')->with('error', 'Transaction failed for premium membership!');
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

        /*$user_transaction = new UserTransaction;
        $user_transaction->user_id = $jobprovider_transaction->user_id;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "D";
        $user_transaction->payment_for = "Proposal amount";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();*/

        $user = User::find(Auth::user()->id);
        //$user->membership_id = $jobprovider_transaction->membership_id;
        $user->save();
		
		$acceptProposal['is_shortlisted'] = 'Y';
		$acceptProposal['is_accepted'] = 'Y';
		JobProposal::where(['proposal_id'=>$proposal_id])->update($acceptProposal);
		
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

    public function viewStatements(){
    	if(checkPrivilege(2)){
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$activeMenu = 'Statements'; //Which menu will active in tabber


		$transaction_type = app('request')->input('transaction_type') ? app('request')->input('transaction_type') : 1;
		$first_day = new DateTime('first day of this month');
		$last_day = new DateTime('last day of this month');
		$invoicedaterange = app('request')->input('invoicedaterange');
        $invoicedaterange = isset($invoicedaterange) ? $invoicedaterange : $first_day->format('d/m/Y').' - '.$last_day->format('d/m/Y');
        $from_date = '';
        $to_date = '';
        if(!empty($invoicedaterange)){
			$dateRangeArray = explode('-', $invoicedaterange);
			$from_date = isset($dateRangeArray[0]) ? date('Y-m-d', strtotime(str_replace('/', '-', trim($dateRangeArray[0])))) : '';
        	$to_date = isset($dateRangeArray[1]) ? date('Y-m-d', strtotime(str_replace('/', '-', trim($dateRangeArray[1])))) : '';
        }

        $income = DB::select('SELECT SUM(gross_amt) as total_amt, SUM(vat_percent) as total_vat FROM '.config('constants.TBL_INVOICE').' WHERE invoice_for_user="'.$authUser.'" AND status="'.$transaction_type.'" AND (DATE(invoice_date) BETWEEN "'.$from_date.'" AND "'.$to_date.'")');
        $expense = DB::select('SELECT SUM(gross_amt) as total_amt, SUM(vat_percent) as total_vat FROM '.config('constants.TBL_INVOICE').' WHERE invoice_by_user="'.$authUser.'" AND status="'.$transaction_type.'" AND (DATE(invoice_date) BETWEEN "'.$from_date.'" AND "'.$to_date.'")');
        //dd($expense); exit;

		$currentYear = date('Y');
		$prevYear = $currentYear -1;
		$postedJobs = DB::select('SELECT * FROM '.config('constants.TBL_POSTED_JOBS').' WHERE posted_by_user="'.$authUser.'" AND (YEAR(DATE(created_at)) BETWEEN '.$prevYear.' AND '.$currentYear.')');

		$myCompletedJobs = DB::select('SELECT * FROM '.config('constants.TBL_PROPOSALS').' jp LEFT JOIN '.config('constants.TBL_JOB_PROPOSAL_AMOUNT').' amt ON jp.proposal_id=amt.proposal_id WHERE jp.sent_by_user="'.$authUser.'" AND jp.is_accepted="Y" AND (YEAR(DATE(jp.created_at)) BETWEEN '.$prevYear.' AND '.$currentYear.') AND amt.is_paid="1"');

		$fday = date('Y-m-d', strtotime(str_replace('/', '-', $first_day->format('d/m/Y'))));
		$tday = date('Y-m-d', strtotime(str_replace('/', '-', $last_day->format('d/m/Y'))));
		$paidMonthly = getIncomeExpense('2', Auth::user()->id, 'M', $fday, $tday);
		$paidToday = getIncomeExpense('2', Auth::user()->id, 'A', $fday, $tday);
		$earnedMonthly = getIncomeExpense('1', Auth::user()->id, 'M', $fday, $tday);
		$earnedToday = getIncomeExpense('1', Auth::user()->id, 'A', $fday, $tday);


		return view('payments/my_statements', compact(
			'authUser',
			'activeMenu',
			'postedJobs',
			'myCompletedJobs',
			'currentYear',
			'prevYear',
			'invoicedaterange',
			'transaction_type',
			'income',
			'expense',
			'paidMonthly',
			'paidToday',
			'earnedMonthly',
			'earnedToday'
		));
    }

    public function viewTransactionHistory(Request $request){
		if(checkPrivilege(2)){
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$activeMenu = 'Transaction'; //Which menu will active in tabber

		//$allInvoice = Invoice::where(['invoice_for_user'=>$authUser])->get();

		$invoicePerPage = config('constants.INVOICE_PER_PAGE');
		$transaction_type = app('request')->input('transaction_type');
		$first_day = new DateTime('first day of this month');
		$last_day = new DateTime('last day of this month');
		$invoicedaterange = app('request')->input('invoicedaterange');
        $invoicedaterange = isset($invoicedaterange) ? $invoicedaterange : $first_day->format('d/m/Y').' - '.$last_day->format('d/m/Y');
        $from_date = '';
        $to_date = '';
        if(!empty($invoicedaterange)){
			$dateRangeArray = explode('-', $invoicedaterange);
			$from_date = isset($dateRangeArray[0]) ? trim($dateRangeArray[0]) : '';
        	$to_date = isset($dateRangeArray[1]) ? trim($dateRangeArray[1]) : '';
        }
        $search_text = app('request')->input('search_text');
		$allInvoice = Invoice::where(
					function($query) use ($transaction_type, $invoicedaterange, $from_date, $to_date, $search_text) {
						if($transaction_type !=""){
							$query->where('status', $transaction_type);
						}if($invoicedaterange !=""){
							$query->where('invoice_date', '>=', date('Y-m-d', strtotime(str_replace('/','-', $from_date.' 00:00:00'))));
							$query->where('invoice_date', '<=', date('Y-m-d', strtotime(str_replace('/','-', $to_date.' 23:59:59'))));
						}if(trim($search_text)!=""){
							$query->where('invoice_no',  'like', '%'. urldecode($search_text).'%');
						}
					}
				)
			->where('invoice_for_user', '=', $authUser)
			//->orWhere(['invoice_for_user' => $authUser, 'invoice_by_user' => $authUser])
            ->orderBy('id', 'desc')
            ->paginate($invoicePerPage);
		//dd($allInvoice); exit;

        $pagination_params = Input::except('page');

        $depositeFundsForJob = DB::select('SELECT job.needs_to_design_job, job.job_id, jp.proposal_id FROM '.config('constants.TBL_POSTED_JOBS').' job LEFT JOIN '.config('constants.TBL_PROPOSALS').' jp ON job.job_id=jp.job_id WHERE job.posted_by_user="'.$authUser.'" AND jp.is_accepted="Y"');


        $debitedBalance = getTotalDebitedOrCreditedBalance($authUser, 'D');
        $creditedBalance = getTotalDebitedOrCreditedBalance($authUser, 'C');
        $myWalletBalance = $creditedBalance - $debitedBalance;
        //dd($myWalletBalance); exit;

        
        $myJobsInprogress = DB::select('SELECT pj.* FROM '.config('constants.TBL_POSTED_JOBS').' pj WHERE pj.posted_by_user="'.$authUser.'" AND pj.job_status="2"');
        $jobsEscrowAmount = DB::select('SELECT SUM(pa.amount) as amount FROM '.config('constants.TBL_JOB_PROPOSAL_AMOUNT').' pa WHERE pa.job_id IN(SELECT job_id FROM '.config('constants.TBL_POSTED_JOBS').' pj WHERE pj.posted_by_user="'.$authUser.'" AND pj.job_status="2") AND pa.is_paid!=1');
        $myJobsEscrowAmount = isset($jobsEscrowAmount[0]->amount) ? $jobsEscrowAmount[0]->amount : '0.00';


        $myWorkstream = DB::select('SELECT pj.* FROM '.config('constants.TBL_POSTED_JOBS').' pj 
			WHERE 
			pj.job_status="2" AND 
			pj.job_id IN(
			    SELECT ps.job_id FROM '.config('constants.TBL_PROPOSALS').' ps WHERE 
			    ps.sent_by_user="'.$authUser.'" AND 
			    ps.is_accepted="Y"
			)');
        $workstreamEscrowAmount = DB::select('SELECT SUM(pa.amount) as amount FROM 
			'.config('constants.TBL_JOB_PROPOSAL_AMOUNT').' pa WHERE 
			pa.job_id IN(
			    SELECT pj.job_id FROM 
			    '.config('constants.TBL_POSTED_JOBS').' pj WHERE 
			    pj.job_id IN(
			        SELECT ps.job_id FROM 
			        '.config('constants.TBL_PROPOSALS').' ps WHERE 
			        ps.sent_by_user="'.$authUser.'" AND 
			        ps.is_accepted="Y"
			    )
			) AND 
			pa.is_paid!="1"');
        $myWorkstreamEscrowAmount = isset($workstreamEscrowAmount[0]->amount) ? $workstreamEscrowAmount[0]->amount : '0.00';
        //dd($workstreamEscrowAmount); exit;


		return view('payments/transaction_history', compact(
			'authUser',
			'activeMenu',
			'allInvoice',
			'transaction_type',
			'invoicedaterange',
			'search_text',
			'pagination_params',
			'myWalletBalance',
			'myJobsInprogress',
			'myJobsEscrowAmount',
			'myWorkstream',
			'myWorkstreamEscrowAmount',
			'depositeFundsForJob'
		));
	}

	public function exportInvoice()
	{
		$authUser = Auth::user()->id;
	    $headers = array(
	        "Content-type" => "text/csv",
	        "Content-Disposition" => "attachment; filename=file.csv",
	        "Pragma" => "no-cache",
	        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
	        "Expires" => "0"
	    );

	    $transaction_type = app('request')->input('transaction_type');
		$first_day = new DateTime('first day of this month');
		$last_day = new DateTime('last day of this month');
		$invoicedaterange = app('request')->input('invoicedaterange');
        $invoicedaterange = isset($invoicedaterange) ? $invoicedaterange : $first_day->format('d/m/Y').' - '.$last_day->format('d/m/Y');
        $from_date = '';
        $to_date = '';
        if(!empty($invoicedaterange)){
			$dateRangeArray = explode('-', $invoicedaterange);
			$from_date = isset($dateRangeArray[0]) ? trim($dateRangeArray[0]) : '';
        	$to_date = isset($dateRangeArray[1]) ? trim($dateRangeArray[1]) : '';
        }
        $search_text = app('request')->input('search_text');
		$allInvoice = Invoice::where(
					function($query) use ($transaction_type, $invoicedaterange, $from_date, $to_date, $search_text) {
						if($transaction_type !=""){
							$query->where('status', $transaction_type);
						}if($invoicedaterange !=""){
							$query->where('invoice_date', '>=', date('Y-m-d', strtotime(str_replace('/','-', $from_date.' 00:00:00'))));
							$query->where('invoice_date', '<=', date('Y-m-d', strtotime(str_replace('/','-', $to_date.' 23:59:59'))));
						}if(trim($search_text)!=""){
							$query->where('invoice_no',  'like', '%'. urldecode($search_text).'%');
						}
					}
				)
			//->where('invoice_for_user', '=', $authUser)
			->orWhere(['invoice_for_user' => $authUser, 'invoice_by_user' => $authUser])
            ->orderBy('id', 'desc')
            ->get();
		//dd($allInvoice); exit;

	    $columns = array('Paid to User', 'Paid by User', 'Invoice Date', 'Invoice No', 'Status', 'Gross Amt', 'Fee Amount', 'VAT Percent', 'Net Amount');

	    $callback = function() use ($allInvoice, $columns)
	    {
	        $file = fopen('php://output', 'w');
	        fputcsv($file, $columns);

	        foreach($allInvoice as $eachInvoice) {
	        	$invoice_for_user = getUserById($eachInvoice->invoice_for_user);
	        	$invoice_by_user = getUserById($eachInvoice->invoice_by_user);
	        	$netPayableAmnt = $eachInvoice->gross_amt - $eachInvoice->fee_amt;
				$netPayableAmnt = ($netPayableAmnt-(($eachInvoice->vat_percent/100)*$netPayableAmnt));
				$invoice_status = config("constants.INVOICE_STATUS");
				$statusText = $invoice_status[$eachInvoice->status];
	            fputcsv($file, array($invoice_for_user->first_name.' '.$invoice_for_user->last_name, $invoice_by_user->first_name.' '.$invoice_by_user->last_name, date('d-m-Y', strtotime($eachInvoice->invoice_date)), $eachInvoice->invoice_no, $statusText, $eachInvoice->gross_amt, $eachInvoice->fee_amt, $eachInvoice->vat_percent, $netPayableAmnt));
	        }
	        fclose($file);
	    };
	    return Response::stream($callback, 200, $headers);
	}

	public function exportStatement()
	{
		$authUser = Auth::user()->id;
	    $headers = array(
	        "Content-type" => "text/csv",
	        "Content-Disposition" => "attachment; filename=file.csv",
	        "Pragma" => "no-cache",
	        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
	        "Expires" => "0"
	    );

	    $transaction_type = app('request')->input('transaction_type') ? app('request')->input('transaction_type') : 1;
		$first_day = new DateTime('first day of this month');
		$last_day = new DateTime('last day of this month');
		$invoicedaterange = app('request')->input('invoicedaterange');
        $invoicedaterange = isset($invoicedaterange) ? $invoicedaterange : $first_day->format('d/m/Y').' - '.$last_day->format('d/m/Y');
        $from_date = '';
        $to_date = '';
        if(!empty($invoicedaterange)){
			$dateRangeArray = explode('-', $invoicedaterange);
			$from_date = isset($dateRangeArray[0]) ? date('Y-m-d', strtotime(str_replace('/', '-', trim($dateRangeArray[0])))) : '';
        	$to_date = isset($dateRangeArray[1]) ? date('Y-m-d', strtotime(str_replace('/', '-', trim($dateRangeArray[1])))) : '';
        }

        $income = DB::select('SELECT SUM(gross_amt) as total_amt, SUM(vat_percent) as total_vat FROM '.config('constants.TBL_INVOICE').' WHERE invoice_for_user="'.$authUser.'" AND status="'.$transaction_type.'" AND (DATE(invoice_date) BETWEEN "'.$from_date.'" AND "'.$to_date.'")');
        $expense = DB::select('SELECT SUM(gross_amt) as total_amt, SUM(vat_percent) as total_vat FROM '.config('constants.TBL_INVOICE').' WHERE invoice_by_user="'.$authUser.'" AND status="'.$transaction_type.'" AND (DATE(invoice_date) BETWEEN "'.$from_date.'" AND "'.$to_date.'")');
        //dd($expense); exit;

		$currentYear = date('Y');
		$prevYear = $currentYear -1;
		$postedJobs = DB::select('SELECT * FROM '.config('constants.TBL_POSTED_JOBS').' WHERE posted_by_user="'.$authUser.'" AND (YEAR(DATE(created_at)) BETWEEN '.$prevYear.' AND '.$currentYear.')');

		$myCompletedJobs = DB::select('SELECT * FROM '.config('constants.TBL_PROPOSALS').' jp LEFT JOIN '.config('constants.TBL_JOB_PROPOSAL_AMOUNT').' amt ON jp.proposal_id=amt.proposal_id WHERE jp.sent_by_user="'.$authUser.'" AND jp.is_accepted="Y" AND (YEAR(DATE(jp.created_at)) BETWEEN '.$prevYear.' AND '.$currentYear.') AND amt.is_paid="1"');

		$fday = date('Y-m-d', strtotime(str_replace('/', '-', $first_day->format('d/m/Y'))));
		$tday = date('Y-m-d', strtotime(str_replace('/', '-', $last_day->format('d/m/Y'))));
		$paidMonthly = getIncomeExpense('2', Auth::user()->id, 'M', $fday, $tday);
		$paidToday = getIncomeExpense('2', Auth::user()->id, 'A', $fday, $tday);
		$earnedMonthly = getIncomeExpense('1', Auth::user()->id, 'M', $fday, $tday);
		$earnedToday = getIncomeExpense('1', Auth::user()->id, 'A', $fday, $tday);
		//dd($allInvoice); exit;

	    $columns = array('', 'Net Amount', 'Vat Amount', 'Total Amount');

	    $callback = function() use ($income, $expense, $columns)
	    {
	        $file = fopen('php://output', 'w');
	        fputcsv($file, $columns);

	        $netIncome = 0;
            $grossIncome = 0;
            $netVat = 0;
            $NetMovementGross = 0;
            $NetMovementVat = 0;
            $NetMovementProfit = 0;
            if(isset($income[0]->total_amt)){
            	$grossIncome = $income[0]->total_amt;
            	$netIncome = $grossIncome;
        	}
        	if(isset($income[0]->total_vat)){
            	$netVat = $income[0]->total_vat;
            	$netIncome = $netIncome - $netVat;
        	}
        	$NetMovementGross = $NetMovementGross + $grossIncome;
        	$NetMovementVat = $NetMovementVat + $netVat;
        	$NetMovementProfit = $NetMovementProfit + $netIncome;
	        fputcsv($file, array('Income', $grossIncome, $netVat, $netIncome));



	        $netPayment = 0;
            $grossPayment = 0;
            $netVat = 0;
            if(isset($expense[0]->total_amt)){
            	$grossPayment = $expense[0]->total_amt;
            	$netPayment = $grossPayment;
        	}
        	if(isset($expense[0]->total_vat)){
            	$netVat = $expense[0]->total_vat;
            	$netPayment = $netPayment + $netVat;
        	}
        	$NetMovementGross = $NetMovementGross - $grossPayment;
        	$NetMovementVat = $NetMovementVat + $netVat;
        	$NetMovementProfit = $NetMovementProfit - $netPayment;
	        fputcsv($file, array('Payments', $grossPayment, $netVat, $netPayment));
	        fputcsv($file, array('Net movement', abs($NetMovementGross), abs($NetMovementVat), abs($NetMovementProfit)));
	        fclose($file);
	    };
	    return Response::stream($callback, 200, $headers);
	}

	public function exportTransactionDetails()
	{
		$authUser = Auth::user()->id;
	    $headers = array(
	        "Content-type" => "text/csv",
	        "Content-Disposition" => "attachment; filename=file.csv",
	        "Pragma" => "no-cache",
	        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
	        "Expires" => "0"
	    );

	    $invoicePerPage = config('constants.INVOICE_PER_PAGE');
		$transaction_type = app('request')->input('transaction_type');
		$first_day = new DateTime('first day of this month');
		$last_day = new DateTime('last day of this month');
		$invoicedaterange = app('request')->input('invoicedaterange');
        $invoicedaterange = isset($invoicedaterange) ? $invoicedaterange : $first_day->format('d/m/Y').' - '.$last_day->format('d/m/Y');
        $from_date = '';
        $to_date = '';
        if(!empty($invoicedaterange)){
			$dateRangeArray = explode('-', $invoicedaterange);
			$from_date = isset($dateRangeArray[0]) ? trim($dateRangeArray[0]) : '';
        	$to_date = isset($dateRangeArray[1]) ? trim($dateRangeArray[1]) : '';
        }
        $search_text = app('request')->input('search_text');
		$allInvoice = Invoice::where(
					function($query) use ($transaction_type, $invoicedaterange, $from_date, $to_date, $search_text) {
						if($transaction_type !=""){
							$query->where('status', $transaction_type);
						}if($invoicedaterange !=""){
							$query->where('invoice_date', '>=', date('Y-m-d', strtotime(str_replace('/','-', $from_date.' 00:00:00'))));
							$query->where('invoice_date', '<=', date('Y-m-d', strtotime(str_replace('/','-', $to_date.' 23:59:59'))));
						}if(trim($search_text)!=""){
							$query->where('invoice_no',  'like', '%'. urldecode($search_text).'%');
						}
					}
				)
			->where('invoice_for_user', '=', $authUser)
			//->orWhere(['invoice_for_user' => $authUser, 'invoice_by_user' => $authUser])
            ->orderBy('id', 'desc')
            ->get();
		//dd($allInvoice); exit;

	    $columns = array('Paid to User', 'Paid by User', 'Invoice Date', 'Invoice No', 'Status', 'Gross Amt', 'Fee Amount', 'VAT Percent', 'Net Amount');

	    $callback = function() use ($allInvoice, $columns)
	    {
	        $file = fopen('php://output', 'w');
	        fputcsv($file, $columns);

	        foreach($allInvoice as $eachInvoice) {
	        	$invoice_for_user = getUserById($eachInvoice->invoice_for_user);
	        	$invoice_by_user = getUserById($eachInvoice->invoice_by_user);
	        	$netPayableAmnt = $eachInvoice->gross_amt - $eachInvoice->fee_amt;
				$netPayableAmnt = ($netPayableAmnt-(($eachInvoice->vat_percent/100)*$netPayableAmnt));
				$invoice_status = config("constants.INVOICE_STATUS");
				$statusText = $invoice_status[$eachInvoice->status];
	            fputcsv($file, array($invoice_for_user->first_name.' '.$invoice_for_user->last_name, $invoice_by_user->first_name.' '.$invoice_by_user->last_name, date('d-m-Y', strtotime($eachInvoice->invoice_date)), $eachInvoice->invoice_no, $statusText, $eachInvoice->gross_amt, $eachInvoice->fee_amt, $eachInvoice->vat_percent, $netPayableAmnt));
	        }
	        fclose($file);
	    };
	    return Response::stream($callback, 200, $headers);
	}
}
