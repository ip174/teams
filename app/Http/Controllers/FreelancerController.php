<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use App\UserDetail;
use App\UserSkills;
use App\UserPortfolio;
use App\UsersProfileView;
use App\JobRating;
use App\Postedjobs;
use App\JobProposal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerController extends Controller
{
	private $resource = 'freelancers';
	
	/***
    * Create a new controller instance.
    *
    * @return void
    ***/
	public function __construct()
    {
        $this->middleware('auth', ['except' => [

        ]]);
    }
	
	
    /**
    * Display a listing of the freelancers.
    **/
    public function find_freelancers(Request $request)
    {
		if(checkPrivilege(2))
		{
			return redirect('/user/dashboard');
		}
		
        $data = [];
		
		$resource = $this->resource;
		$activeMenuHeader = 'Freelancer';
        $per_page = config('constants.FREELANCER_PER_PAGE');
		
		$searchData = $request->all('formData');
		//debug($searchData);
		//exit;
		
		$users_details = DB::table('users')
			->select('users.*', 'user_details.*', 'job_type.job_title', 'focus_type.focus_type', 'field_of_work_type.type_title');
			$users_details = $users_details->leftJoin('user_details', 'users.id', '=', 'user_details.user_id');
			$users_details = $users_details->leftJoin('job_type', 'user_details.job_type', '=', 'job_type.job_type_id');
			$users_details = $users_details->leftJoin('focus_type', 'user_details.focus', '=', 'focus_type.focus_type_id');
			$users_details = $users_details->leftJoin('field_of_work_type', 'user_details.field_of_work', '=', 'field_of_work_type.type_id');
			
			$users_details = $users_details->where('users.is_active', 'Y');
			//$users_details = $users_details->where('users.type', 1); // for Freelancers
			$users_details = $users_details->where('users.id', '!=', Auth::user()->id); // for Freelancers
			if((int)@$searchData['categories'] > 0)
			{
				$users_details = $users_details->where('user_details.field_of_work', $searchData['categories']);
			}
			if((int)@$searchData['job_type'] > 0)
			{
				$users_details = $users_details->where('user_details.job_type', $searchData['job_type']);
			}
			if((int)@$searchData['rate_per_hour'] > 0)
			{
				$users_details = $users_details->where('user_details.rate_per_hour', '<=', $searchData['rate_per_hour']);
			}
			if((int)@$searchData['travel_distance'] > 0)
			{
				$users_details = $users_details->where('user_details.travel_distance', $searchData['travel_distance']);
			}
			if(@$searchData['location'])
			{
				$users_details = $users_details->where('user_details.location', 'like', '%'.$searchData['location'].'%');
			}
			if(@$searchData['search_text'])
			{
				// $users_details = $users_details->where('users.first_name', 'like', '%'.$searchData['search_text'].'%')
				//  					->orWhere('users.last_name', 'like', '%'.$searchData['search_text'].'%')
				//  					->orWhere('users.email', 'like', '%'.$searchData['search_text'].'%');
				$users_details = $users_details->where(function($query) use($searchData){
									$query->where('users.first_name', 'like', '%'.$searchData['search_text'].'%')
				 					->orWhere('users.last_name', 'like', '%'.$searchData['search_text'].'%')
				 					->orWhere('users.email', 'like', '%'.$searchData['search_text'].'%');
								});
				// $users_details = $users_details->where(DB::raw('(users.first_name like %'.$searchData['search_text'].'% OR users.last_name like %'.$searchData['search_text'].'% OR users.email like %'.$searchData['search_text'].'%)'));
									//->orWhere('users.last_name', 'like', '%'.$searchData['search_text'].'%')
									//->orWhere('users.email', 'like', '%'.$searchData['search_text'].'%');
			}
			
			
			$users_details = $users_details->orderBy('users.id', 'desc');
			$users_details = $users_details->paginate($per_page);
			//$users_details = $users_details->paginate($per_page);
		//dd($users_details); exit;
		
		//$users_list['users_details'] = $users_details;
		//$returnHTML = view($resource.'.freelancers_dataLists', $users_list)->render();
		//debug($returnHTML); exit;
		
		$countString = ((($users_details->perPage() * $users_details->currentPage())-$users_details->perPage()) +1);
		$countString .= ' to ';
		if($users_details->currentPage() < $users_details->lastPage())
		{
			$countString .= ($users_details->perPage() * $users_details->currentPage());
		}
		else
		{
			$countString .= $users_details->total();
		}
		$countString .= ' of ';
		$countString .= $users_details->total();
		if($request->ajax())
		{
			//$countString .= ' found';
            $html = view($resource.'.freelancers_dataLists', compact(
				'users_details',
				'searchData'
			))->render();
			$json_array['html'] = $html;
			$json_array['countString'] = $countString;
			return response()->json($json_array);
        }
		
		//====================Get all active focus from database====================//
		$all_focus = get_focus('', array('status'=>'1'), "*");
		
		//====================Get all active field of work from database====================//
		$all_workField = get_workField('', array('status'=>'1'), "*");
		
		//====================Get all active job types from database====================//
		$all_jobType = get_jobType('', array('status'=>'1'), "*");
		
		//====================Get all active skills from database====================//
		$all_skills = get_skills('', array('status'=>'1'), "*");
		
		//====================Get all active skills from database====================//
		$all_travelType = get_travelType('', array('status'=>'1'), "*");
		
		return view($resource.'.search_freelancers', compact(
			'data',
			'all_focus',
			'all_workField',
			'all_jobType',
			'all_skills',
			'all_travelType',
			'users_details',
			'countString',
			'activeMenuHeader'
		));
    }
	
	public function request_freelancer(Request $request)
	{
		$json_array['error'] = '0';
		$json_array['found_data'] = '0';
		$json_array['msg'] = 'Successfully Uploaded';
		
		$post_data = $request->all();
		$json_array['data'] = $post_data;
		
		return response()->json($json_array);
	}
	
	public function freelancerDetails(Request $request, $name='', $id='')
	{
		if(checkPrivilege(2))
		{
			return redirect('/user/dashboard');
		}
		
		/*echo $name;
		echo $id;
		exit;*/
		$data = [];
		$data['activeMenuHeader'] = 'Freelancer';
		$data['viewAnotherProfile'] = 1;
		$per_page = config('constants.PORTFOLIO_PER_PAGE');
		$data['getQuote'] = app('request')->input('q');
		
		$user = User::where(['id'=>$id])->first();
		$fetch_name = isset($user->first_name) ? $user->first_name : '';
		$fetch_name .= isset($user->last_name) ? ' '.$user->last_name : '';
		$fetch_name = str_replace(' ', '-', strtolower(trim($fetch_name)));
		if($fetch_name != $name)
		{
			return redirect('/user/dashboard');
		}
		
		$data['id'] = $id;
		$data['user'] = $user;
		$data['user_id'] = $user->user_id;
		//debug($user); exit;
		
		$userDetails = UserDetail::where(['user_id'=>$id])->first();
		$data['userDetails'] = $userDetails;
		//debug($userDetails); exit;
		
		$userSkills = UserSkills::where(['user_id'=>$id])
		->get();
		$data['userSkills'] = $userSkills;
		$userSkillArray = array();
		if(count($userSkills) > 0)
		{
			foreach($userSkills as $eachSkill)
			{
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

		if((int)$id > 0 && Auth::user()->id!=$id)
		{
			$usersProfileView = new UsersProfileView;
			$usersProfileView->view_to_user = $id;
			$usersProfileView->view_by_user = Auth::user()->id;
			$usersProfileView->weekdays = date('w');
			$usersProfileView->created_at = date('Y-m-d H:i:s');
			$usersProfileView->save();
		}

		$reviewPostedJobsId = JobRating::select('job_id')->where(['review_for_user'=>$id])->orWhere('review_by_user', $id)->groupBy('job_id')->get();
		//dd($reviewPostedJobsId);
		$reviewPostedJobsDetails = $reviewPostedJobsProposals = array();
		if(count($reviewPostedJobsId))
		{
			$reviewPostedJobsDetails = Postedjobs::select('*')->whereIn('job_id', $reviewPostedJobsId)->get();
			$reviewPostedJobsProposals = JobProposal::select('*')->whereIn('job_id', $reviewPostedJobsId)->where('is_accepted', 'Y')->get();
		}
		//dd($reviewPostedJobsProposals);
		$data['reviewPostedJobsDetails'] = $reviewPostedJobsDetails;
		$data['reviewPostedJobsProposals'] = $reviewPostedJobsProposals;
		
        return view('user.my_profile', $data);
	}
}




