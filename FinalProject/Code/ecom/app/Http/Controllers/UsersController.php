<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Country;
use Auth;
use DB;
use Session;
use App\Classes\ActivationService;
class UsersController extends Controller
{
	protected $activationService;

	public function __construct(ActivationService $activationService)
    {
        $this->activationService = $activationService;
    }

	public function userLoginRegister() {
		return view('users.login_register');
	}


    public function register(Request $request) {
    	if ($request->isMethod('post')) {
    		$data = $request->all();

    		$usersCount = User::where('email', $data['email'])->count();
    		if ($usersCount > 0) {
    			return redirect()->back()->with('flash_message_error', 'Email already exists!');
    		} else {
    			$user = new User;
    			$user->name = $data["name"];
    			$user->email = $data["email"];
    			$user->password = bcrypt($data['password']);
				$user->save();
				$this->activationService->sendActivationMail($user);
				// if ($user = $this->activationService->activateUser($token)) {
				// 	auth()->login($user);
				// 	return redirect('/cart');
				// }
			
				return redirect('/login-register')->with('flash_message_error', 'Bạn hãy kiểm tra email và thực hiện xác thực theo hướng dẫn.');
				
				
				// if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
    			// 	Session::put('frontSession',$data['email']);
    			// 	if(!empty(Session::get('session_id'))){
    			// 		$session_id = Session::get('session_id');
    			// 		DB::table('cart')->where('session_id', $session_id)->update(['user_email'=>$data['email']]);
    			// 	}
    			// 	return redirect('/cart');
    			// }
	    	}
    	}
    }
	public function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token)) {
            return redirect('/login-register')->with('flash_message_error', 'Tài khoản đã được kích hoạt. Vui lòng đăng nhập !!');
        }
        abort(404);
    }
    public function logout() {
    	Auth::logout();
    	Session::forget('frontSession');
    	Session::forget('session_id');
    	return redirect('/');
    }

    public function login(Request $request) {
    	if ($request->isMethod('post')) {
    		$data = $request->all();
    		if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
				$test= DB::table('users')->where('email',$data['email'])->first();
				if($test->active==0){
					auth()->logout();
					return redirect()->back()->with('flash_message_error', 'Check your authenticated email to login !');
				}
    			
				Session::put('frontSession',$data['email']);
				if(!empty(Session::get('session_id'))){
					$session_id = Session::get('session_id');
					DB::table('cart')->where('session_id', $session_id)->update(['user_email'=>$data['email']]);
				}
				return redirect('/cart');
				
    		}
    		else {
    			return redirect()->back()->with('flash_message_error', 'Invalid Username or Password!');
    		}
  		}
	}

    public function checkEmail(Request $request) {
    	$data = $request->all();
    	$usersCount = User::where('email', $data['email'])->count();
		if ($usersCount > 0) {
			echo "false";
		} else {
			echo "true";
			die;
    	}
	}

	public function account(Request $request) {
		$user_id = Auth::user()->id;
		$userDetails = User::find($user_id);
		$countries = Country::get();

		if($request->isMethod('post')) {
			$data = $request->all();
			if (empty($data['name'])) {
				redirect()->back()->with('flash_message_error', 'Please enter your Name to update your account information!');
			}

			if (empty($data['address'])) {
				$data['address'] = '';
			}
			if (empty($data['city'])) {
				$data['city'] = '';
			}
			if (empty($data['state'])) {
				$data['state'] = '';
			}
			if (empty($data['country'])) {
				$data['country'] = '';
			}
			if (empty($data['pincode'])) {
				$data['pincode'] = '';
			}
			if (empty($data['mobile'])) {
				$data['mobile'] = '';
			}
			$user = User::find($user_id);
			$user->name = $data['name'];
			$user->address = $data['address'];
			$user->city = $data['city'];
			$user->state = $data['state'];
			$user->country = $data['country'];
			$user->pincode = $data['pincode'];
			$user->mobile = $data['mobile'];
			$user->save();
			return redirect()->back()->with('flash_message_success', 'Your information has been successfully updated!');
		}
		return view('users.account')->with(compact('countries', 'userDetails'));
	}

	public function chkUserPassword(Request $request) {
		$data = $request->all();
		$current_password = $data['current_pwd'];
		$user_id = Auth::User()->id;
		$check_password = User::where("id", $user_id)->first();
		if (Hash::check($current_password, $check_password->password)) {
			echo "true";
			die;
		} else {
			echo "false";
			die;
		}
	}

	public function updatePassword(Request $request) {
		if ($request->isMethod('post')) {
			$data = $request->all();
			$old_pwd = User::where('id', Auth::User()->id)->first();
			$current_pwd = $data["current_pwd"];
			if (Hash::check($current_pwd, $old_pwd->password)) {
				$new_pwd = bcrypt($data['new_pwd']);
				User::where('id', Auth::User()->id)->update(['password' => $new_pwd]);
				return redirect()->back()->with('flash_message_success', 'Password updated successfully');
			}
			else {
				return redirect()->back()->with('flash_message_error', 'Current Password is Incorrect');
			}
		}

	}

	public function viewUsers() {
		$users = User::orderBy('id', 'DESC')->get();
		return view('admin.users.view_users')->with(compact('users'));
	}
	public function updatePermision(Request $request) {
		if ($request->isMethod('post')) {
			$data = $request->all();
			$user_id = $data['user_id'];
			User::where('id', $user_id)->update(['admin'=>$data['update_permision']]);
		}
		$users = User::orderBy('id', 'DESC')->get();
		return redirect()->back()->with(compact('users'));
	}

	public function viewUserDetails($user_id) {
		$userDetails = User::where('id', $user_id)->first();
		return view('admin.users.user_details')->with(compact('userDetails'));	
	}
}
