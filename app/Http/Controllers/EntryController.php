<?php

namespace App\Http\Controllers;

use App\CrimeEntrySubmitNotification;
use App\Entry;
use App\EntryProgress;
use App\Evidence;
use App\Suspect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;


class EntryController extends Controller
{

    /**
     *
     * SUBMIT CRIME ENTRY FUNCTION
     *
     */
    //    Controller to submit the entries of the citizen
    public function submitEntry(Request $request){

        $policeStationTemp=$request->policeStation." Police Station";
        $divisionOffice=db::table('police_offices')->where('OfficeName',$policeStationTemp)->First();
        $crimeEntry=new Entry();
        $crimeEntry->complaintCategory=$request->complaintCategory;
        $crimeEntry->complaint=$request-> complaintText;
        $crimeEntry->district=$request->district;
        $crimeEntry->nearestPoliceStation=$request->policeStation." Police Station";
        $crimeEntry->complainantID=Auth::User()->nic;
        $crimeEntry->policeDivisionOffice=$divisionOffice->headPoliceOffice;
        $crimeEntry->oicNotification="y";
        $crimeEntry->boicNotification="n";
        $crimeEntry->doigNotification="n";
        $crimeEntry->igpNotification="n";
        $crimeEntry->citizenNotification="n";
        $crimeEntry->status="new";
        $crimeEntry->progress="Entry is submitted to the ".$request->policeStation;
        $crimeEntry->suspects=$request->suspects;
        $crimeEntry->evidences=$request->evidences;

        $entrySuccess="Successfully Submitted!";
        $crimeEntry->save();

        $entry=db::table('entries')->where('complainantID',Auth::User()->nic)->latest()->first();
        $evidences=db::table('evidence')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('userRole',"citizen")->get();
        $entry_progress=db::table('entry_progresses')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();

        $email=Auth::User()->email;
        $data = array('heading'=>"Weclome to Crime Reporting System",
            'submitNotice'=>"Your Complaint is succesfully  submitted to the ".$request->policeStation." Police Station",
            'thank'=>"Thank You!",
            );

        Mail::send(['text'=>'sendEmail.submitEntryEmail'], $data, function($message) use($email) {
            $message->to($email)->subject
            ('SL Police System Registration');
            $message->from('slpolicesystem@gmail.com','SL Police');
        });
        return view('registeredCitizen/citizenEntryView',compact('entry','evidences','suspects','entry_progress','entrySuccess'));

    }

    //    Controller for the actions of the OIC according to the status of the entry
    public function entryOICAction(Request $request){

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
            $progress->progress="Entry is forwarded to the $request->branch branch of $request->policeStation";
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
            $progress->policeView="No";
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

            DB::table('entries')
                ->where('entryID',$request->entryID)
                ->update(['oicNotification'=>"n",'boicNotification'=>"y",'status'=>"ongoing",'branch'=>$branchTemp->id]);

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

                $progress=new EntryProgress();
                $progress->entryID=$request->entryID;
                $progress->policeOfficerName=$user->name;
                $progress->officerNic=$user->nic;
                $progress->rank=$user->profession;
                $progress->policeOffice=$user->policeOffice;
                $progress->role=$user->role;
                $progress->progress="Investigation is over and the entry is solved.";
                $progress->citizenView="Yes";
                $progress->policeView="Yes";
                $progress->save();
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
            }
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

        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('policeView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('policeView',"Yes")->get();
        $entryProgresses=db::table('entry_progresses')->where('policeView',"Yes")->where('entryID',$request->entryID)->get();
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        $currentBranch=db::table('police_offices')->where('id',$entry->branch)->First();

        return view('oic/entryView',compact('entry','evidences','suspects','entryProgresses','branches','oicDetails','currentBranch'));
    }




    //    Controller for the branch officer to take actions for the entry according to the entry

