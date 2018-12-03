<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use App\PublicPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function colomboPost(){
        $content=Entry::all()->where('districts','colombo');
        return view('colomboPost',compact('content'));

    }
    public function createPost (Request $request){

        $publicPost=new PublicPost();
        $publicPost->entryId=$request->entryId;
        $publicPost->title=$request->title;
        $nic=Auth::User()->nic;
        $user=db::table('users')->where('Nic',$nic)->First();
        $publicPost->postedBy=$user->name;
        $publicPost->content=$request->postContent;

        $publicPost->save();
        return redirect('/OIC');
    }
}
