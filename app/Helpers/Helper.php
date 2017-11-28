<?php
use App\JobProposal;
use App\JobProposalAmount;
use App\TurnAroundTime;
use App\UserChatFile;
use App\UserChat;
use App\User;
use App\UserDetail;
use App\Postedjobs;
use Illuminate\Support\Facades\Auth;
use App\UserJobTask;
use App\TaskAttachment;
use App\TaskAssignedMember;
use App\UserTransaction;
use App\UserWantsNotification;
use App\UserNotification;
use App\JobRating;
use App\SettingsJob;
use App\MonthlyBidDetail;
//use DateTime;

if(! function_exists('debug')) {
    function debug($array = array())
    {
        echo "<pre>";
		print_r($array);
		echo "</pre>";
    }
}


if (! function_exists('split_name')) {
    /**
     * Spilt first name and last name.
     *
     * @param $name
     * @return array
     */
    function split_name($name) {
        $name = rtrim($name);
        $parts = explode(" ", $name);
        if (count($parts) === 1 ) {
            return [
                'first_name' => $name,
                'last_name' => $name
            ];
        }
        else {
            $last_name = array_pop($parts);
            $first_name = implode(' ', $parts);
            return [
                'first_name' => $first_name,
                'last_name' => $last_name
            ];
        }
    }
}

if (!function_exists('create_api_token')) {
    function create_api_token($user) {
        return base64_encode($user->id . '=' . str_random(40));
    }
}

if (! function_exists('admin_url')) {
    /**
     * Generate a url for the application.
     * @param string $path
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function admin_url($path = null)
    {
        $admin_path = ADMIN_PREFIX . '/';
        if (is_null($path)) {
            return url($admin_path);
        }
        return url($admin_path . $path);
    }
}

if (! function_exists('generate_file_name')) {
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return string
     */
    function generate_file_name(\Symfony\Component\HttpFoundation\File\UploadedFile $file) {
        $file_ext = strtolower(trim($file->getClientOriginalExtension()));

        $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);;
        $original_name = str_replace(' ', '-', substr($original_name, 0, 75));
        return time() . str_random(10) . '.' . $original_name . '.' .$file_ext;
    }
}

if( !function_exists('get_focus') ){
	function get_focus($id=0, $where=array(), $select="*"){
		$query = DB::table('focus_type')
			->select($select);
			if((int)$id > 0){
				$query->where('focus_type_id', $id);
			}
			if($where){
				$query->where($where);
			}
			$query->orderBy('focus_type', 'asc');
			if($id){
				$results = $query->first();
			}else{
				$results = $query->get();
			}
		return $results;
	}
}

if( !function_exists('get_workField') ){
	function get_workField($id=0, $where=array(), $select="*"){
		$query = DB::table('field_of_work_type')
			->select($select);
			if((int)$id > 0){
				$query->where('type_id', $id);
			}
			if($where){
				$query->where($where);
			}
			$query->orderBy('type_title', 'asc');
			if($id){
				$results = $query->first();
			}else{
				$results = $query->get();
			}
		return $results;
	}
}

if( !function_exists('get_jobType') ){
	function get_jobType($id=0, $where=array(), $select="*"){
		$query = DB::table('job_type')
			->select($select);
			if((int)$id > 0){
				$query->where('job_type_id', $id);
			}
			if($where){
				$query->where($where);
			}
			$query->orderBy('job_title', 'asc');
			if($id){
				$results = $query->first();
			}else{
				$results = $query->get();
			}
		return $results;
	}
}

if( !function_exists('get_skills') ){
	function get_skills($id=0, $where=array(), $select="*"){
		$query = DB::table('skills')
			->select($select);
			if((int)$id > 0){
				$query->where('skill_id', $id);
			}
			if($where){
				$query->where($where);
			}
			$query->orderBy('skill_name', 'asc');
			if($id){
				$results = $query->first();
			}else{
				$results = $query->get();
			}
		return $results;
	}
}

if( !function_exists('get_skills_by_multiple_id') ){
	function get_skills_by_multiple_id($where=array(), $whereIn=array(), $select="*"){
		//debug($whereIn); exit;
		$query = DB::table('skills')
			->select($select);
			if($whereIn){
				$query->whereIn('skill_id', $whereIn);
			}
			
			if($where){
				$query->where($where);
			}
			
			$query->orderBy('skill_name', 'asc');
			$results = $query->get();
			//dd($results); exit;
		return $results;
	}
}

