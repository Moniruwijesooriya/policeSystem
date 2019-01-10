<?php

namespace App\Http\Controllers;
use App\RemovedUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DOIGController extends Controller
{
    public function __construct()
    {
        $this->middleware('doig');
    }

    public function index(){
        $nic=Auth::User()->nic;
        $doigDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        $offices = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->get();
        return view('doig.doigHome',compact('doigDetails','branches','offices'));
    }
    public function test(){
        return view('doig.test');
    }
    public function tempHome(){
        return view('doig.tempHome',compact('doigDetails','branches'));
    }


    public function doigPasswordChange(Request $request){
        $currentpassword=$request->currentpassword;
        $newpassword=$request->newpassword;
        $confirmpassword=$request->confirmpassword;

        $doig=DB::table('users')->where('nic',$request->nic)->first();

        if(Hash::check($currentpassword,$doig->password) && $newpassword==$confirmpassword ){
            DB::table('users')
                ->where('nic',$request->nic)
                ->update(['password'=>Hash::make($request->newpassword)]);
            DB::table('users')
                ->where('nic',$request->nic)
                ->update(['email_verified_at'=>"2019-01-03 00:00:00"]);
            $nic=Auth::User()->nic;
            $doigDetails = db::table('users')->where('nic',$nic)->First();
            $branches = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            return view('doig.doigProfileForm',compact('doigDetails','branches'));

        }else{
            $nic=Auth::User()->nic;
            $doigDetails = db::table('users')->where('nic',$nic)->First();
            $branches = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            return view('doig.doigProfileForm',compact('doigDetails','branches'));
            
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
                return redirect('/doig');
            }

        }
        else{

        }
    }
    public function viewNewCitizenRequests(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $doigDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        $citizens=db::table('users')->where('role',"citizen")->where('verified',"No")->where('policeOffice',$user->policeOffice)->get();
        $type="New Citizen Registration Requests";
        return view('doig.citizenListView',compact('citizens','type','branches','doigDetails'));
    }
    public function viewRegisteredCitizens(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $citizens=db::table('users')->where('role',"citizen")->where('verified',"Yes")->where('policeOffice',$user->policeOffice)->get();
        $type="Registered Citizens";
        $doigDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('doig.citizenListView',compact('citizens','type','doigDetails','branches'));
    }
    public function viewClosedAccounts(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $citizens=db::table('removed_users')->where('role',"citizen")->where('policeOffice',$user->policeOffice)->get();
        $type="Closed Accounts";
        $doigDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('doig.citizenListView',compact('citizens','type','branches','doigDetails'));
    }

    public function viewOffice(Request $request){
        $officeDetails=db::table('police_offices')->where('id',$request->officeID)->First();
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $newEntries = db::table('entries')->where('policeDivisionOffice',$request->officeID)->where('boicNotification',"y")->get();
        $ongoingEntries = db::table('entries')->where('policeDivisionOffice',$request->officeID)->where('boicNotification',"y o")->get();
        $closedEntries = db::table('entries')->where('policeDivisionOffice',$request->officeID)->where('status',"closed")->get();
        $officeOfficerDetails = db::table('users')->where('nic',$request->mainOfficer)->First();
        $offices = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Division Police Office')->get();
        return view('doig.viewOffice',compact('officeDetails','oicDetails','newEntries','ongoingEntries','closedEntries','offices','oicDetails','officeOfficerDetails'));

    }

    public function doigProfileFormView(){
        $nic=Auth::User()->nic;
        $doigDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('doig.doigProfileForm',compact('doigDetails','branches'));
    }
    public function doigProfileUpdate(Request $request)
    {

       $result= DB::table('users')

            ->where('nic', $request->nic)
            ->update(['address' => $request->homeAddress, 'mobileNumber' => $request->mobNumber, 'landLineNumber' => $request->landNumber, 'email' => $request->email]);
        if($result){
            $nic=Auth::User()->nic;
            $doigDetails = db::table('users')->where('nic',$nic)->First();
            $branches = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            return view('doig.doigProfileForm',compact('doigDetails','branches'));

        }


    }
    public function deactivatedoigFormView(){
        $nic=Auth::User()->nic;
        $doigDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('doig.deactivatedoigForm',compact('doigDetails','branches'));
    }
    public function changedoigPasswordFormView(){
        $nic=Auth::User()->nic;
        $doigDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$doigDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('doig.changedoigPasswordForm',compact('doigDetails','branches'));
    }
    public function doigAccountDeactivate(Request $request)
    {
        $userpassword=$request->password;
        $doig = db::table('users')->where('nic',$request->nic)->first();
        if (Hash::check($userpassword,$doig->password)){
            DB::table('users')->where('nic',$request->nic)->delete();
            return redirect('/');
        }
        else{
            return redirect('/RegisteredCitizen');
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

