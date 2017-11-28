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
use Image;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use Stripe;
use StripeCharge;
use StripeCustomer;

class WorkflowController extends Controller
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
	
	public function viewWorkflow($job_id=0, Request $request)
	{
		if( !isset($job_id) || (int)$job_id < 1 ){
			return redirect('/user/dashboard')->with('error', 'Something mismatched!');
		}
		if(checkPrivilege(2)){
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$activeMenu = 'Workflow'; //Which menu will active in tabber
		$activeMenuHeader = 'Jobs';
		$assignedTo = array();
		$assignedBy = array();
		$assignedToUser = $assignedByUser = '';
		
		$where['job_id'] = $job_id;
		$jobDetails = Postedjobs::where($where)->first();
		$checkValidFreelance = JobProposal::where([
				'job_id'=>$job_id,
				'is_accepted'=>'Y'
			])->first();

		//print_r($jobDetails);
		//print_r($checkValidFreelance);exit;
		if($jobDetails->posted_by_user != $authUser && !isset($checkValidFreelance->sent_by_user)){
			$status = false;
		}
		if($jobDetails->posted_by_user != $authUser && (isset($checkValidFreelance->sent_by_user) && $checkValidFreelance->sent_by_user != $authUser)){
			return redirect('/jobs/preview-job/'.$job_id);

		}

		if(isset($jobDetails->posted_by_user) && $jobDetails->posted_by_user==$authUser){
			$assignedByUser = $authUser;
			$assignedToUser = isset($checkValidFreelance->sent_by_user) ? $checkValidFreelance->sent_by_user : '';
		}elseif(isset($checkValidFreelance->sent_by_user) && $checkValidFreelance->sent_by_user==$authUser){
			$assignedByUser = isset($checkValidFreelance->sent_by_user) ? $checkValidFreelance->sent_by_user : '';
			$assignedToUser = isset($jobDetails->posted_by_user) ? $jobDetails->posted_by_user : '';
		}
		$assignedBy = User::where(['id'=>$assignedByUser])->first();
		$assignedTo = User::where(['id'=>$assignedToUser])->first();

		$hold_task = DB::select("SELECT * FROM ".config('constants.TBL_TASK_ASSIGNED_MEMBERS')." WHERE (job_id = '".$job_id."' AND is_completed = 'N' AND type = '2') AND (assigned_by_user = '".$authUser."' OR assigned_to_member = '".$authUser."')");

		$new_task = DB::select("SELECT * FROM ".config('constants.TBL_TASK_ASSIGNED_MEMBERS')." WHERE (job_id = '".$job_id."' AND is_completed = 'N' AND type = '1') AND (assigned_by_user = '".$authUser."' OR assigned_to_member = '".$authUser."')");

		$review_task = DB::select("SELECT * FROM ".config('constants.TBL_TASK_ASSIGNED_MEMBERS')." WHERE (job_id = '".$job_id."' AND is_completed = 'N' AND type = '3') AND (assigned_by_user = '".$authUser."' OR assigned_to_member = '".$authUser."')");
		//print_r($review_task); exit;

		$complete_task = DB::select("SELECT * FROM ".config('constants.TBL_TASK_ASSIGNED_MEMBERS')." WHERE (job_id = '".$job_id."' AND is_completed = 'Y' AND type = '4') AND (assigned_by_user = '".$authUser."' OR assigned_to_member = '".$authUser."')");
		

		return view('workflow/workflow_main', compact(
			'authUser',
			'activeMenu',
			'job_id',
			'jobDetails',
			'assignedTo',
			'assignedBy',
			'new_task',
			'hold_task',
			'review_task',
			'complete_task',
			'activeMenuHeader'
		));
	}

	public function assignTaskToUser(Request $request){
		$input_datas = $request->all();
		//print_r($input_datas); exit;

		$loggedUser = Auth::user()->id;

		$user_job_task = new UserJobTask;
		$user_job_task->job_id = $request->job_id;
		$user_job_task->assigned_by_user = $loggedUser;
		$user_job_task->title = $request->title;
		$user_job_task->type = $request->type;
		$user_job_task->description = $request->description;
		$user_job_task->created_date = date('Y-m-d H:i:s');
		$user_job_task->save();
		$last_task_id = $user_job_task->id;

		
		$task_assigned_member = new TaskAssignedMember;
		$task_assigned_member->task_id = $last_task_id;
		$task_assigned_member->job_id = $request->job_id;
		$task_assigned_member->type = $request->type;
		$task_assigned_member->assigned_by_user = $loggedUser;
		$task_assigned_member->assigned_to_member = $request->assigned_to_user;
		$task_assigned_member->is_completed = $request->type==4 ? 'Y' : 'N';
		$task_assigned_member->due_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->due_date)));
		$task_assigned_member->assigned_date = date('Y-m-d H:i:s');
		$task_assigned_member->priority = $request->priority;
		$task_assigned_member->save();

		
		if(!empty(trim($_FILES['attachments']['name']))){
			$fileName = mt_rand('111111', '999999').time().basename($_FILES["attachments"]["name"]);
	    	$target_dir = public_path().'/assets/upload/job_tasks/';
	    	$target_file = $target_dir . $fileName;
			if(move_uploaded_file($_FILES["attachments"]["tmp_name"], $target_file)){
				$task_attachment = new TaskAttachment;
				$task_attachment->task_id = $last_task_id;
				$task_attachment->job_id = $request->job_id;
				$task_attachment->file_name = $fileName;
				$task_attachment->save();
			}
		}

		return redirect()->back()->with('message', 'Successfully assigned!');
	}

	public function viewTask($job_id=0, $task_id=0)
	{
		if( (int)$job_id < 1 || (int)$task_id < 1 ){
			return redirect('/user/dashboard')->with('error', 'Something mismatched!');
		}
		if(checkPrivilege(2)){
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$activeMenu = 'Workflow'; //Which menu will active in tabber
		$activeMenuHeader = 'Jobs';
		
		$where['job_id'] = $job_id;
		$jobDetails = Postedjobs::where($where)->first();
		$checkValidFreelance = JobProposal::where([
				'job_id'=>$job_id,
				'is_accepted'=>'Y'
			])->first();

		if($jobDetails->posted_by_user != $authUser && !isset($checkValidFreelance->sent_by_user)){
			$status = false;
		}
		if($jobDetails->posted_by_user != $authUser && (isset($checkValidFreelance->sent_by_user) && $checkValidFreelance->sent_by_user != $authUser)){
			return redirect('/jobs/preview-job/'.$job_id);

		}

		$taskDetails = UserJobTask::find($task_id);
		$taskAssignedMembers = TaskAssignedMember::where(['task_id'=>$task_id])->first();
		$taskAttachments = TaskAttachment::where(['task_id'=>$task_id])->get();
		

		return view('workflow/view_task', compact(
			'authUser',
			'activeMenu',
			'job_id',
			'jobDetails',
			'taskDetails',
			'taskAssignedMembers',
			'taskAttachments',
			'activeMenuHeader'
		));
	}

	public function editTask($job_id=0, $task_id=0)
	{
		if( (int)$job_id < 1 || (int)$task_id < 1 ){
			return redirect('/user/dashboard')->with('error', 'Something mismatched!');
		}
		if(checkPrivilege(2)){
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$activeMenu = 'Workflow'; //Which menu will active in tabber
		$activeMenuHeader = 'Jobs';
		$assignedTo = array();
		$assignedBy = array();
		$assignedToUser = $assignedByUser = '';
		
		$where['job_id'] = $job_id;
		$jobDetails = Postedjobs::where($where)->first();
		$checkValidFreelance = JobProposal::where([
				'job_id'=>$job_id,
				'is_accepted'=>'Y'
			])->first();

		if($jobDetails->posted_by_user != $authUser && !isset($checkValidFreelance->sent_by_user)){
			$status = false;
		}
		if($jobDetails->posted_by_user != $authUser && (isset($checkValidFreelance->sent_by_user) && $checkValidFreelance->sent_by_user != $authUser)){
			return redirect('/jobs/preview-job/'.$job_id);

		}

		if(isset($jobDetails->posted_by_user) && $jobDetails->posted_by_user==$authUser){
			$assignedByUser = $authUser;
			$assignedToUser = isset($checkValidFreelance->sent_by_user) ? $checkValidFreelance->sent_by_user : '';
		}elseif(isset($checkValidFreelance->sent_by_user) && $checkValidFreelance->sent_by_user==$authUser){
			$assignedByUser = isset($checkValidFreelance->sent_by_user) ? $checkValidFreelance->sent_by_user : '';
			$assignedToUser = isset($jobDetails->posted_by_user) ? $jobDetails->posted_by_user : '';
		}
		$assignedBy = User::where(['id'=>$assignedByUser])->first();
		$assignedTo = User::where(['id'=>$assignedToUser])->first();

		$taskDetails = UserJobTask::find($task_id);
		$taskAssignedMembers = TaskAssignedMember::where(['task_id'=>$task_id])->first();
		$taskAttachments = TaskAttachment::where(['task_id'=>$task_id])->get();
		//print_r($taskDetails); exit;
		

		return view('workflow/edit_workflow', compact(
			'authUser',
			'activeMenu',
			'job_id',
			'jobDetails',
			'assignedTo',
			'assignedBy',
			'taskDetails',
			'taskAssignedMembers',
			'taskAttachments',
			'task_id',
			'activeMenuHeader'
		));
	}

	public function updateTaskToUser(Request $request){
		$input_datas = $request->all();
		//print_r($input_datas); exit;
		$task_id = $request->task_id;

		$loggedUser = Auth::user()->id;

		//$user_job_task = new UserJobTask;
		//$user_job_task['job_id'] = $request->job_id;
		$user_job_task['assigned_by_user'] = $loggedUser;
		$user_job_task['title'] = $request->title;
		$user_job_task['type'] = $request->type;
		$user_job_task['description'] = $request->description;
		//$user_job_task['created_date'] = date('Y-m-d H:i:s');
		//$user_job_task->save();
		//$last_task_id = $user_job_task->id;
		UserJobTask::where(['id'=>$task_id])->update($user_job_task);

		
		//$task_assigned_member = new TaskAssignedMember;
		//$task_assigned_member['task_id'] = $last_task_id;
		//$task_assigned_member['job_id'] = $request->job_id;
		$task_assigned_member['type'] = $request->type;
		$task_assigned_member['assigned_by_user'] = $loggedUser;
		$task_assigned_member['assigned_to_member'] = $request->assigned_to_user;
		$task_assigned_member['is_completed'] = $request->type==4 ? 'Y' : 'N';
		$task_assigned_member['due_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $request->due_date)));
		$task_assigned_member['assigned_date'] = date('Y-m-d H:i:s');
		$task_assigned_member['priority'] = $request->priority;
		//$task_assigned_member->save();
		TaskAssignedMember::where(['task_id'=>$task_id])->update($task_assigned_member);

		
		if(!empty(trim($_FILES['attachments']['name']))){
			$fileName = mt_rand('111111', '999999').time().basename($_FILES["attachments"]["name"]);
	    	$target_dir = public_path().'/assets/upload/job_tasks/';
	    	$target_file = $target_dir . $fileName;
			if(move_uploaded_file($_FILES["attachments"]["tmp_name"], $target_file)){
				$task_attachment = new TaskAttachment;
				$task_attachment['task_id'] = $task_id;
				$task_attachment['job_id'] = $request->job_id;
				$task_attachment['file_name'] = $fileName;
				$task_attachment->save();
			}
		}

		return redirect()->back()->with('message', 'Successfully assigned!');
	}

	public function deleteAttachment(Request $request){
		$input_data = $request->all();
		$json_array['status'] = 0;

		if($request->isAjax){
			$attachment_id = $request->attachment_id;

			$fileDetails = TaskAttachment::find($attachment_id);
			$target_dir = '/assets/upload/job_tasks/';
	    	$target_file = $target_dir . $fileDetails->file_name;
			unlink($target_file);
			TaskAttachment::where(['id'=>$attachment_id])->delete();
			$json_array['status'] = 1;
			return response()->json($json_array);
		}
	}
}