if( !function_exists('get_travelType') ){
	function get_travelType($id=0, $where=array(), $select="*"){
		$query = DB::table('travel_master')
			->select($select);
			if((int)$id > 0){
				$query->where('travel_id', $id);
			}
			if($where){
				$query->where($where);
			}
			//$query->orderBy('job_title', 'asc');
			if($id){
				$results = $query->first();
			}else{
				$results = $query->get();
			}
		return $results;
	}
}

if(!function_exists('getSkillsByUserID'))
{
	function getSkillsByUserID($user_id=0)
	{
		$query = DB::table('user_skill_map')
			->select('skills.skill_name');
		$query = $query->leftJoin('skills', 'user_skill_map.skill_id', '=', 'skills.skill_id');
		
		if((int)$user_id > 0){
			$query = $query->where('user_skill_map.user_id', $user_id);
		}
			
		$query = $query->get();
		return $query;
	}
}

if(!function_exists('getPortfolioByUserID'))
{
	function getPortfolioByUserID($user_id=0)
	{
		$query = DB::table('user_portfolios');
		
		if((int)$user_id > 0){
			$query = $query->where('user_id', $user_id);
		}
			
		$query = $query->get();
		return $query;
	}
}

if(!function_exists('getActionStatusByPortfolioID_UserID'))
{
	function getActionStatusByPortfolioID_UserID($user_id=0, $portfolio_id=0, $action_id=0)
	{
		/*echo "aaaaaaaaaaaa";
		echo $user_id.'*-*-';
		echo $portfolio_id; exit;*/
		if((int)$user_id > 0 && (int)$portfolio_id > 0){
			//echo "bbbbbbb"; exit;
			$query = DB::table('portfolios_like_share_preview');
			$where['user_id'] = $user_id;
			$where['portfolio_id'] = $portfolio_id;
			$where['action_status'] = $action_id;
			$query = $query->where($where);
			$query = $query->get();
			return $query;
		}
	}
}

if(!function_exists('getCategorySubcategory'))
{
	function getCategorySubcategory($where=array(), $fetchSubCat=0)
	{
		$tbl_categorySubcategory = config('constants.TBL_CATEGORY_SUBCATEGORY');
		if($where)
		{
			$query = DB::table($tbl_categorySubcategory);
			$query = $query->where($where);
			if($fetchSubCat){
				$query = $query->where('parent_category_id', '!=', 0);
			}
			$query = $query->orderBy('category_name', 'asc');
			$result = $query->get();
			return $result;
		}
	}
}

if(!function_exists('getSkillsByJobId'))
{
	function getSkillsByJobId($job_id=0)
	{
		$tbl_jobsSkill = config('constants.TBL_JOB_SKILL_MAP');
		$tbl_skills = config('constants.TBL_SKILLS_MASTER');
		if($job_id)
		{
			$where['job_id'] = $job_id;
			$query = DB::table($tbl_jobsSkill);
			$query = $query->select($tbl_skills.'.skill_id', $tbl_skills.'.skill_name');
			$query = $query->where($where);
			$query = $query->leftJoin($tbl_skills, $tbl_jobsSkill.'.skill_id', '=', $tbl_skills.'.skill_id');
			$query = $query->orderBy($tbl_skills.'.skill_name', 'asc');
			$result = $query->get();
			return $result;
		}
	}
}

if(!function_exists('getDateDifference'))
{
	function getDateDifference($date1="")
	{
		if(!empty($date1)){
			//$date1 = date('Y-m-d H:i:s');
			//$date1 = '2017-06-23 11:45:35';
			$curr_date = date('Y-m-d H:i:s');
			$diff = strtotime($curr_date) - strtotime($date1);
			$response = "";
			if($diff <= 2592000){
				if($diff <= 86400 && $diff >= 60){
					if($diff <= 3600){
						$minute = $diff / 60;
						$response = (int)$minute.' min before';
					}else{
						$calHour = $diff / 3600;
						$restMin = $diff - ((int)$calHour * 3600);
						$minute = $restMin / 60;
						$response = (int)$calHour.' h before';
					}
				}elseif($diff < 60){
					$response = 'Just now';
				}else{
					$getDay = $diff / 86400;
					if((int)$getDay <= 1){
						$response = 'yesterday';
					}else{
						$response = (int)$getDay.' days ago';
					}
				}
			}else{
				$response = date("M jS, Y", strtotime($date1));
			}
			
			return $response;
		}
	}
}

