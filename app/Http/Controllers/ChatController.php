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
use Image;
use App\UserNotification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use Stripe;
use StripeCharge;
use StripeCustomer;

class ChatController extends Controller
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
	
	public function JobChatBox($job_id=0, $fetch_type="", Request $request)
	{
		if( !isset($job_id) || (int)$job_id < 1 )
		{
			return redirect('/user/dashboard')->with('error', 'Something mismatched!');
		}
		if(checkPrivilege(2))
		{
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$activeMenuHeader = 'Jobs';
		$data = [];
		$successMsg = '';
		$activeMenu = 'Messages'; //Which menu will active in tabber
		$latest_chats = array();
		$all_proposals = array();
		$jobProviderDetails = '';
		$isJobProviderLoggedIn = false;
		$to_user_id = ''; //Defalt user, to whom message will be send
		$is_ajax = '';
		$emailForUsers = array();
		$chatUsersList = array();
		$fromUserDetails = array();
		$toUserDetails = array();

		//Defalt all messages are marking as read.
		UserChat::where(['to_user_id'=>$authUser])->update(['message_read_status'=>'Y']);
		
		$where['job_id'] = $job_id;
		$jobDetails = Postedjobs::where($where)->first();
		//dd($jobDetails); exit;

		$last_chat = UserChat::where($where)->orderBy('id', 'DESC')->first();
		//dd($last_chat); exit;
		
		if($jobDetails->posted_by_user != $authUser)
		{
			$emailForUsers = array($jobDetails->posted_by_user);
			//For Freelancer
			$to_user_id = $jobDetails->posted_by_user;
			$latest_chats = DB::select("SELECT * FROM ".config('constants.TBL_USER_CHATS')." WHERE job_id = '".$job_id."' AND (user_id = '".$authUser."' OR to_user_id='".$authUser."') ORDER BY id DESC");

			$jobProviderDetails = User::where(['id'=>$jobDetails->posted_by_user])->first();
		}
		else
		{
			//for JOB PROVIDER
			$isJobProviderLoggedIn = true;
			$all_proposals = JobProposal::where($where)->orderBy('proposal_id', 'DESC')->get();

			if(count($all_proposals) > 0)
			{
				foreach($all_proposals as $eachProposal)
				{
					$emailForUsers[] = $eachProposal->sent_by_user;
				}
				//print_r($emailForUsers); exit;
			}
			$chatUsersList = $all_proposals;

			if(count($last_chat) > 0)
			{
				//foreach($all_chats as $eachChat)
				//{
					if($last_chat->user_id == $authUser || $last_chat->to_user_id == $authUser){
						if($last_chat->user_id == $authUser)
						{
							$to_user_id = $last_chat->to_user_id;
							$toUser = $last_chat->to_user_id;
						}
						else
						{
							$to_user_id = $last_chat->user_id;
							$toUser = $last_chat->user_id;
						}
						
						$latest_chats = DB::select("SELECT * FROM ".config('constants.TBL_USER_CHATS')." WHERE job_id = '".$job_id."' AND ((user_id = '".$authUser."' AND to_user_id='".$toUser."') OR (user_id = '".$toUser."' AND to_user_id='".$authUser."')) ORDER BY id DESC");
					}
				//}
			}
		}
		if(count($latest_chats) > 0)
		{
			$from_user_id = $authUser;
			$to_user_id = $latest_chats[0]->user_id == $authUser ? $latest_chats[0]->to_user_id : $latest_chats[0]->user_id;
			$fromUserDetails = getUserById($from_user_id);
			$toUserDetails = getUserById($to_user_id);
		}
		//dd($latest_chats); exit;
		

		return view('chat/job_chat_box', compact(
			'data',
			'successMsg',
			'jobDetails',
			'latest_chats',
			'all_proposals',
			'job_id',
			'jobProviderDetails',
			'isJobProviderLoggedIn',
			'authUser',
			'activeMenu',
			'to_user_id',
			'is_ajax',
			'emailForUsers',
			'fetch_type',
			'chatUsersList',
			'fromUserDetails',
			'toUserDetails',
			'activeMenuHeader'
		));
	}

	public function getChatMessages(Request $request)
	{
		$inputData = $request->all();
		$job_id = $inputData['job_id'];
		$to_user_id = $inputData['to_user_id'];
		$is_ajax = $inputData['is_ajax'];
		$authUser = Auth::user()->id;

		if( (int)$job_id < 1 || (int)$to_user_id < 1 )
		{
			return redirect('/user/dashboard')->with('error', 'Unauthorised access!');
		}
		//echo $job_id; exit;

		if($is_ajax)
		{
			$where['job_id'] = $job_id;
			//$jobDetails = Postedjobs::where($where)->first();
			//dd($jobDetails); exit;

			$all_chats = DB::select("SELECT * FROM ".config('constants.TBL_USER_CHATS')." WHERE job_id = '".$job_id."' AND ((user_id = '".$authUser."' AND to_user_id='".$to_user_id."') OR (user_id = '".$to_user_id."' AND to_user_id='".$authUser."')) ORDER BY id DESC");
			//print_r($all_chats); exit;

			if(count($all_chats) > 0)
			{
				$from_user_id = $authUser;
				$fromUserDetails = getUserById($from_user_id);
				$toUserDetails = getUserById($to_user_id);
			}

			$html = view('chat.chat_content', compact(
					'all_chats',
					'job_id',
					'to_user_id',
					'is_ajax',
					'authUser',
					'fromUserDetails',
					'toUserDetails'
				))->render();
			$json_array['html'] = $html;
			return response()->json($json_array);
		}
	}

	public function sendChatMessages(Request $request)
	{
		$inputData = $request->all();

		if( (int)$request->job_id < 1 &&  Auth::user()->id < 1 && (int)$request->to_user_id < 1 )
		{
			return redirect('/user/dashboard')->with('error', 'Unauthorised access!');
		}

		if(!empty($request->message))
		{
			$insert_message = new UserChat;
			$insert_message->job_id = $request->job_id;
			$insert_message->user_id = Auth::user()->id;
		    $insert_message->to_user_id = $request->to_user_id;
		    $ismore = strlen($request->message) > 40 ? '...' : '';
		    $insert_message->message_subject = substr($request->message, 0, 40) . $ismore;
		    $insert_message->message_content = $request->message;
		    $insert_message->message_dttime = date('Y-m-d H:i:s');
		    $insert_message->save();
		    //return redirect('/chat/job-chat-box/'.$request->job_id)->with('message', 'Successfully sent!');
		    return redirect()->back()->with('message', 'Successfully sent!');
		}
		else
		{
			//return redirect('/chat/job-chat-box/'.$request->job_id)->with('error_message', 'Please enter message content!');
			return redirect()->back()->with('error_message', 'Please enter message content!');
		}
	}
	
	public function sendChatEmail(Request $request)
	{
		$inputData = $request->all();

		if( (int)$request->job_id < 1 &&  Auth::user()->id < 1 )
		{
			return redirect('/user/dashboard')->with('error', 'Unauthorised access!');
		}

		if(!empty($request->message) && count($request->email_to) > 0)
		{
			//print_r($request->email_to); exit;
			$toUsers = $request->email_to;
			$allToUsers = explode(",", $request->toEmails);
			for($loopi=0; $loopi<sizeof($request->email_to); $loopi++)
			{
				if(in_array($toUsers[$loopi], $allToUsers))
				{
					$insert_message = new UserChat;
					$insert_message->job_id = $request->job_id;
					$insert_message->user_id = Auth::user()->id;
				    $insert_message->to_user_id = $toUsers[$loopi];
				    $ismore = strlen($request->message) > 40 ? '...' : '';
				    $insert_message->message_subject = substr($request->message, 0, 40) . $ismore;
				    $insert_message->message_content = $request->message;
				    $insert_message->message_dttime = date('Y-m-d H:i:s');
				    $insert_message->save();
				    $lastInsertedId = $insert_message->id;

				    if($request->attachedFile)
				    {
				    	$fileName = basename($_FILES["attachedFile"]["name"]).time();
				    	if($loopi < 1)
				    	{
					    	$target_dir = public_path().'/assets/upload/chat_files/';
					    	$target_file = $target_dir . $fileName;
							move_uploaded_file($_FILES["attachedFile"]["tmp_name"], $target_file);
						}

				    	$insertFile = new UserChatFile;
					    $insertFile->message_id = $lastInsertedId;
					    $insertFile->file_name = $fileName;
					    $insertFile->save();
				    }
				}
			}
		    //return redirect('/chat/job-chat-box/'.$request->job_id)->with('message', 'Successfully sent!');
		    return redirect()->back()->with('message', 'Successfully sent!');
		}
		else
		{
			//print_r($request->email_to);
			//echo '1'; exit;
			//return redirect('/chat/job-chat-box/'.$request->job_id)->with('error_message', 'Please enter message content!');
			return redirect()->back()->with('error_message', 'Please enter message content!');
		}
	}

	public function setAsStarredMessages(Request $request)
	{
		$msgId = $request->msgId;
		$json_array['success'] = 0;

		$getExistance = UserChat::find($msgId);
		//print_r($getExistance); exit;

		$loggedUser = Auth::user()->id;
		if($getExistance->user_id == $loggedUser && $getExistance->is_starred_for_sender == 0)
		{
			$updateArray['is_starred_for_sender'] = 1;
			$json_array['success_msg'] = "Set as starred message";
		}
		elseif($getExistance->user_id == $loggedUser && $getExistance->is_starred_for_sender == 1)
		{
			$updateArray['is_starred_for_sender'] = 0;
			$json_array['success_msg'] = "Removed from starred message";
		}
		elseif($getExistance->to_user_id == $loggedUser && $getExistance->is_starred_for_receiver == 0)
		{
			$updateArray['is_starred_for_receiver'] = 1;
			$json_array['success_msg'] = "Set as starred message";
		}
		elseif($getExistance->to_user_id == $loggedUser && $getExistance->is_starred_for_receiver == 1)
		{
			$updateArray['is_starred_for_receiver'] = 0;
			$json_array['success_msg'] = "Removed from starred message";
		}

		UserChat::where(['id'=>$msgId])->update($updateArray);

		return response()->json($json_array);
	}

	public function chatDeleteMessages(Request $request)
	{
		$msgId = $request->msgId;
		$json_array['success'] = 0;

		$getExistance = UserChat::find($msgId);
		//print_r($getExistance); exit;

		$loggedUser = Auth::user()->id;
		if($getExistance->user_id == $loggedUser)
		{
			$updateArray['deleted_by_sender'] = 1;
		}
		else
		{
			$updateArray['deleted_by_receiver'] = 1;
		}

		UserChat::where(['id'=>$msgId])->update($updateArray);
		//UserChatFile::where(['message_id'=>$msgId])->delete();

		return response()->json($json_array);
	}

	public function getMessageNotification(Request $request)
	{
		$is_ajax = $request->isAjax;
		$loggedUser = Auth::user()->id;
		$html = '';

		$unreadMessage = UserChat::where(['to_user_id'=>$loggedUser, 'message_read_status'=>'N'])->get();
		$count = count($unreadMessage);
		if($count)
		{
			$html = '<sup class="notification_count">'.$count.'</sup>';
		}
		$json_array['html'] = $html;

		return response()->json($json_array);
	}


	public function JobChatMailbox($job_id=0, $fetch_type="", Request $request)
	{
		if( !isset($job_id) || (int)$job_id < 1 )
		{
			return redirect('/user/dashboard')->with('error', 'Something mismatched!');
		}
		if(checkPrivilege(2))
		{
			return redirect('/user/dashboard')->with('error', 'Sorry! You don\'t have permission to access this page.');
		}
		//echo $job_id; exit;
		
		$authUser = Auth::user()->id;
		$data = [];
		$successMsg = '';
		$activeMenu = 'Messages'; //Which menu will active in tabber
		$latest_chats = array();
		$all_proposals = array();
		$jobProviderDetails = '';
		$isJobProviderLoggedIn = false;
		$to_user_id = ''; //Defalt user, to whom message will be send
		$is_ajax = '';
		$emailForUsers = $chatUsersList = $fromUserDetails = $toUserDetails = array();
		
		$where['job_id'] = $job_id;
		$jobDetails = Postedjobs::where($where)->first();

		switch ($fetch_type)
		{
			case 'inbox':
				$last_chat = UserChat::where(['job_id'=>$job_id, 'to_user_id'=>$authUser])->orderBy('id', 'DESC')->get();
				break;

			case 'starred':
				$last_chat = UserChat::where(['job_id'=>$job_id, 'to_user_id'=>$authUser, 'to_user_id'=>$authUser])->orderBy('id', 'DESC')->get();
				$last_chat = DB::select("SELECT * FROM ".config('constants.TBL_USER_CHATS')." WHERE job_id = '".$job_id."' AND ((user_id='".$authUser."' AND is_starred_for_sender='1') OR (to_user_id='".$authUser."' AND is_starred_for_receiver='1')) ORDER BY id DESC");

			case 'sent':
				$last_chat = UserChat::where(['job_id'=>$job_id, 'to_user_id'=>$authUser])->orderBy('id', 'DESC')->get();
				break;

			case 'archived':
				break;
			
			default:
				break;
		}
		//dd($last_chat); exit();
		
		if($jobDetails->posted_by_user != $authUser)
		{
			//For Freelancer
			$emailForUsers = array($jobDetails->posted_by_user);
			$to_user_id = $jobDetails->posted_by_user;
			
			switch ($fetch_type)
			{
				case 'inbox':
					$latest_chats = DB::select("SELECT * FROM ".config('constants.TBL_USER_CHATS')." WHERE job_id = '".$job_id."' AND to_user_id='".$authUser."' ORDER BY id DESC");
					break;

				case 'starred':
					$latest_chats = DB::select("SELECT * FROM ".config('constants.TBL_USER_CHATS')." WHERE job_id = '".$job_id."' AND ((user_id = '".$authUser."' AND is_starred_for_sender='1') OR (to_user_id='".$authUser."' AND is_starred_for_receiver='1')) ORDER BY id DESC");

				case 'sent':
					$latest_chats = DB::select("SELECT * FROM ".config('constants.TBL_USER_CHATS')." WHERE job_id = '".$job_id."' AND user_id='".$authUser."' ORDER BY id DESC");
					break;

				case 'archived':
					break;
				
				default:
					break;
			}

			$jobProviderDetails = User::where(['id'=>$jobDetails->posted_by_user])->first();
		}
		else
		{
			//for JOB PROVIDER
			$isJobProviderLoggedIn = true;
			$all_proposals = JobProposal::where($where)->orderBy('proposal_id', 'DESC')->get();

			if(count($all_proposals) > 0)
			{
				foreach($all_proposals as $eachProposal){
					$emailForUsers[] = $eachProposal->sent_by_user;
				}
			}

			switch ($fetch_type)
			{
				case 'inbox':
					$chatList = DB::select("SELECT u.id, u.first_name, u.last_name, u.profile_picture, j.job_title FROM ".config('constants.TBL_USERS')." u LEFT JOIN ".config('constants.TBL_USERS_DETAILS')." ud ON u.id=ud.user_id LEFT JOIN ".config('constants.TBL_JOB_TYPE')." j ON ud.job_type=j.job_type_id WHERE u.id IN(SELECT DISTINCT(user_id) FROM ".config('constants.TBL_USER_CHATS')." WHERE to_user_id='".$authUser."' AND job_id='".$job_id."')");
					break;

				case 'starred':
					$chatList = DB::select("SELECT u.id, u.first_name, u.last_name, u.profile_picture, j.job_title FROM ".config('constants.TBL_USERS')." u LEFT JOIN ".config('constants.TBL_USERS_DETAILS')." ud ON u.id=ud.user_id LEFT JOIN ".config('constants.TBL_JOB_TYPE')." j ON ud.job_type=j.job_type_id WHERE u.id IN(SELECT DISTINCT(id) FROM users WHERE (id IN(SELECT DISTINCT(to_user_id) FROM ".config('constants.TBL_USER_CHATS')." c WHERE c.job_id='".$job_id."' AND c.user_id='".$authUser."' AND is_starred_for_sender='1')) OR (id IN(SELECT DISTINCT(user_id) FROM ".config('constants.TBL_USER_CHATS')." c WHERE c.job_id='".$job_id."' AND c.to_user_id='".$authUser."' AND is_starred_for_receiver='1')))");
					break;

				case 'sent':
					$chatList = DB::select("SELECT u.id, u.first_name, u.last_name, u.profile_picture, j.job_title FROM ".config('constants.TBL_USERS')." u LEFT JOIN ".config('constants.TBL_USERS_DETAILS')." ud ON u.id=ud.user_id LEFT JOIN ".config('constants.TBL_JOB_TYPE')." j ON ud.job_type=j.job_type_id WHERE u.id IN(SELECT DISTINCT(to_user_id) FROM ".config('constants.TBL_USER_CHATS')." WHERE user_id='".$authUser."' AND job_id='".$job_id."')");
					break;

				case 'archived':
					break;
				
				default:
					break;
			}
			$chatUsersList = $chatList;

			if(count($last_chat) > 0)
			{
				if($last_chat[0]->user_id == $authUser || $last_chat[0]->to_user_id == $authUser)
				{
					if($last_chat[0]->user_id == $authUser)
					{
						$to_user_id = $last_chat[0]->to_user_id;
						$toUser = $last_chat[0]->to_user_id;
					}
					else
					{
						$to_user_id = $last_chat[0]->user_id;
						$toUser = $last_chat[0]->user_id;
					}
					
					switch ($fetch_type)
					{
						case 'inbox':
							$latest_chats = DB::select("SELECT * FROM ".config('constants.TBL_USER_CHATS')." WHERE job_id = '".$job_id."' AND to_user_id='".$authUser."' AND user_id = '".$toUser."' ORDER BY id DESC");
							break;

						case 'starred':
							$latest_chats = DB::select("SELECT * FROM ".config('constants.TBL_USER_CHATS')." WHERE job_id = '".$job_id."' AND ((user_id='".$authUser."' AND to_user_id = '".$toUser."' AND is_starred_for_sender='1') OR (to_user_id='".$authUser."' AND user_id = '".$toUser."' AND is_starred_for_receiver='1')) ORDER BY id DESC");
							break;

						case 'sent':
							$latest_chats = DB::select("SELECT * FROM ".config('constants.TBL_USER_CHATS')." WHERE job_id = '".$job_id."' AND user_id='".$authUser."' AND to_user_id = '".$toUser."' ORDER BY id DESC");
							break;

						case 'archived':
							break;
						
						default:
							break;
					}
				}
			}
		}
		//dd($latest_chats); exit;
		if(count($latest_chats) > 0)
		{
			$from_user_id = $authUser;
			$to_user_id = $latest_chats[0]->user_id == $authUser ? $latest_chats[0]->to_user_id : $latest_chats[0]->user_id;
			$fromUserDetails = getUserById($from_user_id);
			$toUserDetails = getUserById($to_user_id);
		}
		

		return view('chat/mail_chat_box', compact(
			'data',
			'successMsg',
			'jobDetails',
			'latest_chats',
			'all_proposals',
			'job_id',
			'jobProviderDetails',
			'isJobProviderLoggedIn',
			'authUser',
			'activeMenu',
			'to_user_id',
			'is_ajax',
			'emailForUsers',
			'fetch_type',
			'chatUsersList',
			'fromUserDetails',
			'toUserDetails'
		));
	}

	public function getProfileNotification(Request $request)
	{
		$is_ajax = $request->isAjax;
		$loggedUser = Auth::user()->id;

		$unreadNotifications = UserNotification::where(['user_id'=>$loggedUser, 'viewed_status'=>'N'])->orderBy('id', 'DESC')->get();
		$readNotifications = UserNotification::where(['user_id'=>$loggedUser, 'viewed_status'=>'Y'])->orderBy('id', 'DESC')->get();
		$count = count($unreadNotifications);
		$json_array['countNewNotification'] = $count;
		$returnHTML = view('layouts/notification', compact('unreadNotifications', 'readNotifications'))->render();
		$json_array['returnHTML'] = $returnHTML;

		return response()->json($json_array);
	}
}
