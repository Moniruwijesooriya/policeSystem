<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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


    public function oicPasswordChange(Request $request){
        $currentpassword=$request->currentpassword;
        $newpassword=$request->newpassword;
        $confirmpassword=$request->confirmpassword;

        $oic=DB::table('users')->where('nic',$request->nic)->first();

        if(Hash::check($currentpassword,$oic->password) && $newpassword==$confirmpassword ){
            DB::table('users')
                ->where('nic',$request->nic)
                ->update(['password'=>Hash::make($request->newpassword)]);
            return redirect('/RegisteredCitizen');
        }else{
            
        }

    }

}
