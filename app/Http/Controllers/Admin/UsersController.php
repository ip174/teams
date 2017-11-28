<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    private $resource = 'users';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource = $this->resource;
        $per_page = config('constants.ADMIN_PER_PAGE');
		
		$users_details = User::select('users.*', 'user_details.*', 'job_type.job_title', 'focus_type.focus_type', 'field_of_work_type.type_title')
			->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
			//->leftJoin('user_skill_map', 'users.id', '=', 'user_skill_map.user_id')
			->leftJoin('job_type', 'user_details.job_type', '=', 'job_type.job_type_id')
			->leftJoin('focus_type', 'user_details.focus', '=', 'focus_type.focus_type_id')
			->leftJoin('field_of_work_type', 'user_details.field_of_work', '=', 'field_of_work_type.type_id')
			->where('users.is_active', 'Y')
			//->where('users.id', $user['id'])
			->orderBy('users.id', 'desc')
			->paginate($per_page);
		//dd($users_details); exit;
		
		//$data['users_details'] = $users_details;
		//return view('admin.'. $resource . '.list', compact($data));
		
		return view('admin.'. $resource . '.list', compact('users_details', 'resource'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
		$userTypes = config('constants.langs');
		$session_data = $request->session()->all();
		$isSessionSet = 0;
		if(@$session_data['isSessionSet']==1){
			$request->session()->forget('isSessionSet');
			$isSessionSet = 1;
		}
		//debug($session_data); exit;
		
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
		
        $resource = $this->resource;
		
		//$dataSkills = array();
		
		
        //$users_details = User::find($id);
		/*$users_details = User::select('users.*', 'user_details.*')
			->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
			->where('users.id', $id)
			->first();*/
		$users_details = DB::table('users')
			->select('users.*', 'user_details.*', DB::raw('GROUP_CONCAT(user_skill_map.skill_id) as skills'))
			->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
			->leftJoin('user_skill_map', 'users.id', '=', 'user_skill_map.user_id')
			//->selectRaw('GROUP_CONCAT(user_skill_map.skill_id) as skills')
			->where('users.id', $id)
			->groupBy('user_skill_map.user_id')
			->first();
		//$users_details = DB::select('select users.*, user_details.*, GROUP_CONCAT(user_skill_map.skill_id) as skills from users laft join user_details ON users.id=user_details.user_id LEFT JOIN user_skill_map ON users.id=user_skill_map.user_id where users.id = :id GROUP BY user_skill_map.user_id', ['id' => $id]);
		//dd($users_details); exit;
		
		$dataSkills = array();
		if($isSessionSet == 1){
			$dataSkills = @$session_data['skills'];
		}else{
			$dataSkills = explode(',', $users_details->skills);
		}
		
        return view('admin.'. $resource . '.edit_user', compact(
			'users_details',
			'resource',
			'userTypes',
			'all_focus',
			'all_workField',
			'all_jobType',
			'all_skills',
			'all_travelType',
			'dataSkills',
			'id',
			'session_data',
			'isSessionSet'
		));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$postData = $request->all();
		$request->session()->put($postData);
		$request->session()->put('isSessionSet', '1');
		//$session_data = $request->session()->all();
		//dd($session_data['first_name']); exit;
		
		$this->validate($request, [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
            ]
        );
		
		//dd($postData); exit;
		
		$userUpdate['first_name'] = $postData['first_name'];
		$userUpdate['last_name'] = $postData['last_name'];
		
		DB::table('users')
		->where('id', $id)
		->update($userUpdate);
		
		$userDetailsUpdate['rate_per_hour'] = $postData['rate_per_hour'];
		$userDetailsUpdate['location'] = $postData['location'];
		$userDetailsUpdate['travel_distance'] = $postData['travel_distance'];
		$userDetailsUpdate['website'] = $postData['website'];
		$userDetailsUpdate['focus'] = $postData['focus'];
		$userDetailsUpdate['field_of_work'] = $postData['field_of_work'];
		$userDetailsUpdate['about'] = $postData['about_me'];
		$userDetailsUpdate['job_type'] = $postData['job_type'];
		DB::table('user_details')
		->where('user_id', $id)
		->update($userDetailsUpdate);
		
		
		$skills = @$postData['skills'];
		$skillInsert = array();
		for($i=0; $i < sizeof($skills); $i++){
			$skillInsert[$i]['user_id'] = $id;
			$skillInsert[$i]['skill_id'] = $skills[$i];
		}
		DB::table('user_skill_map')->where('user_id', '=', $id)->delete();
		if($skillInsert){
			DB::table('user_skill_map')->insert($skillInsert);
		}
		
        /*$user = User::find($id);
        $user->fill($request->all());
        $user->save();*/
        return redirect()->back()->with('success', 'Update was successfully done.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'User successfully removed!');
    }
	
	public function delete_user($id)
    {
		$users_details = User::select('users.*')
			->where('users.id', $id)
			->first();
		
		if($users_details->profile_picture){
			$img_path = public_path().'/assets/frontend/profile_pictures/'.$users_details->profile_picture;
			unlink($img_path);
		}
		//dd($img_path); exit;
		
		DB::table('users')->where('id', '=', $id)->delete();
		DB::table('user_details')->where('user_id', '=', $id)->delete();
		DB::table('user_skill_map')->where('user_id', '=', $id)->delete();
		
        return redirect()->back()->with('success', 'User successfully removed!');
    }

    public function changeStatus(Request $request, $id)
    {
        if (!$request->has('current_status')) {
            return redirect()->back()->with('error', 'Sorry! something went wrong.');
        }

        if ($request->input('current_status') == 'Y') {
            $is_active = 'N';
            $msg = 'disabled';
        }
        else {
            $is_active = 'Y';
            $msg = 'enabled';
        }

        User::where('id', $id)->update(['is_active' => $is_active]);
        return redirect()->back()->with('success', 'Passenger is ' . $msg . '!');
    }
}
