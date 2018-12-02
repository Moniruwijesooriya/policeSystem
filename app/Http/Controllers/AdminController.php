<?php

namespace App\Http\Controllers;

use App\PoliceOffice;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        return view('admin.index');
    }
    public function registerPoliceOfficer(Request $request){
        $policeOfficer=new User();
        $policeOfficer->name=$request->name;
        $policeOfficer->nic=$request-> nic;
        $policeOfficer->address=$request->homeAddress;
        $policeOfficer->mobileNumber=$request->mobNumber;
        $policeOfficer->landLineNumber=$request->landNumber;
        $policeOfficer->profession=$request->profession;
        $policeOfficer->email=$request->email;
        $policeOfficer->role=$request->role;
        $policeOfficer->gender = $request->gender;
        $policeOfficer->dob = $request->dob;
        $policeOfficer->policeOffice=$request->policeOffice;
        $policeOfficer->remember_token=str_random(60);
        $randomPassword="123123";
//        $randomPassword=str_random(10);
        $policeOfficer->password=Hash::make($randomPassword);
        $policeOfficer->verified="Yes";
        $policeOfficer->token=str_random(25);
        $policeOfficer->fullName=$request->fullName;
        $email=$request->email;
        $policeOfficer->save();

        $data = array('heading'=>"Weclome to Crime Reporting System",'fullName'=>"Full Name: ".$request->fullName,'name'=>
            "Name with initials: ".$request->name,'thank'=>"Thank You!",
            'nic'=>"NIC : ".$request->nic,
            'msg'=>"Your account is successfully created. A random password is provided and please change it.",'randomPassword'=>"Your random password: ".$randomPassword);

        Mail::send(['text'=>'sendEmail.policeOfficerRegisterEmail'], $data, function($message) use($email) {
            $message->to($email)->subject
            ('SL Police System Registration');
            $message->from('slpolicesystem@gmail.com','SL Police');
        });
        $policeOfficer->save();


        return redirect()->back();
    }
//removeFormView to police officers
    public function removeFormView(Request $request){

        $policeOfficer = db::table('users')->where('nic',$request->nic)->First();
        return view('admin.removePoliceOfficerForm',compact('policeOfficer'));
    }
    //removePoliceOfficer

    public function removePoliceOfficer(Request $request)
    {
        $res = db::table('users')->where('nic', $request->nic)->delete();

        if ($res) {
            return redirect('/admin');
        }
    }

    public function registerPoliceOffice(Request $request){
        $policeOffice=new PoliceOffice();
        $policeOffice->district=$request->district;
        $policeOffice->policeOfficeArea=$request-> policeOfficeArea;
        $policeOffice->policeOfficeType=$request->policeOfficeType;
        $policeOffice->landNumber=$request->landNumber;
        $area=$request-> policeOfficeArea;
        $type=$request->policeOfficeType;
        $officeName=$area." ".$type;
        $policeOffice->OfficeName=$officeName;
        $policeOffice->mainOfficer=$request->landNumber;

        $policeOffice->save();

        return redirect()->back();

    }



}
