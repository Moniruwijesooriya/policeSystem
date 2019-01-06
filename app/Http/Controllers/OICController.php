<?php

namespace App\Http\Controllers;
use App\RemovedUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OICController extends Controller
{
    public function __construct()
    {
        $this->middleware('oic');
    }

    public function index(){
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('oic.oicHome',compact('oicDetails','branches'));
    }
    public function test(){
        return view('oic.test');
    }
    public function tempHome(){
        return view('oic.tempHome',compact('oicDetails','branches'));
    }


    public function oicPasswordChange(Request $request){
        $currentpassword=$request->currentpassword;
        $newpassword=$request->newpassword;
        $confirmpassword=$request->confirmpassword;

        $oic=DB::table('users')->where('nic',$request->nic)->first();

        if(Hash::check($currentpassword,$oic->password) && $newpassword==$confirmpassword ){
            DB::table('users')
                ->where('nic',$request->nic)
                ->update(['password'=>Hash::make($request->newpassword)]);
            return redirect('/RegisteredCitizen');
        }else{
            
        }
    }

    public function manageCitizen(Request $request){
        if($request->submitButton=="removeCitizen"){

            $user=db::table('users')->where('Nic',$request->nicTemp)->First();
            $citizen = new RemovedUsers();
            $citizen->name = $user->name;
            $citizen->nic = $user->nic;
            $citizen->address = $user->address;
            $citizen->mobileNumber = $user->mobileNumber;
            $citizen->landLineNumber = $user->landLineNumber;
            $citizen->profession = $user->profession;
            $citizen->email = $user->email;
            $citizen->gender = $user->gender;
            $citizen->dob = $user->dob;
            $citizen->role = "citizen";
            $citizen->email_verified_at = $user->email_verified_at;
            $citizen->civilStatus = $user->civilStatus;
            $citizen->fullName=$user->fullName;
            $citizen->policeOffice=$user->policeOffice;
            $citizen->save();

            $res = db::table('users')->where('nic', $request->nicTemp)->delete();
            if ($res) {
                return redirect('/OIC');
            }

        }
        else{

        }
    }
    public function viewNewCitizenRequests(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $citizens=db::table('users')->where('role',"citizen")->where('verified',"No")->where('policeOffice',$user->policeOffice)->get();
        $type="New Citizen Registration Requests";
        return view('oic.citizenListView',compact('citizens','type'));
    }
    public function viewRegisteredCitizens(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $citizens=db::table('users')->where('role',"citizen")->where('verified',"Yes")->where('policeOffice',$user->policeOffice)->get();
        $type="Registered Citizens";
        return view('oic.citizenListView',compact('citizens','type'));
    }
    public function viewClosedAccounts(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $citizens=db::table('removed_users')->where('role',"citizen")->where('policeOffice',$user->policeOffice)->get();
        $type="Closed Accounts";
        return view('oic.citizenListView',compact('citizens','type'));
    }

}
