<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function colomboPost(){
        $content=Entry::all()->where('districts','colombo');
        return view('colomboPost',compact('content'));

    }
}
