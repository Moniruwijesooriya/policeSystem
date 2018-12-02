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
        return view('registeredCitizen.index',compact('citizenDetails'));
    }
}

