<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\user\ChangePasswordRequest;

class UserController extends Controller {

// user registration view
    public function index() {
        return view('User.auth.registration');
    }
//  Register user
    public function userPostRegistration(Request $request) {
        $request->validate([
                'name'        =>      'required',
                'last_name'         =>      'required',
                'email'             =>      'required|email',
                'password'          =>      'required|min:6',
                'confirm_password'  =>      'required|same:password',
                'phone'             =>      'required|max:10'
            ]);
        $input          =           $request->all();
        $inputArray      =           array(
            'name'        =>      $request->first_name,
            'last_name'         =>      $request->last_name,
            'full_name'         =>      $request->first_name . " ". $request->last_name,
            'email'             =>      $request->email,
            'password'          =>      Hash::make($request->password),
            'phone'             =>      $request->phone
        );
        $user           =           User::create($inputArray);
        if(!is_null($user)) {
            return back()->with('success', 'You have registered successfully.');
        }

        else {
            return back()->with('error', 'Whoops! some error encountered. Please try again.');
        }
    }
// User login view
    public function userLoginIndex() {
        return view('User.auth.login');
    }


// User login
    public function userPostLogin(Request $request) {

        $request->validate([
            "email"           =>    "required|email",
            "password"        =>    "required|min:6"
        ]);

        $userCredentials = $request->only('email', 'password');

// check user using auth function
        if (Auth::attempt($userCredentials)) {
            return redirect()->intended('user/dashboard');
        }

        else {
            return back()->with('error', 'Whoops! invalid username or password.');
        }
    }


// User Dashboard Section
    public function dashboard() {

        if(Auth::check()) {
            return view('User.dashboard.index');
        }

        return redirect::to("user-login")->withError('Oopps! You do not have access');
    }


//  User logout function 
public function logout(Request $request ) {
    $request->session()->flush();
    Auth::logout();
    return Redirect::to('user-login');
    }
// User ChangePassword function 
    public function getChangePassword(){
        return view('User.auth.changepassword');
    }
    
    public function postChangePassword(ChangePasswordRequest $request){
        User::find(Auth::user()->id)->update(['password'=> bcrypt($request->new_password)]);
        return back()->with('message','Password updated successfully !');
    }
    
}
