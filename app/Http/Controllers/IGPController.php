<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IGPController extends Controller
{
    public function __construct()
    {
        $this->middleware('igp');
    }

    public function index(){
        return view('igp.index');
    }
}
