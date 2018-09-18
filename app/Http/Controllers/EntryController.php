<?php

namespace App\Http\Controllers;

use App\CrimeEntrySubmitNotification;
use App\Entry;
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
        $crimeEntry->nearestPoliceStation=$request->policeStation;
        $crimeEntry->complainantID=Auth::User()->nic;
        $crimeEntry->oicNotification="y";
        $crimeEntry->progress="Entry is submitted to the ".$request->policeStation;

        $crimeEntry->save();
        return redirect()->back();
    }

    public function acceptEntry(Request $request){

        DB::table('entries')
            ->where('entryID',$request->entryId)
            ->update(['oicNotification'=>"n",'suspects'=>$request->suspects,'branch'=>$request->branch,'progress'=>$request->progress]);
        return redirect('/OIC');
    }
    public function viewEntry(Request $request){
        $entry=db::table('entries')->where('entryID',$request->entryID)->First();
        return view('entry/entry',compact('entry'));
    }

}