if(!function_exists('getProposalAmtByFreelancer'))
{
	function getProposalAmtByFreelancer($jobId=0, $proposalId=0)
	{
		if((int)$jobId > 0 && (int)$proposalId > 0){
			$amountDetails = JobProposalAmount::where(['job_id'=>$jobId, 'proposal_id'=>$proposalId])->get();
			return $amountDetails;
		}
	}
}

if (! function_exists('generatePin')) {
    function generatePin($digits = 4){
            $i = 0; //counter
            $pin = ""; //our default pin is blank.
            while($i < $digits){
                //generate a random number between 0 and 9.
                $pin .= mt_rand(0, 9);
                $i++;
            }
            return $pin;
        }
}

if (! function_exists('getProposalsByJobId')) {
    function getProposalsByJobId($job_id = 0, $returnType='count'){
        $jobProposals = JobProposal::where(['job_id'=>$job_id])->get();
		$data = '';
		if($returnType == 'count'){
			$data = count($jobProposals);
		}else{
			$data = $jobProposals;
		}
		return $data;
    }
}

if (! function_exists('getTurnAroundTime')) {
    function getTurnAroundTime($where = array())
	{
		$data = TurnAroundTime::where($where)->get();
		return $data;
    }
}

if (! function_exists('getTurnAroundTimeById')) {
    function getTurnAroundTimeById($id = 0)
	{
        $data = TurnAroundTime::find($id);
		return isset($data->around_time_type) ? $data->around_time_type : '';
    }
}

if(! function_exists('checkPrivilege')) {
	/**
	* if '$invalidAccess' return '0', then ok. else redirect to home page
	**/
    function checkPrivilege($userType=0, $redirectTo='/user/dashboard')
    {
    	$invalidAccess = 0;
    	//$redirectTo = 0;
        if(isset($userType) && (int)Auth::user()->type != $userType)
        {
        	$invalidAccess = 0;
        	//$invalidAccess = 1;
        }
        return $invalidAccess;
    }
}

if(! function_exists('profilePicPath')) {
	/**
	* if '$invalidAccess' return '0', then ok. else redirect to home page
	**/
    function profilePicPath($picture='')
    {
    	$picturePath = asset('assets/frontend/images/icon-no-image.png');
    	if( !empty($picture) )
        {
        	$picturePath = asset('assets/frontend/profile_pictures/'.$picture);
        }
        return $picturePath;
    }
}

if(! function_exists('chatFiles')) {
	/**
	* if '$invalidAccess' return '0', then ok. else redirect to home page
	**/
    function chatFiles($meggaseId='')
    {
    	$data = array();
    	if( !empty($meggaseId) )
        {
        	$data = UserChatFile::where(['message_id'=>$meggaseId])->get();
        }
        return $data;
    }
}

if(! function_exists('getUserEmailById')) {
	function getUserEmailById($ids=array())
    {
    	$data = array();
    	if( count($ids) > 0 )
        {
        	//print_r($ids);
        	$data = User::whereIn('id', $ids)->get();
        }
        return $data;
    }
}

if(! function_exists('getUserDetails')) {
	function getUserDetails($ids=array())
    {
    	$data = array();
    	if( count($ids) > 0 )
        {
        	//print_r($ids);
        	$data = UserDetail::whereIn('user_id', $ids)->get();
        }
        return $data;
    }
}

if(! function_exists('getMessageNotificationCount')) {
	function getMessageNotificationCount($id='')
    {
    	$html = '';
    	if((int)$id>0){
    		$user_id = $id;
    	}else{
    		$user_id = isset(Auth::user()->id) ? Auth::user()->id : 0;
    	}

    	$unreadMessage = UserChat::where(['to_user_id'=>$user_id, 'message_read_status'=>'N'])->get();
		$count = count($unreadMessage);

		if($count){
			$html = '<sup class="notification_count">'.$count.'</sup>';
		}

        return $html;
    }
}

