<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegistration extends Controller
{
    public function registerCitizen(Request $request){
        $citizen=new User();
        $citizen->name=$request->name;
        $citizen->nic=$request-> nic;
        $citizen->address=$request->homeAddress;
        $citizen->mobileNumber=$request->mobNumber;
        $citizen->landLineNumber=$request->landNumber;
        $citizen->profession=$request->profession;
        $citizen->email=$request->email;
        $citizen->role=$request->role;
        $citizen->remember_token=$request->tokenID;
        $policeOfficer->password=Hash::make($request->password);

        $policeOfficer->save();
        return redirect()->back();



    }
}

            'role'=>$data['role'],
            'verified'=>'no'
