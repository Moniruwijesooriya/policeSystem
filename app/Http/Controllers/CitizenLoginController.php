<?php

namespace App\Http\Controllers;


class CitizenLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('citizen');
    }

    public function index(){
        return view('home');
    }
}
