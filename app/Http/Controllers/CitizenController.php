<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\CitizenRegistrationNotif;
use Illuminate\Http\Request;
use App\User;
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

    public function registerSystemNotification(Request $request)
    {
        $citizen = new CitizenRegistrationNotif();
        $citizen->nic = $request->nic;
        $citizen->role = "citizen";
        $citizen->verified = "n";

        $citizen->save();
        return redirect(('/'));
    }

    public function getCitizenRegistrationNotification()
    {
        db::table('citizen_registration_notifs')->where('verified',"n")->get();

    }
}
