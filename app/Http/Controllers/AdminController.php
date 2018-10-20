<?php

namespace App\Http\Controllers;

use App\PoliceOffice;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
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
        $policeOfficer->password=Hash::make($request->password);
        $policeOfficer->verified="Yes";
        $policeOfficer->token=str_random(25);
        $policeOfficer->fullName=$request->fullName;

        $policeOfficer->save();

        $data = array('heading'=>"Weclome to Crime Reporting System",'fullName'=>"Full Name: ".$request->fullName,'name'=>
            "Name with initials: ".$request->name,'Tempory'=>rand(10,100));

        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('monirutasad@gmail.com')->subject
            ('SL Police System Registration');
            $message->from('slpolicesystem@gmail.com','SL Police');
        });


        return redirect()->back();



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
