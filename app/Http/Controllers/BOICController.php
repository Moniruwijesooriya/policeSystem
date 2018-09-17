<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BOICController extends Controller
{
    public function __construct()
    {
        $this->middleware('boic');
    }

    public function index(){
        return view('boic.index');
    }
}
