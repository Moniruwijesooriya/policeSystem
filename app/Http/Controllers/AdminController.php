<?php

namespace App\Http\Controllers;

use App\PoliceOffice;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

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
        $policeOfficer->policeOffice=$request->policeOffice;
        $policeOfficer->remember_token=str_random(60);
        $policeOfficer->password=Hash::make($request->password);
        $policeOfficer->verified="y";

        $policeOfficer->save();
        return redirect()->back();



    }

    public function registerPoliceOffice(Request $request){
        $policeOffice=new PoliceOffice();
        $policeOffice->district=$request->district;
        $policeOffice->policeOfficeArea=$request-> policeOfficeArea;
        $policeOffice->policeOfficeType=$request->policeOfficeType;
        $policeOffice->landNumber=$request->landNumber;

        $policeOffice->save();
        return redirect()->back();

    }



}