if(! function_exists('checkIsJobProvider')) {
	function checkIsJobProvider($job_id=0, $user_id=0)
    {
    	$status = false;

    	if((int)$job_id > 0 && (int)$user_id > 0){
    		$jobDetails = Postedjobs::where(['job_id'=>$job_id])->first();
			if(isset($jobDetails->posted_by_user) && $jobDetails->posted_by_user == $user_id){
				$status = true;
			}
    	}

        return $status;
    }
}

if(! function_exists('getTaskDetailsByTaskID')) {
	function getTaskDetailsByTaskID($task_id=0)
    {
    	$taskDetails = array();

    	if((int)$task_id > 0){
    		$taskDetails = UserJobTask::find($task_id);
    	}

        return $taskDetails;
    }
}

if(! function_exists('getWorkflowAccess')) {
	function getWorkflowAccess($job_id=0, $user_id=0)
    {
    	$status = true;
    	$where['job_id'] = $job_id;
		$jobDetails = Postedjobs::where($where)->first();
		$checkValidFreelance = JobProposal::where([
				'job_id'=>$job_id,
				'is_accepted'=>'Y'
			])->first();

		//print_r($jobDetails);
		//print_r($checkValidFreelance);exit;
		if($jobDetails->posted_by_user != $user_id && !isset($checkValidFreelance->sent_by_user)){
			$status = false;
		}

		if($jobDetails->posted_by_user != $user_id && (isset($checkValidFreelance->sent_by_user) && $checkValidFreelance->sent_by_user != $user_id)){
			$status = false;
		}
		return $status;
    }
}

if(! function_exists('getMessageAccess')) {
	function getMessageAccess($job_id=0, $user_id=0)
    {
    	$status = true;
    	$where['job_id'] = $job_id;
		$jobDetails = Postedjobs::where($where)->first();
		$checkValidFreelance = JobProposal::where([
				'job_id'=>$job_id,
				'sent_by_user'=>$user_id
			])->first();

		//print_r($jobDetails);
		//echo count($checkValidFreelance);exit;
		if($jobDetails->posted_by_user != $user_id && count($checkValidFreelance) <= 0){
			$status = false;
		}
		return $status;
    }
}

if(! function_exists('getProposalAccess')) {
	function getProposalAccess($job_id=0, $user_id=0)
    {
    	$status = true;
    	$where['job_id'] = $job_id;
		$jobDetails = Postedjobs::where($where)->first();

		//print_r($jobDetails);
		//print_r($checkValidFreelance);exit;
		if($jobDetails->posted_by_user != $user_id){
			$status = false;
		}
		return $status;
    }
}

if(! function_exists('checkIsPaidRespectMilestone')) {
	function checkIsPaidRespectMilestone($milestoneId=0)
    {
    	$data = array();
    	$where['milestone_id'] = $milestoneId;
		$data = UserTransaction::where($where)->get();
		return $data;
    }
}

if(! function_exists('getUserById')) {
	function getUserById($id=0)
    {
    	$data = array();
    	if( (int)$id > 0 )
        {
        	//print_r($ids);
        	$data = User::find($id);
        }
        return $data;
    }
}

if(! function_exists('getTotalDebitedOrCreditedBalance')) {
	function getTotalDebitedOrCreditedBalance($user_id=0, $transaction_type='')
    {
    	if( (int)$user_id > 0 && in_array($transaction_type, array('D', 'C')) )
        {
        	$totalBalance = DB::select('SELECT SUM(amount) my_bal FROM '.config('constants.TBL_USER_TRANSACTIONS').' WHERE user_id="'.$user_id.'" AND transaction_type="'.$transaction_type.'"');
        }
        $data = isset($totalBalance[0]->my_bal) ? $totalBalance[0]->my_bal : 0;
    	return $data;
    }
}

if(! function_exists('getJobAwardedAmount')) {
	function getJobAwardedAmount($job_id=0)
    {
    	$data = array();
    	if((int)$job_id > 0){
    		$data = DB::select('SELECT SUM(amount) amount FROM '.config('constants.TBL_JOB_PROPOSAL_AMOUNT').' WHERE job_id="'.$job_id.'" AND is_paid!="1"');
    	}
    	//dd($data); exit;
    	return isset($data[0]->amount) ? $data[0]->amount : '0.00';
    }
}

