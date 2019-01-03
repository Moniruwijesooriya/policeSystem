<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OICController extends Controller
{
    public function __construct()
    {
        $this->middleware('oic');
    }

    public function index(){
        $nic=Auth::User()->nic;
        $oicDetails = db::table('users')->where('nic',$nic)->First();
        return view('oic.index',compact('oicDetails'));
    }
    public function test(){
        return view('oic.test');
    }

}
