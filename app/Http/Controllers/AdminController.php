<?php

namespace App\Http\Controllers;

use App\CrimeCategories;
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

        $policeStationOffices = db::table('police_offices')->where('policeOfficeType',"Police Station")->get();
        $divisionPoliceOffices = db::table('police_offices')->where('policeOfficeType',"Division Police Office")->get();
        return view('admin.index',compact('divisionPoliceOffices','policeStationOffices'));

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
        $policeOfficer->civilStatus = $request->civilStatus;
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
        $policeOffice->mainOfficer="Not Appointed Yet";
        $policeOffice->headPoliceOffice=$request->headPoliceOffice;

        $policeOffice->save();
        return redirect()->back();

    }

    public function addCrimeCategories(Request $request){
        $crime=new CrimeCategories();
        $crime->crimeType=$request->crimeType;
        $crime ->categoryType=$request-> categoryType;
        $crime->description=$request->description;
        $crime->policeView=$request->policeView;
        $crime->citizenView=$request->citizenView;

        $crime->save();

        return redirect()->back();

    }

    public function viewCrimeTypeList(){
        $crimeTypeList=db::table('crime_categories')->get();
        return view('admin.crimeTypeList',compact('crimeTypeList'));
    }

    public function deleteCrimeType(Request $request)
    {
        $crimeTypeList = db::table('crime_categories')->where('id', $request->crimeIdTemp)->delete();

        if ($crimeTypeList) {
            return redirect('/admin');
        }
    }

    public function updateViewCrimeType(Request $request){

        $crimeTypeList = db::table('crime_categories')->where('id',$request->crimeIdTemp)->First();
        $crimeCategoryList = db::table('crime_categories')->get();
        return view('admin.updateCrimeTypeForm',compact('crimeTypeList','crimeCategoryList'));
    }

    public function updateCrimeType(Request $request){
        $result=DB::table('crime_categories')
            ->where('id',$request->crimeIdTemp)
            ->update(['crimeType'=>$request->crimeType,'categoryType'=>$request->categoryType,'description'=>$request->description,'policeView'=>$request->policeView,'citizenView'=>$request->citizenView]);
        if($result){
            $crimeTypeList=db::table('crime_categories')->get();
            return view('admin.crimeTypeList',compact('crimeTypeList'));

        }
        else{
            return redirect('/admin');
        }
    }

    public function updateRankFormView(Request $request){

        $dataSystemRole = db::table('data_entries')->where('dataType',"systemRole")->get();
        $dataOfficerRank = db::table('data_entries')->where('dataType',"officerRank")->get();
        $dataPoliceOffice = db::table('police_offices')->get();
        $policeOfficer = db::table('users')->where('nic',$request->nic)->First();
        return view('admin.updateRank',compact('policeOfficer','dataOfficerRank','dataSystemRole','dataPoliceOffice'));

    }

    public function updateRank(Request $request){
        $result=DB::table('users')
            ->where('nic',$request->nic)
            ->update(['role'=>$request->role,'profession'=>$request->officerRank,'policeOffice'=>$request->policeOffice]);
        if($result){
            $policeOfficer=db::table('users')->get();
            return view('admin.index',compact('policeOfficer'));

        }
        else{
            return redirect('/admin');
        }
    }

    public function viewPoliceOfficesList(){
        $policeOfficesList=db::table('police_offices')->get();
        return view('admin.policeOfficesList',compact('policeOfficesList'));
    }
    public function deletePoliceOffices(Request $request)
    {
        $policeOfficesList = db::table('police_offices')->where('id', $request->id)->delete();

        if ($policeOfficesList) {
            return redirect('/admin');
        }
    }
}
