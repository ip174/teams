<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use App\User;
use App\UserLogin;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';
	protected $redirectToVerify = "login";
	
	/**
    * Where to redirect users after logout.
    *
    * @var string
    **/
	protected $redirectAfterLogout = 'login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
    **/
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }
	
	public function login_success(Request $request){
		if (Auth::attempt(['email' => $email, 'password' => $password])) {
			//return redirect($this->redirectTo);
		}
		
	}

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider);
        if ($provider == 'google') {
            $user->stateless();
        }
        $user = $user->user();

		//dd($user->getName());

        // Check if email id already exists.
        $checkUser = User::where('email', $user->email)
            ->whereNull('provider_id')->first();
        if ($checkUser !== null) {
            return redirect('login')->with('email_exists', 'Sorry! Unable to login. Email already in use for normal login.');
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);

        // $user->token;
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    private function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }

        // Get first name and last name.
        $first_name = $last_name = '';
        if ($provider == 'google' && !empty($user->user['name'])) {
            $first_name = $user->user['name']['givenName'];
            $last_name = $user->user['name']['familyName'];
        }
        else {
            $split_name = split_name($user->getName());
            $first_name = $split_name['first_name'];
            $last_name = $split_name['last_name'];
        }

        return User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
			'username'    => 0,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'profile_picture' => $user->getAvatar()
        ]);
    }
	
	/**
    * Log the user out of the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    **/
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect($this->redirectAfterLogout);
    }
}
