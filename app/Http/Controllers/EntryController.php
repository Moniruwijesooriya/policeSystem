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

class EntryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitEntry(Request $request){

        $crimeEntry=new Entry();
        $crimeEntry->complaintCategory=$request->complaintCategory;
        $crimeEntry->complaint=$request-> complaintText;
        $crimeEntry->district=$request->district;
        $crimeEntry->nearestPoliceStation=$request->policeStation." Police Station";
        $crimeEntry->complainantID=Auth::User()->nic;
        $crimeEntry->oicNotification="y";
        $crimeEntry->boicNotification="n";
        $crimeEntry->status="new";
        $crimeEntry->progress="Entry is submitted to the ".$request->policeStation." Police Station";
        $crimeEntry->suspects=$request->suspects;
        $crimeEntry->evidences=$request->evidences;


        $crimeEntry->save();
        return redirect()->back();
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
            $progress->save();

            DB::table('entries')
                ->where('entryID',$request->entryID)
                ->update(['oicNotification'=>"n",'boicNotification'=>"y",'status'=>"ongoing",'branch'=>$request->branch]);
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
            $progress->save();

        }


        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('policeView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('policeView',"Yes")->get();
        $entryProgresses=db::table('entry_progresses')->where('entryID',$request->entryID)->get();

        return view('entry/oicEntryView',compact('entry','evidences','suspects','entryProgresses'));
    }
    public function viewOICEntry(Request $request){
        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('policeView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('policeView',"Yes")->get();
        $entryProgresses=db::table('entry_progresses')->where('entryID',$request->entryID)->get();

        return view('entry/oicEntryView',compact('entry','evidences','suspects','entryProgresses'));
    }
    public function viewOICNewEntries(){
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();

        $entries=db::table('entries')->where('oicNotification',"y")->where('nearestPoliceStation',$user->policeOffice)->get();
        $type="New Entries";
        return view('entry.oicEntryListView',compact('entries','type'));
    }
    public function viewOICOngoingEntries(){

        $entries=db::table('entries')->where('status',"ongoing")->get();
        $type="Ongoing Entries";
        return view('entry.oicEntryListView',compact('entries','type'));
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
        return view('entry/citizenEntryView',compact('entry','evidences','suspects'));
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

        return redirect('/RegisteredCitizen');


    }

}