    public function entryBOICAction(Request $request){

        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $statusType=$request->statusType;
        if($statusType=="y"){

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

            //entry progress when boic accept the entry

            $progress=new EntryProgress();
            $progress->entryID=$request->entryID;
            $progress->policeOfficerName=$user->name;
            $progress->officerNic=$user->nic;
            $progress->rank=$user->profession;
            $progress->policeOffice=$user->policeOffice;
            $progress->role=$user->role;
            $progress->progress="Entry is accepted by the $request->branch branch of $request->policeStation.";
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

            $branchTemp=db::table('police_offices')->where('id',$request->branchID)->First();

            DB::table('entries')
               ->where('entryID',$request->entryID)
                ->update(['boicNotification'=>"y o"]);

        }
        else if($statusType=="y o"){

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
                    $fileNewName=$i.".jpg";

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
            }

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

        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('policeView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('policeView',"Yes")->get();
        $entryProgresses=db::table('entry_progresses')->where('entryID',$request->entryID)->get();
        $boicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$boicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        $currentBranch=db::table('police_offices')->where('id',$request->branchID)->First();
        return view('boic/entryView',compact('entry','evidences','suspects','entryProgresses','branches','boicDetails','currentBranch'));
    }




    //    Controller to view the entry by the OIC

    public function viewOICEntry(Request $request){
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();


        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('policeView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('policeView',"Yes")->get();
        $entryProgresses=db::table('entry_progresses')->where('entryID',$request->entryID)->where('policeView',"Yes")->get();
        $currentBranch=db::table('police_offices')->where('id',$entry->branch)->First();
        return view('oic/entryView',compact('entry','evidences','suspects','entryProgresses','oicDetails','branches','currentBranch'));
    }

    //    Controller to view the list of new entries by the OIC
    public function viewOICNewEntries(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $entries=db::table('entries')->where('oicNotification',"y")->where('nearestPoliceStation',$user->policeOffice)->get();
        $type="New Entries";
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('oic.entryList',compact('entries','type','oicDetails','branches'));
    }

    //    Controller to view the list of ongoing entries by the OIC
    public function viewOICOngoingEntries(){

        $nic=Auth::User()->nic;
        $entries=db::table('entries')->where('status',"ongoing")->get();
        $type="Ongoing Entries";
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('oic.entryList',compact('entries','type','oicDetails','branches'));
    }

    //    Controller to view the list of closed entries by the OIC
    public function viewOICClosedEntries(){
        $nic=Auth::User()->nic;
        $entries=db::table('entries')->where('status',"closed")->get();
        $type="Closed Entries";
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('oic.entryList',compact('entries','type','oicDetails','branches'));
    }

    //    Controller to view the entry by the Branch officer
    public function viewBOICEntry(Request $request){
        $nic=Auth::User()->nic;
        $boicDetails = db::table('users')->where('nic',$nic)->First();

        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('policeView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('policeView',"Yes")->get();
        $entryProgresses=db::table('entry_progresses')->where('entryID',$request->entryID)->get();
        $currentBranch=db::table('police_offices')->where('id',$entry->branch)->First();

        return view('boic/entryView',compact('entry','evidences','suspects','entryProgresses','boicDetails','branches','currentBranch'));
    }

    //    Controller to view the list of new entries by the branch officer
    public function viewBOICNewEntries(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $boicPoliceOffice=db::table('police_offices')->where('OfficeName',$user->policeOffice)->first();
        $type="New Entries";
        $boicDetails = db::table('users')->where('nic',$nic)->First();
        $entries=db::table('entries')->where('boicNotification',"y")->where('status',"new")->where('branch',$boicPoliceOffice->id)->get();
        return view('boic.entryList',compact('entries','type','boicDetails','branches'));
    }

    //    Controller to view the list of ongoing entries by the branch officer
    public function viewBOICOngoingEntries(){

        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $boicPoliceOffice=db::table('police_offices')->where('OfficeName',$user->policeOffice)->first();
        $type="Ongoing Entries";
        $boicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$boicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        $entries=db::table('entries')->where('boicNotification',"y o")->where('status',"ongoing")->where('branch',$boicPoliceOffice->id)->get();

        return view('boic.entryList',compact('entries','type','boicDetails','branches'));
    }

    //    Controller to view the list of closed entries by the branch officer
    public function viewBOICClosedEntries(){
        $nic=Auth::User()->nic;
        $entries=db::table('entries')->where('status',"closed")->get();
        $type="Closed Entries";
        $boicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$boicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('boic.entryList',compact('entries','type','boicDetails','branches'));
    }

    //    Controller to get the user info when the nic is given. Ajax function
    public function getUserInfo(Request $request){
        $userInfo=db::table('users')->where('nic',$request->id)->First();
        return response()->json($userInfo);
    }

    //    Controller to get the removed user info when the nic is given. Ajax function
    public function getRemovedUserInfo(Request $request){
        $userInfo=db::table('removed_users')->where('nic',$request->id)->First();
        return response()->json(($userInfo));
    }

    //    Controller to accept the entry by the branch officer when oic forward the entry to the branch
    public function acceptBOICEntry(Request $request){

        DB::table('entries')
            ->where('entryID',$request->entryId)
            ->update(['boicNotification'=>"n",'suspects'=>$request->suspects,'branch'=>$request->branch,'progress'=>$request->progress]);
        return redirect('/BOIC');
    }

    //    Controller to view the entry by the citizen
    public function viewCitizenEntry(Request $request){
        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $entry_progress=db::table('entry_progresses')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();
        $evidences=db::table('evidence')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();
        return view('registeredCitizen/citizenEntryView',compact('entry','evidences','suspects','entry_progress'));
    }

    //    Controller to update the entry by the citizen when submitting suspects and evidences
    public function updateCitizenEntry(Request $request){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        if($request->evidence!=null){
            $evidence=new Evidence();
            $evidence->entryID=$request->entryID;
            $evidence->witnessId=Auth::User()->nic;
            $evidence->evidence_txt=$request->evidence;
            $evidence->citizenView="Yes";
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
                $fileNewName=$i.".jpg";

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
            $evidence->citizenView="Yes";
            $evidence->policeView="Yes";
            $evidence->evidence_image=$newdatez;
            $evidence->save();
        }

        if($request->suspects!=null){
            $suspects=new Suspect();
            $suspects->entryID=$request->entryID;
            $suspects->name=$request->suspects;
            $suspects->userName=$user->name;
            $suspects->userNic=$nic;
            $suspects->userRole=$user->role;
            $suspects->citizenView="Yes";
            $suspects->policeView="Yes";
            $suspects->save();
        }

        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('userRole',"citizen")->get();
        $entry_progress=db::table('entry_progresses')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();

        return view('registeredCitizen/citizenEntryView',compact('entry','evidences','suspects','entry_progress'));



    }


}
