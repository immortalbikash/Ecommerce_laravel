<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        $countries = Country::all();
        return view('register', compact('countries'));
    }

    public function storeUser(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:15|string',
            'last_name' =>'required|max:15|string|different:first_name',
            // 'role_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'contact' => 'numeric|nullable',
            'password' => 'required|min:6',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
            'profile' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except('_token', 'regist');
        $imgName = 'lv_' .rand() . '.' . $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;
        $requestData['role_id'] = User::USER_ROLE;
        $store = User::create($requestData);
        return redirect()->route('home');
    }

    public function login(Request $request){
        return view('login');
    }

    public function authenticate(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)){
            //if login success
            $user = auth()->user();  //user ko details dincha yesle
            if(auth()->user()->role_id == User::ADMIN_ROLE){
                //go to admin page
                return redirect()->route('admin_home');
            }
            else{
                //go to user page
                return redirect()->route('home');
            }
        }
        else{
            return redirect()->route('loginlogin');
        }
    }

    public function forgotPassword(Request $request){
        return view('forgot_password');
    }

    public function sendForgotPasswordEmail(Request $request){
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ]);
        $token = $request->_token;
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $requestData = $request->except('_token', 'forgot_pass_btn');
        $requestData['token'] = $token;
        // PasswordReset::create($requestData);
        // $forgotPasswordData = DB::table('password_reset_tokens')->insert($requestData);

        // it is not complete

        // echo "<pre>";
        // print_r($requestData);
        // exit;

    }

    public function logout(Request $request){
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
}
