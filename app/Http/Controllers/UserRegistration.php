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
        $citizen->role="citizen";
        $citizen->remember_token=str_random(60);
        $citizen->password=Hash::make($request->password);
        $citizen->verified="n";

        $citizen->save();
        return redirect(('/'));

    }
}

