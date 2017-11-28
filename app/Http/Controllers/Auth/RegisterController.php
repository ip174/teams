<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registration-confirm';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
		//echo 'test'; exit;
		$countries = Country::all();
        $data = [
           'countries' => $countries
        ];
        return view('auth.register', $data);
    }
	

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
			'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'terms_cond_check' => [
                'required',
                Rule::in(['Y']),
            ],
            'type' => [
                'required',
                Rule::in([1, 2]),
            ]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
		//$this->ship($data, $data['email']);
		$email = $data['email'];
		$data_email = $data;
		$verify_link = url('user/verify-account').'/'.md5($email).'/'.base64_encode(date('Y-m-d H:i:s'));
		$data_email['verify_link'] = $verify_link;
		Mail::send('emails.verify_account_link', $data_email, function ($message) use ($email) {
			$message
			->from(env('MAIL_FROM_ADDRESS', false), 'Team Network')
			->to($email)
			->subject('Account Verification Link | Team Network');
		});
		//debug($data); exit;
		
		
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
			'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'type' => $data['type'],
        ]);
		/*DB::table('users')->insert([
			'email' => $data['email'],
			'username' => $data['username'],
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'password' => bcrypt($data['password']),
			'type' => $data['type']
		]);*/
		//echo "OK"; exit;
		//return redirect('registration-confirm');
		
    }
	
	/*public function ship(Request $request, $orderId)
    {
		$order = Order::findOrFail($orderId);
		
        Mail::to($request->user())
			->send(new OrderShipped($order));
    }*/
	
	public function registration_confirm(){
		//echo "Test"; exit;
		$data = [];
		
		return view('auth.registration_confirm', $data);
	}
	
	public function verify_account($email, $time){
		//echo $email; exit;
		$data = [];
		
		$check_exist = DB::select('select * from users where md5(email) = :email', ['email' => $email]);
		//dd($check_exist); exit;
		
		if(count($check_exist) >= 1){
			$userUpdate['is_active'] = 'Y';
			DB::table('users')
			->where('id', $check_exist[0]->id)
			->update($userUpdate);
			
			$data['response_msg'] = "success";
		}else{
			$data['response_msg'] = "error";
		}
		//dd($data); exit;
		
		return view('auth.verify_account', $data);
	}
	
	public function reset_password($email)
	{
		//echo $email; exit;
		$data['email'] = $email;
		
		$check_exist = DB::select('select * from users where md5(email) = :email', ['email' => $email]);
		//dd($check_exist); exit;
		
		if(count($check_exist) >= 1)
		{
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$getData = $_POST;
				
				$found_error = 0;
				$data['errorMsg'] = "";
				if(empty($getData['password']))
				{
					$data['errorMsg'] .= "<br>Please enter password!";
					$found_error = 1;
				}
				if(empty($getData['password_confirmation']))
				{
					$data['errorMsg'] .= "<br>Please enter confirm password!";
					$found_error = 1;
				}
				if(!empty($getData['password']) && !empty($getData['password_confirmation']) && $getData['password']!=$getData['password_confirmation'])
				{
					$data['errorMsg'] .= "<br>Please enter same password!";
					$found_error = 1;
				}
				
				if($found_error == 0)
				{
					$userUpdate['password'] = bcrypt($getData['password']);
					DB::table('users')
					->where('id', $check_exist[0]->id)
					->update($userUpdate);
					
					$data['succMsg'] = "Password successfully changed.";
					unset($data['errorMsg']);
				}
			}
		}
		else
		{
			return redirect('');
		}
		//dd($data); exit;
		
		return view('auth.reset_password', $data);
	}
}
