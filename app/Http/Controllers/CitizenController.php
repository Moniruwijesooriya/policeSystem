<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\CitizenRegistrationNotif;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CitizenController extends Controller
{

    public function registerCitizen(Request $request)
    {
        $citizen = new User();
        $citizen->name = $request->name;
        $citizen->nic = $request->nic;
        $citizen->address = $request->homeAddress;
        $citizen->mobileNumber = $request->mobNumber;
        $citizen->landLineNumber = $request->landNumber;
        $citizen->profession = $request->profession;
        $citizen->email = $request->email;
        $citizen->role = "citizen";
        $citizen->remember_token = str_random(60);
        $citizen->password = Hash::make($request->password);
        $citizen->verified = "n";

        $citizen->save();

        $notification = new CitizenRegistrationNotif();
        $notification->nic = $request->nic;
        $notification->systemRole = "citizen";
        $notification->verified = "n";

        $notification->save();
        return redirect(('/'));
    }


    public function getCitizenRegistrationNotification()
    {
        db::table('citizen_registration_notifs')->where('verified',"n")->where('role',"citizen")->get();

    }
    public function ViewRequest(Request $request){
        $citizenDetails = db::table('users')->where('nic',$request->nic)->First();
        return view('admin/reviewRequest',compact('citizenDetails'));
    }

    public function AcceptCitizenRequest(Request $request){

        DB::table('users')
            ->where('nic',$request->nic)
            ->update(['verified'=>"y"]);
        return redirect('/admin');
    }
}
