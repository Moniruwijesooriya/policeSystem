<?php

namespace App\Http\Controllers;

use App\CrimeCategories;
use App\Http\Requests\RegistrationValidation;
use App\PoliceOffice;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    public function __construct()
    {

        $this->middleware('admin');
    }

    public function index(){

        $policeStationOffices = db::table('police_offices')->where('policeOfficeType',"Police Station")->get();
        $branchPoliceOffices = db::table('police_offices')->where('policeOfficeType',"Branch Police Office")->get();
        $divisionPoliceOffices = db::table('police_offices')->where('policeOfficeType',"Division Police Office")->get();

        //return view('admin.temp',compact('divisionPoliceOffices','policeStationOffices','branchPoliceOffices'));

        //return view('admin.index',compact('divisionPoliceOffices','policeStationOffices','branchPoliceOffices'));
        return view('admin.adminHome',compact('divisionPoliceOffices','policeStationOffices','branchPoliceOffices'));

    }
    public function registerPoliceOfficer(RegistrationValidation $request){

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
        if ($request->hasFile('profileImage')){

            $files=$request->file('profileImage');
//            $fileExtension=$files->getClientOriginalExtension();
            $filename = $request->nic.".jpg";

            $request->file('profileImage')->move(
                base_path() . '/public/userProfileImages/',$filename
            );
        }else{

        }

        if($request->officeNameTemp=="Inspector General of Police Office"){

            $policeOfficer->policeOffice=$request->igpPoliceOffice;

            DB::table('police_offices')
                ->where('OfficeName',$request->igpPoliceOffice)
                ->update(['mainOfficer'=>$request->nic]);

        }
        elseif ($request->officeNameTemp=="Division Police Office"){
            $policeOfficer->policeOffice=$request->doigPoliceOffice;

            DB::table('police_offices')
                ->where('OfficeName',$request->doigPoliceOffice)
                ->update(['mainOfficer'=>$request->nic]);
        }
        elseif ($request->officeNameTemp=="Police Station"){
            $policeOfficer->policeOffice=$request->oicPoliceOffice;

            DB::table('police_offices')
                ->where('OfficeName',$request->oicPoliceOffice)
                ->update(['mainOfficer'=>$request->nic]);
        }
        elseif ($request->officeNameTemp=="Branch Police Office"){
            $policeOfficer->policeOffice=$request->boicPoliceOffice;

            DB::table('police_offices')
                ->where('OfficeName',$request->boicPoliceOffice)
                ->update(['mainOfficer'=>$request->nic]);
        }

        $policeOfficer->remember_token=str_random(60);
        $randomPassword="123123";
        $randomPasswords=str_random(10);
        $policeOfficer->password=Hash::make($randomPassword);
        $policeOfficer->verified="Yes";
        $policeOfficer->token=str_random(25);
        $policeOfficer->fullName=$request->fullName;
        $email=$request->email;
        $policeOfficer->save();

        DB::table('police_offices')
            ->where('OfficeName',$request->policeOffice)
            ->update(['mainOfficer'=>$request->nic]);

        $data = array('heading'=>"Weclome to Crime Reporting System",'fullName'=>"Full Name: ".$request->fullName,'name'=>
            "Name with initials: ".$request->name,'thank'=>"Thank You!",
            'nic'=>"NIC : ".$request->nic,
            'msg'=>"Your account is successfully created. A random password is provided and please change it.",'randomPassword'=>"Your random password: ".$randomPasswords);

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

//    public function removePoliceOfficer(Request $request)
//    {
//        $res = db::table('users')->where('nic', $request->nic)->delete();
//
//        if ($res) {
//            return redirect('/admin');
//        }
//    }

    public function registerPoliceOffice(Request $request){
        $policeOffice=new PoliceOffice();
        $policeOffice->district=$request->district;
        $policeOffice->policeOfficeArea=$request-> policeOfficeArea;
        $policeOffice->policeOfficeType=$request->policeOfficeType;
        $policeOffice->landNumber=$request->landNumber;
        $area=$request-> policeOfficeArea;
        $type=$request->policeOfficeType;
        if ($type=="Branch Police Office"){
            $policeStationArea=$request->headPoliceOffice;
            $officeName=$policeStationArea." ".$area." ".$type;
        }
        else{
            $officeName=$area." ".$type;
        }

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

    public function updatePoliceOfficerFormView(Request $request){

        $dataSystemRole = db::table('data_entries')->where('dataType',"systemRole")->get();
        $dataOfficerRank = db::table('data_entries')->where('dataType',"officerRank")->get();
        $dataPoliceOffice = db::table('police_offices')->get();
        $policeOfficer = db::table('users')->where('nic',$request->policeOfficer)->First();
        return view('admin.updateRank',compact('policeOfficer','dataOfficerRank','dataSystemRole','dataPoliceOffice'));

    }

    public function updatePoliceOfficer(Request $request){
        $result=DB::table('users')
            ->where('nic',$request->nic)
            ->update(['role'=>$request->role,'profession'=>$request->officerRank,'policeOffice'=>$request->policeOffice]);
        if($result){
            $policeOfficersList=db::table('users')->where("role" , "Branch Officer Incharge")->orWhere('role' , "Division Officer Incharge")->orWhere('role' , "Inspector General of Police")->orWhere('role' , "Officer Incharge of Police Station")->get();
            return view('admin.policeOfficersList',compact('policeOfficersList'));

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
        $policeOfficesList = db::table('police_offices')->where('id', $request->policeOfficeID)->delete();

        if ($policeOfficesList) {
            return redirect('/admin');
        }
    }

    public function viewIGPRegisterForm(){
        return view('admin.igpRegister');
    }
    public function viewDORegisterForm(){
        return view('admin.divisionOfficeRegister');
    }
    public function viewPSRegisterForm(){
        $divisionPoliceOffices = db::table('police_offices')->where('policeOfficeType',"Division Police Office")->get();
        return view('admin.policeStationRegister',compact('divisionPoliceOffices'));
    }
    public function viewBORegisterForm(){
        $policeStationOffices = db::table('police_offices')->where('policeOfficeType',"Police Station")->get();
        return view('admin.branchOfficeRegister',compact('policeStationOffices'));
    }
    public function viewAddCrimeTypeForm(){
        return view('admin.addCrimeTypeForm');
    }
    public function viewregisterPoliceOfficerForm(){
        $policeStationOffices = db::table('police_offices')->where('policeOfficeType',"Police Station")->get();
        $branchPoliceOffices = db::table('police_offices')->where('policeOfficeType',"Branch Police Office")->get();
        $divisionPoliceOffices = db::table('police_offices')->where('policeOfficeType',"Division Police Office")->get();
        //return view('admin.index',compact('divisionPoliceOffices','policeStationOffices','branchPoliceOffices'));
        return view('admin.registerPoliceOfficerForm',compact('divisionPoliceOffices','policeStationOffices','branchPoliceOffices'));

    }


    public function viewRegisterLTE(){
        return view('admin.temp');
    }


    public function updatePoliceOfficesFormView(Request $request){

        $policeOffice = db::table('police_offices')->where('id',$request->policeOfficeID)->First();
        return view('admin.updatePoliceOfficesForm',compact('policeOffice'));
    }

    public function updatePoliceOffices(Request $request){
        $result=DB::table('police_offices')
            ->where('id',$request->policeOfficeID)
            ->update(['landNumber'=>$request->landNumber]);
        if($result){
            $policeOfficesList=db::table('police_offices')->get();
            return view('admin.policeOfficesList',compact('policeOfficesList'));

        }
        else{
            return redirect('/admin');
        }
    }
    public function viewPoliceOfficersList(){
        $policeOfficersList=db::table('users')->where("role" , "Branch Officer Incharge")->orWhere('role' , "Division Officer Incharge")->orWhere('role' , "Inspector General of Police")->orWhere('role' , "Officer Incharge of Police Station")->get();
        return view('admin.policeOfficersList',compact('policeOfficersList'));
    }

    public function removePoliceOfficer(Request $request)
    {
        $res = db::table('users')->where('nic', $request->policeOfficer)->delete();

        if ($res) {
            $policeOfficersList=db::table('users')->where("role" , "Branch Officer Incharge")->orWhere('role' , "Division Officer Incharge")->orWhere('role' , "Inspector General of Police")->orWhere('role' , "Officer Incharge of Police Station")->get();
            return view('admin.policeOfficersList',compact('policeOfficersList'));
        }
        else{
            return redirect('/admin');
        }
    }

    public function adminProfileFormView(){
        $nic = Auth::User()->nic;
        $citizenDetails = db::table('users')->where('nic',$nic)->First();
        return view('admin.adminProfileForm',compact('citizenDetails'));
    }

    public function deactivateAdminFormView(){
        $nic = Auth::User()->nic;
        $citizenDetails = db::table('users')->where('nic',$nic)->First();
        return view('admin.deactivateAdminForm',compact('citizenDetails'));
    }

    public function adminInfoUpdate(Request $request)
    {

        DB::table('users')
            ->where('nic',$request->nic)

            ->update(['address'=>$request->homeAddress,'mobileNumber'=>$request->mobNumber,'landLineNumber'=>$request->landNumber,'email'=>$request->email]);

//        Session::flash('updateCitizen','Updated successfully!');//if
//
//        Session::flash('msg2','Updated failed!');//else
        $nic=Auth::User()->nic;
        $citizenDetails = db::table('users')->where('nic',$nic)->First();
        $crimeCategories = db::table('crime_categories')->where('citizenView',"Yes")->get();

        return view('admin.adminProfileForm',compact('message','citizenDetails','crimeCategories'));


    }
    public function adminAccountDeactivate(Request $request)
    {
        $userpassword = $request->password;
        $citizen = db::table('users')->where('nic', $request->nic)->first();
        if (Hash::check($userpassword, $citizen->password)) {
            DB::table('users')->where('nic', $request->nic)->delete();
            return redirect('/');
        } else {
            return redirect('/RegisteredCitizen');
        }
    }
    public function changeAdminPasswordFormView(){
        $nic = Auth::User()->nic;
        $citizenDetails = db::table('users')->where('nic',$nic)->First();
        return view('admin.changeAdminPasswordFormView',compact('citizenDetails'));
    }
    public function adminPasswordChange(Request $request){
        $currentpassword=$request->currentpassword;
        $newpassword=$request->newpassword;
        $confirmpassword=$request->confirmpassword;


        $citizenDetails = db::table('users')->where('nic',$request->nic)->First();

        Session::flash('CitizenPasswordUpdate','password is updated successfully!');

        if(Hash::check($currentpassword,$citizenDetails->password) && $newpassword == $confirmpassword){
            DB::table('users')
                ->where('nic',$request->nic)
                ->update(['password'=>Hash::make($request->newpassword)]);
            return redirect('/admin');
        }

    }
}