if(! function_exists('getNotificationsUpdateByUsers')) {
	function getNotificationsUpdateByUsers($user_id=0)
    {
    	$data = array();
    	if((int)$user_id > 0){
    		$data = DB::select('SELECT details FROM notification_masters WHERE id IN(SELECT notification_id FROM user_wants_notifications WHERE user_id="'.$user_id.'")');
    	}
    	//dd($data); exit;
    	return $data;
    }
}

if(! function_exists('getUpdateNeedsByUsers')) {
	function getUpdateNeedsByUsers($user_id=0)
    {
    	$data = array();
    	if((int)$user_id > 0){
    		$data = DB::select('SELECT details FROM update_masters WHERE id IN(SELECT update_id FROM user_wants_updates WHERE user_id="'.$user_id.'")');
    	}
    	//dd($data); exit;
    	return $data;
    }
}

if( ! function_exists('getIncomeExpense') ){
	function getIncomeExpense($IncomeOrStatus=1, $user_id=0, $earningType='M', $from_date='', $to_date='')
    {
    	$data = '0';
    	$netAmount = '0';
    	
    	switch($IncomeOrStatus){
    		case 1:
    		if($earningType=='M'){
    			$income = DB::select('SELECT SUM(gross_amt) as total_amt, SUM(vat_percent) as total_vat FROM '.config('constants.TBL_INVOICE').' WHERE invoice_for_user="'.$user_id.'" AND status="1" AND (DATE(invoice_date) BETWEEN "'.$from_date.'" AND "'.$to_date.'")');
    		}else{
    			$to_date = date('Y-m-d');
    			$income = DB::select('SELECT SUM(gross_amt) as total_amt, SUM(vat_percent) as total_vat FROM '.config('constants.TBL_INVOICE').' WHERE invoice_for_user="'.$user_id.'" AND status="1" AND DATE(invoice_date) <= "'.$to_date.'"');
    		}

    		$netAmount = isset($income[0]->total_amt) ? $income[0]->total_amt : '0';
    		break;

    		case 2:
    		if($earningType=='M'){
    			$expense = DB::select('SELECT SUM(gross_amt) as total_amt, SUM(vat_percent) as total_vat FROM '.config('constants.TBL_INVOICE').' WHERE invoice_by_user="'.$user_id.'" AND status="1" AND (DATE(invoice_date) BETWEEN "'.$from_date.'" AND "'.$to_date.'")');
    		}else{
    			$to_date = date('Y-m-d');
    			$expense = DB::select('SELECT SUM(gross_amt) as total_amt, SUM(vat_percent) as total_vat FROM '.config('constants.TBL_INVOICE').' WHERE invoice_by_user="'.$user_id.'" AND status="1" AND DATE(invoice_date) <= "'.$to_date.'"');
    		}
    		$netAmount += isset($expense[0]->total_amt) ? $expense[0]->total_amt : '0';
    		break;
    	}

    	return $netAmount;
    }
}

if(! function_exists('makeDotMoreTxt') ) {
	function makeDotMoreTxt($text=0, $length=40)
    {
    	$data = array();
    	if(!empty(trim($text))){
    		if(strlen($text) > $length){
    			$text = substr($text, 0, $length).'...';
    		}else{
    			$text = $text;
    		}
    	}

    	return $text;
    }
}

if(! function_exists('getProfileNotificationHelper') ) {
	function getProfileNotificationHelper($user_id=0)
    {
    	$data['unreadNotifications'] = UserNotification::where(['user_id'=>$user_id, 'viewed_status'=>'N'])->orderBy('id', 'DESC')->get();
		$data['readNotifications'] = UserNotification::where(['user_id'=>$user_id, 'viewed_status'=>'Y'])->orderBy('id', 'DESC')->get();
		
		/*$count = count($unreadNotifications);
		$return_array['countNewNotification'] = $count;
		$returnHTML = view('layouts/notification', compact('unreadNotifications', 'readNotifications'))->render();
		$return_array['returnHTML'] = $returnHTML;*/

		return $data;
    }
}

