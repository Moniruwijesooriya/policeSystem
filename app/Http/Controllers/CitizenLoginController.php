<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class CitizenLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('citizen');
    }

    public function index()
    {
        $nic=Auth::User()->nic;
        $citizenDetails = db::table('users')->where('nic',$nic)->First();
        $crimeCategories = db::table('crime_categories')->where('citizenView',"Yes")->get();
        //return view('registeredCitizen.index',compact('citizenDetails','crimeCategories'));
        return view('registeredCitizen.tempCitizen',compact('crimeCategories'));
    }

}

