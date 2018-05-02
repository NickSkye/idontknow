<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function settings()
    {

        //if (Auth::check()) {
            $info = DB::table('users')->where('username', Auth::user()->username)->get();

            return view('settings', ['info'=> $info]);
//        }
//        else{
//            return view('auth.login');
//        }

    }

    public function myprofile()
    {


        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();


        return view('myprofile', ['generalinfo'=> $generalinfo, 'mybio'=> $mybio,'myposts'=> $myposts,'myfriends'=> $myfriends]);


    }
}
