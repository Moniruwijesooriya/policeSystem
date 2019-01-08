<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BOICController extends Controller
{
    public function __construct()
    {
        $this->middleware('boic');
    }

    public function index(){
        return view('boic.boicHome');
    }
    public function boicPasswordChange(Request $request){
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
            return view('boic.boicProfileForm',compact('oicDetails'));

        }
    }

    public function boicProfileFormView(){
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('boic.boicProfileForm',compact('oicDetails','branches'));
    }
    public function boicProfileUpdate(Request $request)
    {

        $result= DB::table('users')

            ->where('nic', $request->nic)
            ->update(['address' => $request->homeAddress, 'mobileNumber' => $request->mobNumber, 'landLineNumber' => $request->landNumber, 'email' => $request->email]);
        if($result){
            $nic=Auth::User()->nic;
            $oicDetails = db::table('users')->where('nic',$nic)->First();
            $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            return view('boic.boicProfileForm',compact('oicDetails','branches'));

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
        return view('boic.changeBOICPasswordForm',compact('oicDetails','branches'));
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

    public function entryBOICAction(Request $request){

        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $statusType=$request->statusType;
        if($statusType=="new"){
            //initial entry progress when submitting the entry
            $citizenNIC=$request->complainantNIC;
            $userInfo = db::table('users')->where('nic',$citizenNIC)->First();
            $email=$userInfo->email;


            $progress=new EntryProgress();
            $progress->entryID=$request->entryID;
            $progress->progress=$request->initialProgress;
            $progress->policeOfficerName=$user->name;
            $progress->officerNic=$user->nic;
            $progress->rank=$user->profession;
            $progress->policeOffice=$user->policeOffice;
            $progress->role=$user->role;
            $progress->citizenView="Yes";
            $progress->policeView="Yes";
            $progress->save();

            //entry progress when oic forward the entry to the branch
            $progress=new EntryProgress();
            $progress->entryID=$request->entryID;
            $progress->policeOfficerName=$user->name;
            $progress->officerNic=$user->nic;
            $progress->rank=$user->profession;
            $progress->policeOffice=$user->policeOffice;
            $progress->role=$user->role;
            $progress->progress="Entry is forwarded to the $request->branch of $request->policeStation";
            $progress->citizenView="No";
            $progress->policeView="Yes";
            $progress->save();

            $progress=new EntryProgress();
            $progress->entryID=$request->entryID;
            $progress->policeOfficerName=$user->name;
            $progress->officerNic=$user->nic;
            $progress->rank=$user->profession;
            $progress->policeOffice=$user->policeOffice;
            $progress->role=$user->role;
            $progress->progress="Entry is accepted and Forwarded to the relevant section.";
            $progress->citizenView="Yes";
            $progress->policeView="Yes";
            $progress->save();

            if($request->evidence!=null){
                $evidence=new Evidence();
                $evidence->entryID=$request->entryID;
                $evidence->witnessId=Auth::User()->nic;
                $evidence->evidence_txt=$request->evidence;
                if ($request->evidenceCitizenView=="Yes"){
                    $evidence->citizenView="Yes";
                }
                else{
                    $evidence->citizenView="No";
                }
                $evidence->policeView="Yes";
                $evidence->save();

            }
            if ($request->hasFile('evidenceImage')){

                $files=$request->file('evidenceImage');
                $folderName=$request->entryID;

                $dt = Carbon::now();
                $newdatez=str_replace(':',"-",$dt);
                $i=1;
                foreach($files as $file) {
                    $fileExtension=$file->getClientOriginalExtension();
                    $fileNewName=$i.".".$fileExtension;
                    $file->move(
                        base_path() . "/public/evidences/$folderName/$newdatez",$fileNewName
                    );
                    $i += 1;
                }
                $evidence=new Evidence();
                $evidence->entryID=$request->entryID;
                $evidence->witnessId=Auth::User()->nic;
                $evidence->evidence_txt="Image Evidence";
                $evidence->evidence_image_count=$i;
                if ($request->evidenceImageCitizenView=="Yes"){
                    $evidence->citizenView="Yes";
                }
                else{
                    $evidence->citizenView="No";
                }
                $evidence->policeView="Yes";
                $evidence->evidence_image=$newdatez;
                $evidence->save();
            }else{
                if($request->suspects!=null){
                    $suspects=new Suspect();
                    $suspects->entryID=$request->entryID;
                    $suspects->name=$request->suspects;
                    $suspects->userName=$user->name;
                    $suspects->userNic=$nic;
                    $suspects->userRole=$user->role;
                    if ($request->suspectCitizenView=="Yes"){
                        $suspects->citizenView="Yes";
                    }
                    else{
                        $suspects->citizenView="No";
                    }
                    $suspects->policeView="Yes";
                    $suspects->save();
                }

                if($request->entryProgress!=null){
                    $progress=new EntryProgress();
                    $progress->entryID=$request->entryID;
                    $progress->progress=$request->entryProgress;
                    $progress->policeOfficerName=$user->name;
                    $progress->officerNic=$user->nic;
                    $progress->rank=$user->profession;
                    $progress->policeOffice=$user->policeOffice;
                    $progress->role=$user->role;
                    if ($request->progressCitizenView=="Yes"){
                        $progress->citizenView="Yes";
                    }
                    else{
                        $progress->citizenView="No";
                    }
                    $progress->policeView="Yes";

                    $progress->save();

                }
            }

            $branchTemp=db::table('police_offices')->where('policeOfficeType',"Branch Police Office")->where('headPoliceOffice',$request->policeStation)->where('policeOfficeArea',$request->branch)->First();

//            DB::table('entries')
//                ->where('entryID',$request->entryID)
//                ->update(['oicNotification'=>"n",'boicNotification'=>"y",'status'=>"ongoing",'branch'=>$branchTemp->id]);

            $data = array(
                'heading'=>"Weclome to Crime Reporting System..",
                'entryAccept'=>"Your Entry was accepted by the Officer Incharge of ".$user->policeOffice,
                'entryID'=> "Entry ID : ".$request->entryID,
                'complaint'=>"Complaint : ".$request->complaint,
                'messageToCitizen1'=>"Your entry will be investigated by the relevant police branch.",
                'messageToCitizen2'=>"If you have any evidences and suspects please submit",
                'thank'=>"Thank You!");

            Mail::send(['text'=>'sendEmail.entryAcceptEmail'], $data, function($message) use($email) {
                $message->to($email)->subject
                ('Entry Accepted');
                $message->from('slpolicesystem@gmail.com','SL Police');
            });
        }
        else if($statusType=="ongoing"){
            if($request->ongoingSubmit=="Close Entry"){
                DB::table('entries')
                    ->where('entryID',$request->entryID)
                    ->update(['status'=>"closed"]);
                $nic=Auth::User()->nic;
                $entries=db::table('entries')->where('status',"ongoing")->get();
                $type="Closed Entries";
                $oicDetails = db::table('users')->where('nic',$nic)->First();
                $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
            }
            $type="Ongoing Entries";

            if($request->evidence!=null){
                $evidence=new Evidence();
                $evidence->entryID=$request->entryID;
                $evidence->witnessId=Auth::User()->nic;
                $evidence->evidence_txt=$request->evidence;
                if ($request->evidenceCitizenView=="Yes"){
                    $evidence->citizenView="Yes";
                }
                else{
                    $evidence->citizenView="No";
                }
                $evidence->policeView="Yes";
                $evidence->save();

            }
            if ($request->hasFile('evidenceImage')){

                $files=$request->file('evidenceImage');
                $folderName=$request->entryID;

                $dt = Carbon::now();
                $newdatez=str_replace(':',"-",$dt);
                $i=1;
                foreach($files as $file) {
                    $fileExtension=$file->getClientOriginalExtension();
                    $fileNewName=$i.".".$fileExtension;
                    echo $fileExtension;
                    echo $fileNewName;
                    $file->move(
                        base_path() . "/public/evidences/$folderName/$newdatez",$fileNewName
                    );
                    $i += 1;
                }
                $evidence=new Evidence();
                $evidence->entryID=$request->entryID;
                $evidence->witnessId=Auth::User()->nic;
                $evidence->evidence_txt="Image Evidence";
                $evidence->evidence_image_count=$i;
                if ($request->evidenceImageCitizenView=="Yes"){
                    $evidence->citizenView="Yes";
                }
                else{
                    $evidence->citizenView="No";
                }
                $evidence->policeView="Yes";
                $evidence->evidence_image=$newdatez;
                $evidence->save();
            }else{
                if($request->suspects!=null){
                    $suspects=new Suspect();
                    $suspects->entryID=$request->entryID;
                    $suspects->name=$request->suspects;
                    $suspects->userName=$user->name;
                    $suspects->userNic=$nic;
                    $suspects->userRole=$user->role;
                    if ($request->suspectCitizenView=="Yes"){
                        $suspects->citizenView="Yes";
                    }
                    else{
                        $suspects->citizenView="No";
                    }
                    $suspects->policeView="Yes";
                    $suspects->save();
                }

                if($request->entryProgress!=null){
                    $progress=new EntryProgress();
                    $progress->entryID=$request->entryID;
                    $progress->progress=$request->entryProgress;
                    $progress->policeOfficerName=$user->name;
                    $progress->officerNic=$user->nic;
                    $progress->rank=$user->profession;
                    $progress->policeOffice=$user->policeOffice;
                    $progress->role=$user->role;
                    if ($request->progressCitizenView=="Yes"){
                        $progress->citizenView="Yes";
                    }
                    else{
                        $progress->citizenView="No";
                    }
                    $progress->policeView="Yes";

                    $progress->save();

                }
            }
        }




        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('policeView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('policeView',"Yes")->get();
        $entryProgresses=db::table('entry_progresses')->where('entryID',$request->entryID)->get();
        $currentBranch=db::table('entries')->where('branch',$entry->branch)->First();
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('oic/entryView',compact('entry','evidences','suspects','entryProgresses','branches','oicDetails','currentBranch'));
    }
}
