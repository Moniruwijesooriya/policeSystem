<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DOIGController extends Controller
{
    public function __construct()
    {
        $this->middleware('doig');
    }

    public function index(){
        return view('doig.index');
    }
}
