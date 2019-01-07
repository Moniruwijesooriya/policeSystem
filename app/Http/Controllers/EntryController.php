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
use Mail;

class EntryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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


        $crimeEntry->save();

        $entry=db::table('entries')->where('complainantID',Auth::User()->nic)->latest()->first();
        $evidences=db::table('evidence')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('userRole',"citizen")->get();

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
        return view('registeredCitizen/citizenEntryView',compact('entry','evidences','suspects'));
    }

    public function entryOICAction(Request $request){

        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $statusType=$request->statusType;
        if($statusType=="new"){
            //initial entry progress when submitting the entry
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
            $progress->progress="Entry is forwarded to the accepted and Forwarded to the relevant section.";
            $progress->citizenView="Yes";
            $progress->policeView="Yes";
            $progress->save();

            DB::table('entries')
                ->where('entryID',$request->entryID)
                ->update(['oicNotification'=>"n",'boicNotification'=>"y",'status'=>"ongoing",'branch'=>$request->branch]);
        }
        else if($statusType=="ongoing"){
            if($request->ongoingSubmit=="Close Entry"){
                DB::table('entries')
                    ->where('entryID',$request->entryID)
                    ->update(['status'=>"closed"]);
                $nic=Auth::User()->nic;
                $entries=db::table('entries')->where('status',"ongoing")->get();
                $type="Ongoing Entries";
                $oicDetails = db::table('users')->where('nic',$nic)->First();
                $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

                return view('oic.entryList',compact('entries','type','oicDetails','branches'));
            }

        }

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


        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('policeView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('policeView',"Yes")->get();
        $entryProgresses=db::table('entry_progresses')->where('entryID',$request->entryID)->get();

        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();
        return view('oic/entryView',compact('entry','evidences','suspects','entryProgresses','branches','oicDetails'));
    }
    public function viewOICEntry(Request $request){
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();


        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('policeView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('policeView',"Yes")->get();
        $entryProgresses=db::table('entry_progresses')->where('entryID',$request->entryID)->get();

        return view('oic/entryView',compact('entry','evidences','suspects','entryProgresses','oicDetails','branches'));
    }
    public function viewOICNewEntries(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $entries=db::table('entries')->where('oicNotification',"y")->where('nearestPoliceStation',$user->policeOffice)->get();
        $type="New Entries";
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('oic.entryList',compact('entries','type','oicDetails','branches'));
    }
    public function viewOICOngoingEntries(){

        $nic=Auth::User()->nic;
        $entries=db::table('entries')->where('status',"ongoing")->get();
        $type="Ongoing Entries";
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('oic.entryList',compact('entries','type','oicDetails','branches'));
    }

    public function viewOICClosedEntries(){
        $nic=Auth::User()->nic;
        $entries=db::table('entries')->where('status',"closed")->get();
        $type="Closed Entries";
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        $branches = db::table('police_offices')->where('headPoliceOffice',$oicDetails->policeOffice)->where('policeOfficeType','Branch Police Office')->get();

        return view('oic.entryList',compact('entries','type','oicDetails','branches'));
    }
    public function getUserInfo(Request $request){
        $userInfo=db::table('users')->where('nic',$request->id)->First();
        return response()->json($userInfo);

    }

    public function getRemovedUserInfo(Request $request){
        $userInfo=db::table('removed_users')->where('nic',$request->id)->First();
        return response()->json(($userInfo));
    }

    public function acceptBOICEntry(Request $request){

        DB::table('entries')
            ->where('entryID',$request->entryId)
            ->update(['boicNotification'=>"n",'suspects'=>$request->suspects,'branch'=>$request->branch,'progress'=>$request->progress]);
        return redirect('/BOIC');
    }
    public function viewBOICEntry(Request $request){
        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        return view('entry/boicEntryView',compact('entry'));
    }

    public function viewCitizenEntry(Request $request){
        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('userRole',"citizen")->get();
        return view('registeredCitizen/citizenEntryView',compact('entry','evidences','suspects'));
    }


    public function updateCitizenEntry(Request $request){
        $evidence=new Evidence();
        $evidence->entryId=$request->entryID;
        $evidence->witnessId=Auth::User()->nic;
        $evidence->evidence_txt=$request->evidence;
        $evidence->citizenView="Yes";
        $evidence->policeView="Yes";

        $evidence->save();

        $suspects=new Suspect();
        $suspects->entryId=$request->entryID;
        $suspects->name=$request->suspects;
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $suspects->userName=$user->name;
        $suspects->userNic=$nic;
        $suspects->userRole="citizen";
        $suspects->citizenView="Yes";
        $suspects->policeView="Yes";

        $suspects->save();

        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('userRole',"citizen")->get();
        return view('registeredCitizen/citizenEntryView',compact('entry','evidences','suspects'));



    }
    public function viewHigherAuthorityAttention(Request $request){

        $entry=db::table('entries')->where('entryID',$request->entryIDTemp)->First();
        $evidences=db::table('evidence')->where('entryID',$request->entryID)->where('citizenView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('userRole',"citizen")->get();
        return view('registeredCitizen.viewHigherAuthorityAttentionForm',compact('entry','evidences','suspects'));
    }

}
