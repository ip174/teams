<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\UserDetail;
use App\Postedjobs;
use App\JobSkillMap;
use App\JobAssesments;

use App\Invoice;
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
use Image;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DateTime;
use Response;

use Stripe;
use StripeCharge;
use StripeCustomer;

class InvoiceController extends Controller
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
	
	public function viewInvoice()
	{
		//debug($_GET); exit;

		if(checkPrivilege(2)){
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$activeMenu = 'Invoice'; //Which menu will active in tabber

		//$allInvoice = Invoice::where(['invoice_for_user'=>$authUser])->get();

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

		return view('invoice/my_invoice', compact(
			'authUser',
			'activeMenu',
			'allInvoice',
			'transaction_type',
			'invoicedaterange',
			'search_text'
		));
	}

	public function payInvoice(Request $request)
	{
		$input =$request->all();
		$user = Auth::user()->id;
		//print_r($input); exit;

		$totalEstimatedAmount=$request->payableAmount;
		$invoiceId = $request->invoiceId;
		$invoice_data = Invoice::find($invoiceId);
		
		$job_id = $invoice_data->job_id;
		$proposal_id = $invoice_data->proposal_id;
		
        $jobprovider_transaction = new JobproviderTransaction;
        $jobprovider_transaction->user_id = Auth::user()->id;
        $jobprovider_transaction->job_id= $job_id;
        $jobprovider_transaction->proposal_id= $proposal_id;
        $jobprovider_transaction->payment_type = $input['paymethod'];
        $jobprovider_transaction->amount = $totalEstimatedAmount;
        $jobprovider_transaction_id = $jobprovider_transaction->save();
        //dd($jobprovider_transaction_id);
        $jobprovider_transaction->transaction_no = "WO".generatePin()."-".$jobprovider_transaction->id.'-'.$proposal_id.'-'.$invoiceId;
        $amountNeedToBePay = base64_encode($totalEstimatedAmount);
        $jobprovider_transaction->save();

        $config = [];
        switch($request->paymethod)
        {
			case 'VISA':
			return redirect('/invoice/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			case 'PAYPAL_BILLING':
			return redirect('/invoice/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			case 'CREDITCARD':
			return redirect('/invoice/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			case 'PAYPAL':
			return redirect('/invoice/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			case 'BANK_TRANSFER':
			return redirect('/invoice/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
			break;

			case 'OTHER':
			return redirect('/invoice/stripe-form/'.$jobprovider_transaction->transaction_no.'/'.$amountNeedToBePay);
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
				return view('invoice.stripe_form', $data);
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
				   return redirect('/invoice/view-invoice')->with('success', 'Payment successful!');
				}
				catch(\Stripe\Error\Card $e)
				{
					$body = $e->getJsonBody();
					$err  = $body['error'];
					$this->cancelPayment($txn);
					$this->notifyPayment($txn, response()->json($err));
					return redirect('/invoice/view-invoice')->with('error', 'Transaction failed for premium membership!');
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
		//print_r($txnArray); exit;
		$proposal_id = isset($txnArray[2]) ? $txnArray[2] : 0;
		$invoiceId = isset($txnArray[3]) ? $txnArray[3] : 0;
		$invoiceId = (int)$invoiceId;

		$proposalDetails = JobProposal::where(['proposal_id'=>$proposal_id])->first();

		$job_id = isset($proposalDetails->job_id) ? $proposalDetails->job_id : 0;
		
		$jobprovider_transaction = JobproviderTransaction::where('transaction_no', $txn)->first();
        //dd($jobprovider_transaction);
        $jobprovider_transaction->payment_status = "S";
        //$jobprovider_transaction->start_date = time();
        //$jobprovider_transaction->expiry_date = $jobprovider_transaction->start_date + (30*24*60*60);
        $jobprovider_transaction->save();


        //Transaction history start for Employer
        $user_transaction = new UserTransaction;
        $user_transaction->user_id = $jobprovider_transaction->user_id;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "C";
        $user_transaction->payment_for = "Invoice amount";
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
        $user_transaction->payment_for = "Invoice amount";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();
        //Transaction history end for Employer


        //Transaction history start for Freelancer
        $user_transaction = new UserTransaction;
        $user_transaction->user_id = $proposalDetails->sent_by_user;
        $user_transaction->job_id = $job_id;
        $user_transaction->proposal_id = $proposal_id;
        $user_transaction->transaction_id = $jobprovider_transaction->transaction_no;
        $user_transaction->amount = $jobprovider_transaction->amount;
        $user_transaction->paid_by = $jobprovider_transaction->payment_type;
        $user_transaction->transaction_type = "C";
        $user_transaction->payment_for = "Invoice amount";
        $user_transaction->payment_status = "Y";
        $user_transaction->save();
        //Transaction history end for Freelancer

        Invoice::where(['id'=>$invoiceId])->update(['status'=>'1']);


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
}
