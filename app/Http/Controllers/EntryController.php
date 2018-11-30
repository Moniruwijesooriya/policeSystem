<?php

namespace App\Http\Controllers;

use App\CrimeEntrySubmitNotification;
use App\Entry;
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
        $crimeEntry->progress="Entry is submitted to the ".$request->policeStation." Police Station";
        $crimeEntry->suspects=$request->suspects;
        $crimeEntry->evidences=$request->evidences;

        $crimeEntry->save();
        return redirect()->back();
    }

    public function acceptOICEntry(Request $request){

        DB::table('entries')
            ->where('entryID',$request->entryId)
            ->update(['oicNotification'=>"n",'boicNotification'=>"y",'suspects'=>$request->suspects,'branch'=>$request->branch,'progress'=>$request->progress]);
        return redirect('/OIC');
    }
    public function viewOICEntry(Request $request){
        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('citizenView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('userRole',"citizen")->get();
        return view('entry/oicEntryView',compact('entry','evidences','suspects'));
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
        $evidences=db::table('evidence')->where('entryId',$request->entryID)->where('citizenView',"Yes")->get();
        $suspects=db::table('suspects')->where('entryID',$request->entryID)->where('userRole',"citizen")->get();
        return view('entry/entryView',compact('entry','evidences','suspects'));
    }

    public function updateCitizenEntry(Request $request){
        $evidence=new Evidence();
        $evidence->entryId=$request->entryId;
        $evidence->witnessId=Auth::User()->nic;
        $evidence->evidence_txt=$request->evidence;
        $evidence->citizenView="Yes";

        $evidence->save();

        $suspects=new Suspect();
        $suspects->entryId=$request->entryId;
        $suspects->name=$request->suspects;
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $suspects->userName=$user->name;
        $suspects->userNic=$nic;
        $suspects->userRole="citizen";

        $suspects->save();

        return view('registeredCitizen.index');


    }

}
