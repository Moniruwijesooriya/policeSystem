<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use function PHPSTORM_META\elementType;


class CitizenController extends Controller
{

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
        $citizen->civilStatus = $request->civilStatus;
        $citizen->remember_token = str_random(60);
        $citizen->token=str_random(25);
        $citizen->password = Hash::make($request->password);
        $citizen->verified = "No";
        $citizen->fullName=$request->fullName;
        $citizen->policeOffice=$request->policeStation;

        $citizen->save();
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
        $citizen->sendEmailVerificationNotification();
        return redirect(('/'));
    }


    public function ViewRequest(Request $request){
        $citizenDetails = db::table('users')->where('nic',$request->nic)->First();
        return view('oic/reviewRequest',compact('citizenDetails'));
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $citizen=User::find($id);
        return view('auth.update')->with($citizen,'citizen');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function citizenInfoUpdate(Request $request)
    {
        DB::table('users')
            ->where('nic',$request->nic)
            ->update(['email_verified_at'=>Null,'verified'=>'No','address'=>$request->homeAddress,'policeOffice'=>$request->policeStation,'mobileNumber'=>$request->mobNumber,'landLineNumber'=>$request->landNumber,'email'=>$request->email]);
        return redirect('/RegisteredCitizen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function citizenAccountDeactivate(Request $request)
    {
        $userpassword=Hash::make("123123");
        $xuserpassword=Hash::make("123123");
        $citizenDetails = db::table('users')->where('nic',$request->nic)->First();
        if ($xuserpassword==$userpassword){
            DB::table('users')->where('nic',$request->nic)->delete();
            return redirect('/');
        }
        else{
            return redirect('/RegisteredCitizen');
        }

    }

    public function citizenPasswordChange(Request $request){
        $currentpassword=Hash::make($request->currentpassword);
        $newpassword=Hash::make($request->newpassword);
        $confirmpassword=Hash::make($request->confirmpassword);


        $citizenDetails = db::table('users')->where('nic',$request->nic)->First();


    }

}
