<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BOICController extends Controller
{
    public function __construct()
    {
        $this->middleware('boic');
    }

    public function index(){
        return view('boic.boicHome');
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
            $nic=Auth::User()->nic;
            $oicDetails = db::table('users')->where('nic',$nic)->First();
            return view('boic.boicProfileForm',compact('oicDetails'));

        }else{
            $nic=Auth::User()->nic;
            //alert ekak dannaaaa
            $oicDetails = db::table('users')->where('nic',$nic)->First();
            return view('oic.oicProfileForm',compact('oicDetails'));

        }
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
    public function deactivateBOICFormView(){
        $nic=Auth::User()->nic;
        $OICDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$OICDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('boic.deactivateBOICForm',compact('OICDetails','branches'));
    }
    public function changeBOICPasswordFormView(){
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('boic.changeOICPasswordForm',compact('oicDetails','branches'));
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
