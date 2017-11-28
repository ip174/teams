<?php

namespace App\Http\Controllers;

use DB;
use App\Country;
use App\User;
use App\UserLogin;
use App\UserDetail;
use App\UserSkills;
use App\UserPortfolio;
use App\CustomerAddress;
use App\JobProposal;
use App\UserNotification;
use App\JobAssesments;
use App\JobSkillMap;
use App\Postedjobs;
use App\ExperienceLevel;
use App\Budget;
use App\JobType;
use App\ProjectLength;
use App\TurnAroundTime;
use App\JobRating;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
https://github.com/Intervention/image

class UserController extends Controller
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

    public function myAccount()
    {
        $countries = Country::all();
        $data = [
            'countries' => $countries,
            'billingAddress' => Auth::user()->billingAddress,
            'shippingAddress' => Auth::user()->shippingAddress,
        ];

        return view('user.my_account', $data);
    }
	
	public function user_dashboard()
    {
		$tbl_users = config('constants.TBL_USERS');
		$tbl_user_details = config('constants.TBL_USERS_DETAILS');
		$tbl_userSkillMap = config('constants.TBL_USERS_SKILLS');
		
		$user = Auth::user();
		//dd(Auth::user()->type); exit;
		$recommendedJobsPerPage = config('constants.DASHBOARD_RECOMENDED_JOBS_PER_PAGE');

		$last_login = UserLogin::where(['user_id'=>$user['id']])->orderBy('id', 'DESC')->first();
		
		$results = DB::table($tbl_users)
			->select($tbl_users.'.*', $tbl_user_details.'.*', DB::raw('GROUP_CONCAT('.$tbl_userSkillMap.'.skill_id) as skills'))
			->leftJoin($tbl_user_details, $tbl_users.'.id', '=', $tbl_user_details.'.user_id')
			->leftJoin($tbl_userSkillMap, $tbl_users.'.id', '=', $tbl_userSkillMap.'.user_id')
			//->selectRaw('GROUP_CONCAT(user_skill_map.skill_id) as skills')
			->where($tbl_users.'.id', $user['id'])
			->groupBy($tbl_userSkillMap.'.user_id')
			->first();
		//dd($results); exit;
		$user_det = $results;

		$invitationJobsList = DB::select('SELECT * FROM '.config('constants.TBL_PROPOSALS').' jp LEFT JOIN '.config('constants.TBL_POSTED_JOBS').' pj ON jp.job_id=pj.job_id WHERE jp.sent_by_user="'.$user['id'].'" AND pj.job_status="5" LIMIT 0, 5');

		$inProgressJobsList = DB::select('SELECT * FROM '.config('constants.TBL_PROPOSALS').' jp LEFT JOIN '.config('constants.TBL_POSTED_JOBS').' pj ON jp.job_id=pj.job_id WHERE jp.sent_by_user="'.$user['id'].'" AND pj.job_status="2" AND jp.is_accepted="Y" LIMIT 0, 5');
        //dd($inProgressJobs); exit;

        $postedJobs = DB::select('SELECT * FROM '.config('constants.TBL_POSTED_JOBS').' WHERE posted_by_user="'.$user['id'].'"');

        $inProgressJobsCount = DB::select('SELECT * FROM '.config('constants.TBL_PROPOSALS').' jp LEFT JOIN '.config('constants.TBL_POSTED_JOBS').' pj ON jp.job_id=pj.job_id WHERE jp.sent_by_user="'.$user['id'].'" AND pj.job_status="2" AND jp.is_accepted="Y"');

		$myCompletedJobs = DB::select('SELECT * FROM '.config('constants.TBL_PROPOSALS').' jp LEFT JOIN '.config('constants.TBL_POSTED_JOBS').' pj ON jp.job_id=pj.job_id WHERE jp.sent_by_user="'.$user['id'].'" AND pj.job_status="4" AND jp.is_accepted="Y"');

		//$recomendJobs = DB::select('SELECT * FROM '.config('constants.TBL_POSTED_JOBS').' pj LEFT JOIN '.config('constants.TBL_JOB_SKILL_MAP').' jsm ON pj.job_id=jsm.job_id LEFT JOIN '.config('constants.TBL_USERS_SKILLS').' usm ON jsm.skill_id=usm.skill_id WHERE usm.user_id="'.$user['id'].'" AND pj.posted_by_user="'.$user['id'].'" GROUP BY pj.job_id ORDER BY RAND() LIMIT 0, 5');

		$dayWiseProfileViews = DB::select('SELECT count(view_to_user) as total_view, weekdays FROM '.config('constants.TBL_USERS_PROFILE_VIEWS').' WHERE view_to_user="'.Auth::user()->id.'" AND DATE_FORMAT(created_at, "%m-%Y")="'.date('m-Y').'" GROUP BY weekdays ORDER BY weekdays ASC');

		$currentMonth = date('m');
		$lastMonth = $currentMonth == 1 ? '12' : ($currentMonth-1);
		$currentYear = date('Y');
		$lastYear = $currentMonth == 1 ? ($currentYear-1) : $currentYear;
		$lastMonthProfileViews = DB::select('SELECT count(view_to_user) as total_view, weekdays FROM '.config('constants.TBL_USERS_PROFILE_VIEWS').' WHERE view_to_user="'.Auth::user()->id.'" AND DATE_FORMAT(created_at, "%m-%Y")="'.$lastMonth.'-'.$lastYear.'" GROUP BY weekdays ORDER BY weekdays ASC');
		//dd($dayWiseProfileViews); exit;

		$totalReviewsDetails = DB::select('SELECT count(review_for_user) as totalReviews, SUM(rating) as totalRating FROM '.config('constants.TBL_JOB_RATINGS').' WHERE review_for_user="'.Auth::user()->id.'"');

		$recomendJobs = DB::table(config('constants.TBL_POSTED_JOBS'))
			->select(config('constants.TBL_POSTED_JOBS').'.*')
			->leftJoin(config('constants.TBL_JOB_SKILL_MAP'), config('constants.TBL_POSTED_JOBS').'.job_id', '=', config('constants.TBL_JOB_SKILL_MAP').'.job_id')
			->leftJoin(config('constants.TBL_USERS_SKILLS'), config('constants.TBL_JOB_SKILL_MAP').'.skill_id', '=', config('constants.TBL_USERS_SKILLS').'.skill_id')
			->where(config('constants.TBL_USERS_SKILLS').'.user_id', $user['id'])
			->where(config('constants.TBL_POSTED_JOBS').'.posted_by_user', '!=', $user['id'])
			->whereIn(config('constants.TBL_POSTED_JOBS').'.job_status', array(1, 3))
			->groupBy(config('constants.TBL_POSTED_JOBS').'.job_id')
			//->orderBy('RAND()')
			->paginate($recommendedJobsPerPage);
		//dd($recomendJobs); exit;
		
		
        //return view('user.my_dashboard', $data);
        return view('user.my_dashboard', compact(
        	'last_login',
            'user_det',
            'inProgressJobsList',
            'postedJobs',
            'myCompletedJobs',
            'inProgressJobsCount',
            'recomendJobs',
            'invitationJobsList',
            'dayWiseProfileViews',
            'lastMonthProfileViews',
            'totalReviewsDetails'
        ));
    }
	
	public function userProfile(Request $request)
    {
		$data = [];
		$user = Auth::user();
		$id = $user['id'];
		$per_page = config('constants.PORTFOLIO_PER_PAGE');
		
		$user = User::where(['id'=>$id])
		->first();
		$data['user'] = $user;
		$data['user_id'] = Auth::user()->id;
		//debug($user); exit;
		
		$userDetails = UserDetail::where(['user_id'=>$id])
		->first();
		$data['userDetails'] = $userDetails;
		//debug($userDetails); exit;
		
		$userSkills = UserSkills::where(['user_id'=>$id])
		->get();
		$data['userSkills'] = $userSkills;
		$userSkillArray = array();
		if(count($userSkills) > 0){
			foreach($userSkills as $eachSkill){
				$userSkillArray[] = $eachSkill->skill_id;
			}
		}
		$mySkills = count($userSkillArray) > 0 ? get_skills_by_multiple_id(array(), $userSkillArray, "*") : array();
		$data['mySkills'] = $mySkills;
		
		$portfolio_type = app('request')->input('portfolio_type');
		$userPortfolios = UserPortfolio::where('status', '!=', '3');
		$userPortfolios = $userPortfolios->where(['user_id'=>$id]);
		if($portfolio_type=="1")
		{
			$userPortfolios = $userPortfolios->orderBy('number_of_views', 'DESC');
		}
		elseif($portfolio_type=="2")
		{
			$userPortfolios = $userPortfolios->orderBy('likes', 'DESC');
		}
		else
		{
			$userPortfolios = $userPortfolios->orderBy('portfolio_id', 'DESC');
		}
		
		$userPortfolios = $userPortfolios->paginate($per_page);

		$data['userPortfolios'] = $userPortfolios;
		$data['portfolio_type'] = $portfolio_type;
		
		//dd($data); exit;

		$reviewPostedJobsId = JobRating::select('job_id')->where(['review_for_user'=>$id])->orWhere('review_by_user', $id)->groupBy('job_id')->get();
		//dd($reviewPostedJobsId);
		$reviewPostedJobsDetails = $reviewPostedJobsProposals = array();
		if(count($reviewPostedJobsId))
		{
			$reviewPostedJobsDetails = Postedjobs::select('*')->whereIn('job_id', $reviewPostedJobsId)->get();
			$reviewPostedJobsProposals = JobProposal::select('*')->whereIn('job_id', $reviewPostedJobsId)->where('is_accepted', 'Y')->get();
		}
		//dd($reviewPostedJobsDetails);
		$data['reviewPostedJobsDetails'] = $reviewPostedJobsDetails;
		$data['reviewPostedJobsProposals'] = $reviewPostedJobsProposals;
		
        return view('user.my_profile', $data);
    }
	
	public function edit_profile(Request $request)
    {
		$user = Auth::user();
		//debug($user); exit;
		
		$method = $request->method();
		
		//====================Get all active focus from database====================//
		$all_focus = get_focus('', array('status'=>'1'), "*");
		$data['all_focus'] = $all_focus;
		
		//====================Get all active field of work from database====================//
		$all_workField = get_workField('', array('status'=>'1'), "*");
		$data['all_workField'] = $all_workField;
		
		//====================Get all active job types from database====================//
		$all_jobType = get_jobType('', array('status'=>'1'), "*");
		$data['all_jobType'] = $all_jobType;
		
		//====================Get all active skills from database====================//
		$all_skills = get_skills('', array('status'=>'1'), "*");
		$data['all_skills'] = $all_skills;
		
		//====================Get all active skills from database====================//
		$all_travelType = get_travelType('', array('status'=>'1'), "*");
		$data['all_travelType'] = $all_travelType;
		
		//====================Get all category from database====================//
		$all_category = getCategorySubcategory(array('parent_category_id'=>'0', 'status'=>'1'), 0);
		$data['all_category'] = $all_category;
		
		//====================Get all sub-category from database====================//
		$all_subCategory = getCategorySubcategory(array('status'=>'1'), 1);
		$data['all_subCategory'] = $all_subCategory;
		
		
		if( $request->isMethod('post') ){
			//====================User provided data in the form====================//
			$postData = $request->all();
			
			$where['user_id'] = $user['id'];
			$check_exist = DB::table("user_details")->where($where)->get();
			//exit;
			
			if(@$postData['isAjax']){
				//======================Code for Ajax Save=====================//
				$updateUserDet[$postData['field_name']] = @$postData['field_data'];
				if(count($check_exist)>=1){
					//======================A row found in the database respect this user=====================//
					DB::table('user_details')
						->where('user_id', $user['id'])
						->update($updateUserDet);
				}else{
					//==================A row does not found in the database respect this user==================//
					$updateUserDet['user_id'] = @$user['id'];
					DB::table('user_details')->insert($updateUserDet);
				}
				$response = array(
					'status' => 'success',
					'msg' => 'Successfully save'
				);
				return \Response::json($response);
				//exit;
			}else{
				$this->validate($request,[
					'first_name'=>'required|string|min:3',
					'last_name'=>'required|string|min:3'
				]);
				
				$skills = @$postData['skills'];
				$skillInsert = array();
				for($i=0; $i < sizeof($skills); $i++){
					$skillInsert[$i]['user_id'] = $user['id'];
					$skillInsert[$i]['skill_id'] = $skills[$i];
				}
				
				$userUpdate['first_name'] = $postData['first_name'];
				$userUpdate['last_name'] = $postData['last_name'];
				$userUpdate['profile_availability'] = @$postData['profile_available_in_seach_engine'];
				
				
				//======================Code for normal form submit Save=====================//
				DB::table('user_skill_map')->where('user_id', '=', $user['id'])->delete();
				if($skillInsert){
					DB::table('user_skill_map')->insert($skillInsert);
				}
				DB::table('users')
				->where('id', $user['id'])
				->update($userUpdate);
				
				$updateUserDet['focus'] = @$postData['focus'];
				$updateUserDet['field_of_work'] = @$postData['field_of_work'];
				$updateUserDet['about'] = @$postData['about_me'];
				
				$file = $request->file('introduce_file');
				//if($file->getClientOriginalName()){
				if($_FILES['introduce_file']['name']){
					$save_name = time(). '-' . str_replace(' ', '-', $file->getClientOriginalName());
					$file = $file->move(public_path().'/assets/frontend/introvideos/', $save_name);
					$updateUserDet['sample_video'] = @$save_name;
				}
				
				if(count($check_exist)>=1){
					//======================A row found in the database respect this user=====================//
					DB::table('user_details')
						->where('user_id', $user['id'])
						->update($updateUserDet);
				}else{
					//==================A row does not found in the database respect this user==================//
					$updateUserDet['user_id'] = @$user['id'];
					DB::table('user_details')->insert($updateUserDet);
				}
				return redirect('user/my-profile');
			}
		}
		
		$results = DB::table('users')
			->select('users.*', 'user_details.*', DB::raw('GROUP_CONCAT(user_skill_map.skill_id) as skills'))
			->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
			->leftJoin('user_skill_map', 'users.id', '=', 'user_skill_map.user_id')
			//->selectRaw('GROUP_CONCAT(user_skill_map.skill_id) as skills')
			->where('users.id', $user['id'])
			->groupBy('user_skill_map.user_id')
			->first();
		//dd($results); exit;
		
		$data['user_det'] = $results;
		
		$data['dataSkills'] = array();
		if(@$postData['skills']){
			$data['dataSkills'] = $postData['skills'];
		}else if($results->skills){
			$data['dataSkills'] = explode(',', $results->skills);
		}
        return view('user.edit_profile', $data);
    }
	
	public function upload_profile_picture(Request $request){
		$user = Auth::user();
		//debug($user); exit;
		
		/*$this->validate($request,[
			'image_file'=>'required|image|mimes:jpeg,jpg,png|dimensions:min_width=100,max_width=250'
		]);*/
		//debug($_FILES); exit;
		//===========================New Crop Image Upload Start===========================//
		
		$post_data = $request->all();
		//debug($post_data); exit;
		
		$upload_path = public_path().'/assets/frontend/profile_pictures/';		
		$time = time();
		//$file_name_org = $time.strtolower(str_replace(' ', '-', $post_data['image_name']));
		//$file_name = $time.'-crop-'.strtolower(str_replace(' ', '-', $post_data['image_name']));
		$file_name_org = $time.strtolower(str_replace(' ', '-', $post_data['image_name']));
		$file_name = $request->user()->id.'-'.strtolower(str_replace(' ', '-', $post_data['image_name']));
		
		if($post_data['action'] == 'insert'){
			$replace = 'data:'.$post_data['image_type'].';base64,';			
			$image_file = str_replace($replace, '', $post_data['image_file']);			
			$image_file = str_replace(' ', '+', $image_file);
			$image_file = base64_decode($image_file);			
		}else{
			$image_file = file_get_contents($post_data['image_file']);
		}
		//debug($post_data); exit;
		
		$file_org = $upload_path.$file_name_org;
		$file = $upload_path.$file_name;
		file_put_contents($file_org, $image_file);
		file_put_contents($file, $image_file);			
		$user_id = $request->user()->id;
		$user_cond = array();
		$user_cond['id'] = $user_id;
		$user_details = DB::table("users")->where($user_cond)->get();
		$user_det = $user_details[0];
		//debug($user_det); exit;
		
		//debug($user_det->profile_picture); exit;
		if($user_det->profile_picture != '')
		{
			$img_file_path = $upload_path.$user_det->profile_picture;
			if (file_exists($img_file_path)) 
			{
				unlink($img_file_path);
			}
		}
		$img_data = array();
		//$img_data['profile_picture'] = $file_name_org;
		$userUpdate['profile_picture'] = $file_name_org;
		//$this->userdata->udpateUser($img_data,$user_cond);
		DB::table('users')
		->where('id', $user_id)
		->update($userUpdate);
		
		$this->img_resize_to_fixed_dimension($file_name, $post_data['image_type'], $upload_path, $upload_path, $post_data['nWidth'], $post_data['nHeight']);	
				
		$image_path_org = $upload_path.$file_name_org;
		$image_path = $upload_path.$file_name;
		$targ_w = $post_data['w'];
		$targ_h = $post_data['h'];
		$jpeg_quality = 90;
		switch(strtolower($post_data['image_type']))
		{
			case 'image/png':
				$image_res =  imagecreatefrompng($image_path);
				break;
			/*case 'image/gif':
				$image_res =  imagecreatefromgif($image_path);
				break;*/
			case 'image/jpeg': case 'image/pjpeg':
				$image_res = imagecreatefromjpeg($image_path);
				break;
			default:
				$image_res = false;
		}
		
		if($image_res)
		{
			$dst_r = ImageCreateTrueColor($targ_w,$targ_h);
			imagecopyresampled($dst_r,$image_res,0,0,$post_data['x'],$post_data['y'],$targ_w,$targ_h,$post_data['w'],$post_data['h']);
			//unlink($image_path);
			switch(strtolower($post_data['image_type']))
			{
				case 'image/png': 
					imagepng($dst_r, $image_path); 
					$flag = 1;
					break;
				case 'image/gif': 
					imagegif($dst_r, $image_path); 
					$flag = 1;
					break;          
				case 'image/jpeg': 
				case 'image/pjpeg': 
					imagejpeg($dst_r, $image_path, $jpeg_quality);
					 $flag = 1;
					break;
				default: $flag = 0;
			}
			if($flag == 1)
			{
				if($user_det->profile_picture != '')
				{
					$img_file_path = $upload_path.$user_det->profile_picture;
					if (file_exists($img_file_path))
					{
						unlink($img_file_path);
					}
				}
				$imgdata = array();
				//$img_data['profile_picture'] = $file_name;
				$userUpdate['profile_picture'] = $file_name;
				//$this->userdata->udpateUser($img_data, $user_cond);
				DB::table('users')
				->where('id', $user_id)
				->update($userUpdate);
				
				if($file_name_org){
					$main_file_path = $upload_path.$file_name_org;
					unlink($main_file_path);
				}
				//echo url($image_path).'?ver='.time();
				$json_array['error'] = '0';
				$json_array['msg'] = 'Successfully Uploaded';
				
				return response()->json($json_array);
			}
			else
			{
				echo "0";
			}
		}
		exit;
		return redirect('user/edit-profile');
		//===========================New Crop Image Upload End===========================//
	}
	
	public function img_resize_to_fixed_dimension($file_name, $extn, $source_folder, $dest_folder="", $new_width, $new_height)
	{
		$filename = $source_folder . $file_name;
		if($dest_folder<>"/" && $dest_folder<>""){
			$filename1 = $dest_folder . $file_name;
		}
		else
		{
			$filename1 = $filename;
		}
		
		// Get new dimensions
		list($width, $height) = getimagesize($filename);
		
		
		$image_p = imagecreatetruecolor($new_width, $new_height);
		if (strtolower($extn)=='image/jpeg' || strtolower($extn)=='image/pjpeg')
		{
			$image = imagecreatefromjpeg($filename);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			// Output
			imagejpeg($image_p,$filename1, 100);
			imagedestroy($image_p);
			imagedestroy($image);
		}
		else if (strtolower($extn)=='image/gif')
		{
			$image = @imagecreatefromgif($filename);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			// Output
			imagegif($image_p, $filename1);
			//imagejpeg($image_p,"../images/products/thumb_".$filefname.".jpg", 100);
			imagedestroy($image_p);
			imagedestroy($image);
		}
		else if (strtolower($extn)=='image/png')
		{
			$image = imagecreatefrompng($filename);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			// Output
			imagepng($image_p,$filename1);
			imagedestroy($image_p);
			imagedestroy($image);
		}
		return $filename1;
	}
	
	public function uploadProfilePicture(Request $request)
	{
		$user = Auth::user();
		$user_id = $user['id'];
		
		//$user_details = $this->userdata->grabUserData(array('id' => $user_id));
		$return_data = array();
		$user_cond['id'] = $request->user()->id;
		if(count($user_cond) > 0)
		{
			$check_exist = DB::table("users")->where($user_cond)->get();
			$return_data = $check_exist[0];
		}
		//debug($return_data);
		//exit;

		if(count($return_data) > 0)
		{
			$uid = $return_data->id;

			/*************Set User Profile picture and name*************/
			if(!$return_data->profile_picture){
				$return_data->name 		= "Anonymous";
				$return_data->firstName	= "Anonymous";
				$return_data->lastName	= "";
				$return_data->profile_picture = "icon-no-image.png";
			}			
		}
		$user_details = $return_data;
		//debug($user_details); exit;
		
		$file_name = $file_url = '';
		$has_image = 0;
		$image_type = $image_file = '';
		if($user_details->profile_picture != '')
		{
			$file_name = $user_details->profile_picture;
			$file_url = asset('assets/frontend/profile_pictures/');
			$data['file_url'] = $file_url;
			$upload_path = asset('assets/frontend/profile_pictures/');
			//$image_details = getimagesize($upload_path.$file_name);
			//debug($data); exit;
			//$image_type = $image_details['mime'];
			$has_image = 1;
			$image_file = $file_url;
		}
		$data['imagetype'] = '';//$image_type;
		$data['file_name'] = $file_name;
		$data['image_file'] = $image_file;
		//debug($data); exit;
		
		$html = view('user.upload_profile_picture_lightbox', $data)->render();
		//debug($html); exit;
		
		$json_array['html'] = $html;
		$json_array['has_image'] = $has_image;
		
		return response()->json($json_array);
	}
	
	/*public function verify_account($url_params=''){
		
		echo $url_params; exit;
		$data = [];
		
		$where['id'] = $url_params;
		$check_exist = DB::table("users")->where($where)->get();
		//dd(count($check_exist)); exit;
		
		if(count($check_exist) >= 1){
			$userUpdate['is_active'] = 'Y';
			DB::table('users')
			->where('id', $url_params)
			->update($userUpdate);
			
			$data['response_msg'] = "success";
		}else{
			$data['response_msg'] = "error";
		}
		//dd($data); exit;
		
		return view('auth.verify_account', $data);
	}*/
	

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:new_password'
        ]);

        $input = $request->all();

        if (Hash::check($input['current_password'], Auth::user()->password)) {
            Auth::user()->password = bcrypt($input['new_password']);
            Auth::user()->save();

            return redirect()->back()->with('success', 'Update was successfully done.');
        }
        else {
            return redirect()->back()->with('error', 'Sorry! Current password didn\'t match.');
        }
    }

    public function saveCustomerAddress(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'email' => 'string|email|max:255',
            'type' => [
                'required',
                Rule::in([1, 2]),
            ],
            'zipcode' => 'required',
            'country_id' => 'required|exists:countries,id',
        ]);

        $input = $request->all();

        // For Billing address.
        if ($input['type'] == 1) {
            // Create new
            if (Auth::user()->billingAddress === null) {
                $customerAddress = new CustomerAddress($input);
                $customerAddress->user_id = Auth::user()->id;
                $customerAddress->save();
            }
            else {
                Auth::user()->billingAddress->fill($input);
                // Save user.
                Auth::user()->push();
            }
        }
        else {
            // Create new
            if(Auth::user()->shippingAddress === null) {
                $customerAddress = new CustomerAddress($input);
                $customerAddress->user_id = Auth::user()->id;
                $customerAddress->save();
            }
            else {
                Auth::user()->shippingAddress->fill($input);
                // Save user.
                Auth::user()->push();
            }
        }

        return redirect()->back()->with('success' . $input['type'], 'Update was successfully done.');
    }
	
	public function upload_portfolio(Request $request){
		$post_data = $request->all();
		$json_array['return_status'] = 0; //file not uploaded
		$tbl_portfolios = config('constants.TBL_PORTFOLIO');
		
		if ($_POST)
		{
			$upload_path = public_path().'/assets/upload/portfolios/';
			
			if((int)@$post_data['field_id'] == 0)
			{
				$insert_array['user_id'] = $request->user()->id;
			}
			
			$insert_array['portfolio_name'] = $post_data['portfolio_name'];
			$insert_array['uploaded_date'] = date('Y-m-d H:i:s');
			
			$insert_array['description'] = nl2br($post_data['description']);
			$insert_array['short_desription'] = substr(preg_replace( "/<[^>]*>/", "", $post_data['description']), 0, 30);
			
			$insert_array['file_path'] = asset('assets/upload/portfolios');
			$insert_array['portfolio_link'] = $post_data['link'];
			
			if(isset($_FILES['userImage']['tmp_name']))
			{
				$fileName = $post_data['field_id'] && $post_data['file_name'] ? $post_data['file_name'] : time().$insert_array['user_id'].str_replace(" ", "-", $_FILES['userImage']['name']);
				$sourcePath = $_FILES['userImage']['tmp_name'];
				$targetPath = $upload_path.$fileName;
				
				if((int)$post_data['field_id'] == 0)
				{
					$insert_array['file_name'] = $fileName;
				}
				move_uploaded_file($sourcePath, $targetPath);
				//if(move_uploaded_file($sourcePath, $targetPath)){
				//}
			}
			
			if($post_data['field_id'] && @$post_data['file_name'])
			{
				DB::table($tbl_portfolios)
					->where('portfolio_id', $post_data['field_id'])
					->update($insert_array);
				
				$json_array['return_status'] = 1; //Successfully uploaded
				$json_array['return_msg'] = "Successfully Inserted";
			}
			else
			{
				DB::table($tbl_portfolios)->insert($insert_array);
				$json_array['return_status'] = 1; //Successfully uploaded
				$json_array['return_msg'] = "Successfully Updated";
			}
		}
		
		return response()->json($json_array);
	}
	
	public function getPortfolioById(Request $request){
		$post_data = $request->all();
		$json_array['return_status'] = 0;
		$json_array['portfolios_data'] = "";
		
		if($request->isMethod('post')){
			$tbl_portfolios = config('constants.TBL_PORTFOLIO');
			$portfolios = DB::table($tbl_portfolios)
					->select($tbl_portfolios.'.*');
			$portfolios = $portfolios->where($tbl_portfolios.'.status', '=', 1);
			$portfolios = $portfolios->where($tbl_portfolios.'.portfolio_id', '=', $post_data['p_id']);
			$portfolios = $portfolios->get();
			//debug($portfolios);
			if(@$portfolios[0]){
				$json_array['return_status'] = 1;
				$json_array['portfolios_data'] = @$portfolios[0];
			}
		}
		
		return response()->json($json_array);
	}
	
	public function action_against_portfolio(Request $request)
	{
		$tbl_portfolios = config('constants.TBL_PORTFOLIO');
		$tbl_portfolios_actions = config('constants.TBL_PORTFOLIO_ACTIONS');
		$json_array['post_status'] = 0;
		$json_array['return_status'] = 0;
		$json_array['return_message'] = "";
		$json_array['like_status'] = 0;
		
		$post_data = $request->all();
		
		$user_id = $request->user()->id;
		
		$portfolio_id = (int)$post_data['p_id'];
		$action_id = (int)$post_data['type_id'];
		if((int)$user_id > 0)
		{
			if($portfolio_id > 0 && in_array($action_id, array(1, 2, 3, 4)))
			{
				$json_array['post_status'] = 1;
				
				$where['portfolio_id'] = $portfolio_id;
				$where['user_id'] = $user_id;
				$where['action_status'] = $action_id;
				$fetch_details = DB::table($tbl_portfolios_actions);
				$fetch_details = $fetch_details->where($where);
				$fetch_details = $fetch_details->get();
				//debug($fetch_details); exit;
				
				$where2['portfolio_id'] = $portfolio_id;
				$get_count = DB::table($tbl_portfolios)->where($where2)->get();
				//debug($get_count); exit;
				
				$json_array['fetch_data'] = $action_id==2 ? @$get_count[0] : '';
				if(count($fetch_details) == 0)
				{
					$update_array = array();
					
					$insertUsersAction['portfolio_id'] = $portfolio_id;
					$insertUsersAction['user_id'] = $user_id;
					$insertUsersAction['action_status'] = $action_id;
					$insertUsersAction['date_time'] = date('Y-m-d H:i:s');
					
					switch($action_id)
					{
						case 1:
						$update_array['likes'] = isset($get_count[0]->likes) ? $get_count[0]->likes+1 : 1;
						$json_array['like_status'] = 1;
						$json_array['likes_count'] = $update_array['likes'];
						break;
						
						case 2:
						$update_array['number_of_views'] = isset($get_count[0]->number_of_views) ? $get_count[0]->number_of_views+1 : 1;
						$json_array['previews_count'] = $update_array['number_of_views'];
						break;
						
						case 3:
						$update_array['shares'] = isset($get_count[0]->shares) ? $get_count[0]->shares+1 : 1;
						$json_array['shares_count'] = $update_array['shares'];
						break;
						
						case 4:
						$portfolioDetails = UserPortfolio::where(['portfolio_id'=>$portfolio_id])->first();
						$baseUrl = url('/');
						$filePath = substr($portfolioDetails->file_path, (strlen($baseUrl)+1)).'/'.$portfolioDetails->file_name;
						//echo $filePath; exit;
						if(file_exists($filePath)){
							unlink($filePath);
						}
						UserPortfolio::where(['portfolio_id'=>$portfolio_id])->delete();
						break;
						
						default:
						$update_array = array();
						break;
					}
					if(count($update_array) > 0)
					{
						DB::table($tbl_portfolios)->where('portfolio_id', $portfolio_id)->update($update_array);
						DB::table($tbl_portfolios_actions)->insert($insertUsersAction);
					}
				}
			}
			else
			{
				$json_array['post_status'] = 0;
				$json_array['return_message'] = "Wrong values passed to the server!";
			}
		}
		
		
		return response()->json($json_array);
	}

	public function setOnlineOffline(Request $request){
		$json_array['ret_status'] = 0;
		$json_array['ret_message'] = "";
		$authUser = Auth::user()->id;

		$statusChangedTo = isset($request->availability_status) ? $request->availability_status : 'Offline';
		$json_array['statusReturnTo'] = $statusChangedTo=="Available" ? "Offline" : "Available";
		UserDetail::where(['user_id'=>$authUser])->update(['availability_status'=>$statusChangedTo]);
		return response()->json($json_array);
	}

	public function getAQuote(Request $request)
	{
		$post_data = $request->all();
		$authUserName = Auth::user()->first_name.' '.Auth::user()->last_name;

		$explevel_where['status'] = '1';
		$experiencelevel = ExperienceLevel::where($explevel_where)->first();
		//dd($experiencelevel); exit;
		
		$budget_where['status'] = '1';
		$budget = Budget::where($budget_where)->first();
		//dd($budget); exit;

		$jobtype_where['status'] = '1';
		$JobType = JobType::where($jobtype_where)->first();
		//dd($JobType); exit;
		
		$projectLength_where['status'] = '1';
		$projectLength = ProjectLength::where($projectLength_where)->first();
		//dd($projectLength); exit;
		
		$turn_around_time_where['status'] = '1';
		$turn_around_time_where['is_need_payment'] = 'N';
		$turn_around_time = TurnAroundTime::where($turn_around_time_where)->first();
		//dd($turn_around_time); exit;
		
		$all_category = getCategorySubcategory(array('parent_category_id'=>'0', 'status'=>'1'), 0);
		
		$all_subCategory = getCategorySubcategory(array('status'=>'1'), 1);
		//dd($all_subCategory); exit;

		//$posted_skills = $post_data['skills'];
		$posted_assesments = isset($post_data['freelancer_assessment']) ? $post_data['freelancer_assessment'] : array();
		
		$postedjobs = new Postedjobs;
		$postedjobs->posted_by_user = Auth::user()->id;
		$postedjobs->experience_level = isset($post_data['experience_level']) ? $post_data['experience_level']:$experiencelevel->level_id;
		$postedjobs->project_length = isset($post_data['project_length']) ? $post_data['project_length']:$projectLength->id;
		$postedjobs->location = isset($post_data['location']) ? $post_data['location']:"Get a Quote";
		$postedjobs->turn_around_time = isset($post_data['turn_around_time']) ? $post_data['turn_around_time']:$turn_around_time->id;
		$postedjobs->job_type = isset($post_data['job_type']) ? $post_data['job_type'] : $JobType->job_type_id;
		$postedjobs->budget_type = isset($post_data['budget_type']) ? $post_data['budget_type']:$budget->id;
		$postedjobs->budget_amount = isset($post_data['budget_amount']) ? $post_data['budget_amount']:"0.00";
		$postedjobs->needs_to_design_job = isset($post_data['needs_to_design_job']) ? $post_data['needs_to_design_job']:"Get a Quote";
		$postedjobs->category = isset($post_data['category']) ? $post_data['category']:$all_category[0]->category_id;
		$postedjobs->subcategory = isset($post_data['subcategory']) ? $post_data['subcategory']:$all_subCategory[0]->category_id;
		$postedjobs->job_description = isset($post_data['job_description']) ? $post_data['job_description']:"Get a Quote";
		$postedjobs->created_at = date('Y-m-d H:i:s');
		$postedjobs->have_assesment = count($posted_assesments) > 0 ? '1' : '0';
		$postedjobs->job_reference_id = time().mt_rand('11111', '99999');
		$postedjobs->job_status = '5';
		$postedjobs->total_proposal = 1;
		$postedjobs->save();
		$insertedId = $postedjobs->id;
		//debug($insertedId); exit;
		
		/*if((int)$insertedId > 0){
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
		}*/



		$jobProposal = new JobProposal;
		$jobProposal->sent_by_user = $request->quoteForUserId;
		$jobProposal->job_id = $insertedId;
		$jobProposal->description = isset($post_data['proposal_description']) ? $post_data['proposal_description'] : "Get a Quote";
		$jobProposal->interview_question_challanges = isset($post_data['interview_question_challanges']) ? $post_data['interview_question_challanges'] : "Get a Quote";
		$jobProposal->created_at = date('Y-m-d H:i:s');
		$jobProposal->proposal_referance_no = 'JP'.time().mt_rand('111', '999');
		$jobProposal->save();
		
		$UserNotification = new UserNotification;
		$UserNotification->user_id = $request->quoteForUserId;
		$UserNotification->sent_by_user = Auth::user()->id;
		$UserNotification->title = '';
		$notificationMsg = config("constants.GET_A_QUOTE_NOTIFICATION_MSG");
		$UserNotification->short_description = substr(str_replace('{{NAME}}', $authUserName, $notificationMsg), 0, 255);
		$UserNotification->full_description = str_replace('{{NAME}}', $authUserName, $notificationMsg);
		$UserNotification->notification_link = '/jobs/view-project/'.$insertedId;
		$UserNotification->viewed_status = 'N';
		$UserNotification->created_at = date('Y-m-d H:i:s');
		$UserNotification->save();

		//return redirect('/freelancers/freelancer-details/avoy-debnath/'.$request->quoteForUserId)->with('success', 'Successfully invited');
		return redirect()->back()->with('success', 'Successfully invited');
	}

	public function increseYourViews(){
		$data = [];
		return view('user.increse_your_views', $data);
	}
}


