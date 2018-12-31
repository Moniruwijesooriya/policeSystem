<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OICController extends Controller
{
    public function __construct()
    {
        $this->middleware('oic');
    }

    public function index(){
        return view('oic.index');
    }
    public function test(){
        return view('oic.test');
    }

}
