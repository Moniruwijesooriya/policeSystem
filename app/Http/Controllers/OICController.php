<?php

namespace App\Http\Controllers;
use App\RemovedUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        $newpassword=$request->newpassword;
        $confirmpassword=$request->confirmpassword;
        $currentpassword=$request->currentpassword;

        $userDetails = db::table('users')->where('nic',$request->nic)->First();

        if ($newpassword==$confirmpassword){
            if (Hash::check($currentpassword,$userDetails->password) && $newpassword == $confirmpassword){
                DB::table('users')
                    ->where('nic',$request->nic)
                    ->update(['password'=>Hash::make($request->newpassword)]);
                $nic=Auth::User()->nic;
                $oicDetails = db::table('users')->where('nic',$nic)->First();
                $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
                Session::put('passwordUpdateMessage','Password is Successfully Updated');
                return view('oic.oicProfileForm',compact('oicDetails','branches'));

            }
            else{
                $nic=Auth::User()->nic;
                $oicDetails = db::table('users')->where('nic',$nic)->First();
                $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
                Session::put('passwordUpdateMessage','Your current password is wrong!!');
                return view('oic.oicProfileForm',compact('oicDetails','branches'));
            }


        }
        else{
            $nic=Auth::User()->nic;
            $oicDetails = db::table('users')->where('nic',$nic)->First();
            $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            Session::put('passwordUpdateMessage','Error in password Update!!');
            return view('oic.oicProfileForm',compact('oicDetails','branches'));
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

            $result=$result= DB::table('users')

                ->where('nic', $request->nicTemp)
                ->update(['blackListStatus' => "Yes"]);

            if ($result) {
                return redirect('/OIC');
            }

        }
        else{

        }
    }
    public function viewNewCitizenRequests(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        $citizens=db::table('users')->where('role',"citizen")->where('verified',"No")->where('policeOffice',$user->policeOffice)->get();
        $type="New Citizen Registration Requests";
        return view('oic.citizenListView',compact('citizens','type','branches','oicDetails'));
    }
    public function viewRegisteredCitizens(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $citizens=db::table('users')->where('role',"citizen")->where('blackListStatus',null)->where('verified',"Yes")->where('policeOffice',$user->policeOffice)->get();
        $type="Registered Citizens";
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('oic.citizenListView',compact('citizens','type','oicDetails','branches'));
    }
    public function viewClosedAccounts(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $citizens=db::table('removed_users')->where('role',"citizen")->where('policeOffice',$user->policeOffice)->get();
        $type="Closed Accounts";
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('oic.citizenListView',compact('citizens','type','branches','oicDetails'));
    }

    public function viewBranch(Request $request){
        $branchDetails=db::table('police_offices')->where('id',$request->branchID)->First();
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $newEntries = db::table('entries')->where('branch',$request->branchID)->where('boicNotification',"y")->get();
        $ongoingEntries = db::table('entries')->where('branch',$request->branchID)->where('boicNotification',"y o")->get();
        $closedEntries = db::table('entries')->where('branch',$request->branchID)->where('status',"closed")->get();
        $branchOfficerDetails = db::table('users')->where('nic',$request->mainOfficer)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('oic.viewBranchOffice',compact('branchDetails','oicDetails','newEntries','ongoingEntries','closedEntries','branches','oicDetails','branchOfficerDetails'));

    }

    public function oicProfileFormView(){
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('oic.oicProfileForm',compact('oicDetails','branches'));
    }
    public function oicProfileUpdate(Request $request)
    {

       $result= DB::table('users')

            ->where('nic', $request->nic)
            ->update(['address' => $request->homeAddress, 'mobileNumber' => $request->mobNumber, 'landLineNumber' => $request->landNumber, 'email' => $request->email]);
        if($result){
            $nic=Auth::User()->nic;
            $oicDetails = db::table('users')->where('nic',$nic)->First();
            $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            return view('oic.oicProfileForm',compact('oicDetails','branches'));

        }


    }


    public function deactivateOICFormView(){
        $nic=Auth::User()->nic;
        $OICDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$OICDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('oic.deactivateOICForm',compact('OICDetails','branches'));
    }

    public function changeOICPasswordFormView(){
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('oic.changeOICPasswordForm',compact('oicDetails','branches'));
    }

    public function oicAccountDeactivate(Request $request)
    {
        $userpassword=$request->password;
        $oic = db::table('users')->where('nic',$request->nic)->first();
        if (Hash::check($userpassword,$oic->password)){
            DB::table('users')->where('nic',$request->nic)->delete();
            return redirect('/logout');
        }
        else{
            return redirect('/OIC');
        }

    }
//        Session::flash('updateCitizen','Updated successfully!');//if
//
//        Session::flash('msg2','Updated failed!');//else
//        $nic=Auth::User()->nic;
//        $citizenDetails = db::table('users')->where('nic',$nic)->First();
//        $crimeCategories = db::table('crime_categories')->where('citizenView',"Yes")->get();
//
//        return view('registeredCitizen.index',compact('message','citizenDetails','crimeCategories'));

}
