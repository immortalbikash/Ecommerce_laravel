<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userProfile(Request $request){
        $user = auth()->user();
        $countries = Country::all();
        // echo "<pre>";
        // print_r($user->profile);
        // exit;

        return view('user_profile',compact('user', 'countries'));
    }


    public function userProfileUpdate(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:15|string',
            'last_name' =>'required|max:15|string|different:first_name',
            'email' => 'required|email',
            'contact' => 'numeric|nullable',
            'gender' => 'required|in:Male,Female',
            'address' => 'nullable|string|max:100',
            'country' => 'required|exists:countries,id',
        ]);
        $requestData = $request->except(['_token', '_method', 'update']);
        // echo "<pre>";
        // print_r($requestData);
        // exit;
        $user = User::find(auth()->user()->id);
        $user->update($requestData);
        return redirect()->route('user_profile');
    }

    public function userImageUpdate(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $this->validate($request, [
            'profile' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except(['_token', 'update']);
        // echo "<pre>";
        // print_r($request->profile->extension());
        // exit;
        $imgName = 'lv_' .rand() . '.' . $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;
        $user = User::find(auth()->user()->id);
        $existingProfile = $user->profile;  //old image ----yo image hatauna lai
        $user->update($requestData);
        unlink('profiles/' . $existingProfile);
        return redirect()->route('user_profile');
    }
}
