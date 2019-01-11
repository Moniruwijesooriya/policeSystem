<?php

namespace App\Http\Controllers;
use App\RemovedUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IGPController extends Controller
{
    public function __construct()
    {
        $this->middleware('igp');
    }

    public function index(){
        $nic=Auth::User()->nic;
        $igpDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('policeOfficeType','Branch Police Office')->get();
        $offices = db::table('police_offices')->get();
        return view('igp.igpHome',compact('igpDetails','branches','offices'));
    }
    public function test(){
        return view('igp.test');
    }
    public function tempHome(){
        return view('igp.tempHome',compact('igpDetails','branches'));
    }


    public function igpPasswordChange(Request $request){
        $currentpassword=$request->currentpassword;
        $newpassword=$request->newpassword;
        $confirmpassword=$request->confirmpassword;

        $igp=DB::table('users')->where('nic',$request->nic)->first();

        if(Hash::check($currentpassword,$igp->password) && $newpassword==$confirmpassword ){
            DB::table('users')
                ->where('nic',$request->nic)
                ->update(['password'=>Hash::make($request->newpassword)]);
            DB::table('users')
                ->where('nic',$request->nic)
                ->update(['email_verified_at'=>"2019-01-03 00:00:00"]);
            $nic=Auth::User()->nic;
            $igpDetails = db::table('users')->where('nic',$nic)->First();
            $branches = db::table('police_offices')->where('headPoliceOffice',$igpDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            return view('igp.igpProfileForm',compact('igpDetails','branches'));

        }else{
            $nic=Auth::User()->nic;
            $igpDetails = db::table('users')->where('nic',$nic)->First();
            $branches = db::table('police_offices')->where('headPoliceOffice',$igpDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            return view('igp.igpProfileForm',compact('igpDetails','branches'));
            
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
                return redirect('/igp');
            }

        }
        else{

        }
    }
    public function viewNewCitizenRequests(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $igpDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('policeOfficeType','Branch Police Office')->get();
        $offices = db::table('police_offices')->get();
        $citizens=db::table('users')->where('role',"citizen")->where('verified',"No")->where('policeOffice',$user->policeOffice)->get();
        $type="New Citizen Registration Requests";
        return view('igp.citizenListView',compact('citizens','type','branches','igpDetails','offices'));
    }
    public function viewRegisteredCitizens(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $citizens=db::table('users')->where('role',"citizen")->where('verified',"Yes")->get();
        $type="Registered Citizens";
        $igpDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('policeOfficeType','Branch Police Office')->get();
        $offices = db::table('police_offices')->get();
        return view('igp.citizenListView',compact('citizens','type','igpDetails','branches','offices'));
    }
    public function viewClosedAccounts(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $citizens=db::table('removed_users')->where('role',"citizen")->where('policeOffice',$user->policeOffice)->get();
        $type="Closed Accounts";
        $igpDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('policeOfficeType','Branch Police Office')->get();
        $offices = db::table('police_offices')->get();
        return view('igp.citizenListView',compact('citizens','type','branches','igpDetails','offices'));
    }

    public function viewOfficeIGP(Request $request){
        $officeDetails=db::table('police_offices')->where('id',$request->officeID)->First();
        $nic=Auth::User()->nic;
        $igpDetails = db::table('users')->where('nic',$nic)->First();
        $newEntries = db::table('entries')->where('igpNotification',"y")->get();
        $ongoingEntries = db::table('entries')->where('igpNotification',"y o")->get();
        $closedEntries = db::table('entries')->where('status',"closed")->get();
        $officeOfficerDetails = db::table('users')->First();
        $offices = db::table('police_offices')->where('policeOfficeType','Division Police Office')->get();
        $branches = db::table('police_offices')->where('policeOfficeType','Branch Police Office')->get();
        return view('igp.viewOffice',compact('officeDetails','igpDetails','newEntries','ongoingEntries','closedEntries','offices','igpDetails','officeOfficerDetails','branches'));

    }

    public function viewBranchIGP(Request $request){
        $branchDetails=db::table('police_offices')->where('id',$request->branchID)->First();
        $nic=Auth::User()->nic;
        $igpDetails = db::table('users')->where('nic',$nic)->First();
        $newEntries = db::table('entries')->where('branch',$request->branchID)->where('boicNotification',"y")->get();
        $ongoingEntries = db::table('entries')->where('branch',$request->branchID)->where('boicNotification',"y o")->get();
        $closedEntries = db::table('entries')->where('branch',$request->branchID)->where('status',"closed")->get();
        $branchOfficerDetails = db::table('users')->where('nic',$request->mainOfficer)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$igpDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        $offices = db::table('police_offices')->get();
        return view('igp.viewBranchOffice',compact('branchDetails','igpDetails','newEntries','ongoingEntries','closedEntries','branches','igpDetails','branchOfficerDetails','offices'));

    }

    public function igpProfileFormView(){
        $nic=Auth::User()->nic;
        $igpDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$igpDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('igp.igpProfileForm',compact('igpDetails','branches'));
    }
    public function igpProfileUpdate(Request $request)
    {

       $result= DB::table('users')

            ->where('nic', $request->nic)
            ->update(['address' => $request->homeAddress, 'mobileNumber' => $request->mobNumber, 'landLineNumber' => $request->landNumber, 'email' => $request->email]);
        if($result){
            $nic=Auth::User()->nic;
            $igpDetails = db::table('users')->where('nic',$nic)->First();
            $branches = db::table('police_offices')->where('headPoliceOffice',$igpDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            return view('igp.igpProfileForm',compact('igpDetails','branches'));

        }


    }
    public function deactivateigpFormView(){
        $nic=Auth::User()->nic;
        $igpDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$igpDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('igp.deactivateigpForm',compact('igpDetails','branches'));
    }
    public function changeigpPasswordFormView(){
        $nic=Auth::User()->nic;
        $igpDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$igpDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('igp.changeigpPasswordForm',compact('igpDetails','branches'));
    }
    public function igpAccountDeactivate(Request $request)
    {
        $userpassword=$request->password;
        $igp = db::table('users')->where('nic',$request->nic)->first();
        if (Hash::check($userpassword,$igp->password)){
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