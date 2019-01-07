<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;
use function PHPSTORM_META\elementType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\citizenRegistrationValidation;


class CitizenController extends Controller
{


//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//
//            'email' => 'required|email|max:255|unique:users,email',
////            'password' => 'required|string|min:6|confirmed',
////            'role' => 'required|string|max:50',
//
//        ]);
//    }


    public function registerCitizen(citizenRegistrationValidation $request)
    {

//        dd($request->email,$request->password,$request->nic,$request->password_confirmation);

        if ($request->hasFile('profileImage')){

            $files=$request->file('profileImage');
            $fileExtension=$files->getClientOriginalExtension();
            $filename = $request->nic.".".$fileExtension;

            $request->file('profileImage')->move(
                base_path() . '/public/userProfileImages/',$filename
            );
        }else{

        }

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
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('oic/reviewRequest',compact('citizenDetails','branches','oicDetails'));
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

            ->update(['address'=>$request->homeAddress,'policeOffice'=>$request->policeStation,'mobileNumber'=>$request->mobNumber,'profession'=>$request->profession,'landLineNumber'=>$request->landNumber,'email'=>$request->email]);

        Session::flash('updateCitizen','Updated successfully!');//if
//
//        Session::flash('msg2','Updated failed!');//else
        $nic=Auth::User()->nic;
        $citizenDetails = db::table('users')->where('nic',$nic)->First();
        $crimeCategories = db::table('crime_categories')->where('citizenView',"Yes")->get();

        return view('registeredCitizen.index',compact('message','citizenDetails','crimeCategories'));

            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function deactivateCitizenForm(){
        $nic = Auth::User()->nic;
        $citizenDetails = db::table('users')->where('nic',$nic)->First();
        return view('registeredCitizen.deactivateCitizenForm',compact('citizenDetails'));
    }

    public function citizenAccountDeactivate(Request $request)
    {
        $userpassword=$request->password;
        $citizen = db::table('users')->where('nic',$request->nic)->first();
        if (Hash::check($userpassword,$citizen->password)){
            DB::table('users')->where('nic',$request->nic)->delete();
            return redirect('/');
        }
        else{
            return redirect('/RegisteredCitizen');
        }

    }

    public function citizenPasswordChange(Request $request){
        $currentpassword=$request->currentpassword;
        $newpassword=$request->newpassword;
        $confirmpassword=$request->confirmpassword;


        $citizenDetails = db::table('users')->where('nic',$request->nic)->First();

            Session::flash('CitizenPasswordUpdate','password is updated successfully!');

        if(Hash::check($currentpassword,$citizenDetails->password) && $newpassword == $confirmpassword){
            DB::table('users')
                ->where('nic',$request->nic)
                ->update(['password'=>Hash::make($request->newpassword)]);
            return redirect('/RegisteredCitizen');
        }

    }
    public function submitCrimeEntryForm(){
        $crimeCategories = db::table('crime_categories')->where('citizenView',"Yes")->get();
        return view('registeredCitizen.submitCrimeEntryForm',compact('crimeCategories'));
    }
    public function citizenProfileFormView(){
        $nic = Auth::User()->nic;
        $citizenDetails = db::table('users')->where('nic',$nic)->First();
        return view('registeredCitizen.citizenProfileForm',compact('citizenDetails'));
    }

    public function changePasswordFormView(){
        $nic = Auth::User()->nic;
        $citizenDetails = db::table('users')->where('nic',$nic)->First();
        return view('registeredCitizen.changePasswordForm',compact('citizenDetails'));
    }



}
