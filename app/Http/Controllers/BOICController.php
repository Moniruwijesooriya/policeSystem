<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BOICController extends Controller
{
    public function __construct()
    {
        $this->middleware('boic');
    }

    public function index(){
        $nic=Auth::User()->nic;
        $boicDetails = db::table('users')->where('nic',$nic)->First();
        return view('boic.boicHome',compact('boicDetails'));
    }
    public function boicPasswordChange(Request $request){
        $currentpassword=$request->currentpassword;
        $newpassword=$request->newpassword;
        $confirmpassword=$request->confirmpassword;

        $oic=DB::table('users')->where('nic',$request->nic)->first();
        Session::flash('CitizenPasswordUpdate','password is updated successfully!');
        if (Hash::check($currentpassword,$oic->password) && $newpassword == $confirmpassword){
            DB::table('users')
                ->where('nic',$request->nic)
                ->update(['password'=>Hash::make($request->newpassword)]);
            $nic=Auth::User()->nic;
            $oicDetails = db::table('users')->where('nic',$nic)->First();
            return view('boic.boicProfileForm',compact('oicDetails'));

        }else{
            $nic=Auth::User()->nic;
            //alert ekak dannaaaa
            $boicDetails = db::table('users')->where('nic',$nic)->First();
            return view('boic.boicProfileForm',compact('boicDetails'));

        }
    }

    public function boicProfileFormView(){
        $nic=Auth::User()->nic;
        $boicDetails = db::table('users')->where('nic',$nic)->First();
        return view('boic.boicProfileForm',compact('boicDetails','branches'));
    }
    public function boicProfileUpdate(Request $request)
    {

        $result= DB::table('users')

            ->where('nic', $request->nic)
            ->update(['address' => $request->homeAddress, 'mobileNumber' => $request->mobNumber, 'landLineNumber' => $request->landNumber, 'email' => $request->email]);
        if($result){
            $nic=Auth::User()->nic;
            $boicDetails = db::table('users')->where('nic',$nic)->First();
            $branches = db::table('police_offices')->where('headPoliceOffice',$boicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            return view('boic.boicProfileForm',compact('boicDetails','branches'));

        }
    }
    public function deactivateBOICFormView(){
        $nic=Auth::User()->nic;
        $boicDetails = db::table('users')->where('nic',$nic)->First();
        return view('boic.deactivateBOICForm',compact('boicDetails','branches'));
    }
    public function changeBOICPasswordFormView(){
        $nic=Auth::User()->nic;
        $boicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$boicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('boic.changeBOICPasswordForm',compact('boicDetails','branches'));
    }
    public function boicAccountDeactivate(Request $request)
    {
        $userpassword=$request->password;
        $oic = db::table('users')->where('nic',$request->nic)->first();
        if (Hash::check($userpassword,$oic->password)){
            DB::table('users')->where('nic',$request->nic)->delete();
            return redirect('/');
        }
        else{
            //alert ona
            return view('boic.boicHome');
        }

    }
}