if(! function_exists('getJobsReview') ) {
	function getJobsReview($where=array())
    {
    	$data = JobRating::where($where)->get();
    	//print_r($data); exit;
		return $data;
    }
}

if(! function_exists('getJobsDetails') ) {
	function getJobsDetails($where=array())
    {
    	$data = Postedjobs::where($where)->get();
		return $data;
    }
}

if(! function_exists('getProposalDetails') ) {
	function getProposalDetails($user_id=0, $job_id=0, $isShortlisted='', $isAccepted='')
    {
    	$where=array();
    	if($user_id){
    		$where['sent_by_user'] = $user_id;
    	}
    	if($job_id){
    		$where['job_id'] = $job_id;
    	}
    	if($isShortlisted){
    		$where['is_shortlisted'] = 'Y';
    	}
    	if($isAccepted){
    		$where['is_accepted'] = 'Y';
    	}
    	$data = JobProposal::where($where)->get();
		return $data;
    }
}

if(! function_exists('getJobRatings') ) {
	function getJobRatings($where=array())
    {
    	$data = JobRating::where($where)->first();
    	//print_r($data); exit;
    	$returnData = isset($data->rating) ? $data->rating : '0';
		return $returnData;
    }
}

if(!function_exists("encrypt"))
{
	function encrypt($string, $key) {
		$result = '';
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64_encode($result);
	}
}
if(!function_exists("decrypt"))
{
	function decrypt($string, $key) {
		$result = '';
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		if ($errors->isEmpty()){
			return 0;
		}
		return $result;
	}
}

if(!function_exists("getJobSettings"))
{
	function getJobSettings() {
		$jobSettings = SettingsJob::first();
		return $jobSettings;
	}
}

if(!function_exists("getTotalBidCreditsDebits"))
{
	function getTotalBidCreditsDebits($user_id=0, $transaction_type='', $amount_type='') {
		// $bidCreditsDebits = MonthlyBidDetail::where($where)->get();
		// return $bidCredits;
		if( (int)$user_id > 0 && in_array($transaction_type, array('D', 'C')) )
        {
        	$totalBidCreditsDebits = DB::select('SELECT SUM(bid_debited_credit_amount) my_bal FROM '.config('constants.TBL_MONTHLY_BID_DETAILS').' WHERE user_id="'.$user_id.'" AND type="'.$transaction_type.'"');
        	if($amount_type){
        		$totalBidCreditsDebits .= " AND amount_type='".$amount_type."'";
        	}
        }
        $data = isset($totalBidCreditsDebits[0]->my_bal) ? $totalBidCreditsDebits[0]->my_bal : 0;
    	return $data;
	}
}


if(!function_exists("getBidCreditsDebits"))
{
	function getBidCreditsDebits($user_id='0', $month='') {
		$data = array();
		if( (int)$user_id > 0 )
        {
        	$data = DB::select('
        		SELECT 
        		user_id, 
        		(SELECT SUM(bid_debited_credit_amount) FROM '.config('constants.TBL_MONTHLY_BID_DETAILS').' WHERE type="C" AND amount_type="P" AND user_id="'.$user_id.'") as paidBidCredit, 
        		(SELECT SUM(bid_debited_credit_amount) FROM '.config('constants.TBL_MONTHLY_BID_DETAILS').' WHERE DATE_FORMAT(created_at, "%m-%Y")="'.$month.'" AND type="C" AND amount_type="F" AND user_id="'.$user_id.'") as freeBidCredit, 
        		(SELECT SUM(bid_debited_credit_amount) FROM '.config('constants.TBL_MONTHLY_BID_DETAILS').' WHERE type="D" AND amount_type="P" AND user_id="'.$user_id.'") as paidBidDebit, 
        		(SELECT SUM(bid_debited_credit_amount) FROM '.config('constants.TBL_MONTHLY_BID_DETAILS').' WHERE DATE_FORMAT(created_at, "%m-%Y")="'.$month.'" AND type="D" AND amount_type="F" AND user_id="'.$user_id.'") as freeBidDebit 
        		FROM '.config('constants.TBL_MONTHLY_BID_DETAILS').' where user_id="'.$user_id.'"
        		GROUP BY user_id
        	');
        }
    	return isset($data['0']) ? $data['0'] : array();
	}
}




