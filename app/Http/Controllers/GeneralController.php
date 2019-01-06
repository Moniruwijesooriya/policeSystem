<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getRemovedUserInfo(Request $request){
        $userInfo=db::table('removed_users')->where('nic',$request->id)->First();
        return response()->json(($userInfo));
    }
}
