<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request){
        return view('admin.index');
    }

    public function usersList(Request $request){
        // $users = DB::table('Select * from users');
        $users = User::with('getCountry')->get();
        return view('admin.users_list', compact('users'));
    }

    public function editUsers(Request $request, User $id){  //$id ma data aucha of user
        // echo"<pre>";
        // print_r($id);
        // exit;
        $countries = Country::all();
        return view('admin.user_edit', compact('countries','id'));
    }

    public function updateUser(Request $request, User $id){
        // echo "<pre>";
        // print_r($id);
        // exit;
        $id->first_name = $request->first_name ?? $id->first_name;
        $id->last_name = $request->last_name ?? $id->last_name;
        $id->email = $request->email ?? $id->email;
        $id->contact = $request->contact ?? $id->contact;
        $id->gender = $request->gender ?? $id->gender;
        $id->role_id = $request->role ?? $id->role_id;
        $id->address = $request->address ?? $id->address;
        $id->country = $request->country ?? $id->country;
        if(isset($request->profile)){
            $imgName = 'lv_' . rand() . '.' . $request->profile->extension();
            $request->profile->move(public_path('profiles/'), $imgName);
            $id->profile = $imgName;
        }
        $id->save();
        return redirect()->route('admin_user_list');
    }

    public function adminImageUpdate(Request $request, User $id){
        $this->validate($request, [
            'profile' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except('_token', 'update');
        $imgName = 'lv_' .rand() . '.' . $request->profile->extension();
        $request->profile->move(public_path('profiles/'), $imgName);
        $requestData['profile'] = $imgName;
        $user = User::find($id->id);
        $existingProfile = $id->profile;  //old image ----yo image hatauna lai
        $id->update($requestData);
        unlink('profiles/' . $existingProfile);
        return redirect()->route('admin_user_list');
    }

    public function adminRegisterUserProfile(Request $request){
        $countries = Country::all();
        return view('admin.user_register', compact('countries'));
    }

    public function adminRegisterUserProfileData(Request $request){

    }

    public function changeUserStatus(Request $request, $id, $status=1){ //default status 1 ho bhaneko
        $user = User::find($id);
        if(!empty($user)){
            $user->is_active = $status;
            $user->save();
            return redirect()->route('admin_user_list');
        }
        else{

        }
    }
}
