<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\CitizenRegistrationNotif;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Facades\Auth;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('citizen');
    }
    public function index()
    {
        $citizenDetails = db::table('users')->where('nic',$nic)->First();
        return view('registeredCitizen.index',compact('citizenDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerCitizen(Request $request)
    {
        $citizen = new User();
        $citizen->name = $request->name;
        $citizen->nic = $request->nic;
        $citizen->address = $request->homeAddress;
        $citizen->mobileNumber = $request->mobNumber;
        $citizen->landLineNumber = $request->landNumber;
        $citizen->profession = $request->profession;
        $citizen->email = $request->email;
        $citizen->gender = $request->gender;
        $citizen->dob = $request->dob;
        $citizen->role = "citizen";
        $citizen->remember_token = str_random(60);
        $citizen->token=str_random(25);
        $citizen->password = Hash::make($request->password);
        $citizen->verified = "No";
        $citizen->fullName=$request->fullName;
        $citizen->policeOffice=$request->policeStation;


        $em=$request->email;
        $data = array('heading'=>"Welcome to Crime Reporting System",'fullName'=>"Full Name: ".$request->fullName,'name'=>
            "Name with initials: ".$request->name,'nic'=>"NIC: ".$request->nic,
            'msg'=>"Complete your Registration at $request->policeStation by showing NIC",'thank'=>"Thank You!"
        );


        Mail::send(['text'=>'mail'], $data, function($message) use ($em) {
            $message->to($em)->subject
            ('SL Police System Citizen Registration');
            $message->from('slpolicesystem@gmail.com','SL Police');
        });
        $citizen->save();
        $citizen->sendEmailVerificationNotification();
        return redirect(('/'));
    }


    public function ViewRequest(Request $request){
        $citizenDetails = db::table('users')->where('nic',$request->nic)->First();
        return view('oic/reviewRequest',compact('citizenDetails'));
    }

    //updateFormView
    public function updateFormView(Request $request)
    {
        $citizenDetails = db::table('users')->where('nic',$request->nic)->First();
        return view('auth/update',compact('citizenDetails'));
    }

    public function AcceptCitizenRequest(Request $request){

        if ($request->verify=="Yes"){
            DB::table('users')
                ->where('nic',$request->nic)
                ->update(['verified'=>$request->verify]);
            return redirect('/OIC');
        }
        else{
            DB::table('users')->where('nic',$request->nic)->delete();
            return redirect('/OIC');
        }


    }

public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
