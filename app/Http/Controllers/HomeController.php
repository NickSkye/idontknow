<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Storage;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //example creates text file and uploads to s3 bucket
//        $my_file = 'file.txt';
//        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
//        $data = 'Test data to see if this works!';
//        fwrite($handle, $data);

//        this portion sends the link to the db
//        Storage::disk('s3')->get($storagePath).
        if(is_null(DB::table('profileinfo')->where('username', Auth::user()->username)->first()) ) {
            $imageName = "https://frendgrid.s3.us-west-1.amazonaws.com/profilepics/1525299219.png";
            DB::table('profileinfo')->insert(['username' => Auth::user()->username, 'profileimage' => "https://frendgrid.s3.us-west-1.amazonaws.com/profilepics/1525299219.png", 'aboutme' => "There's nothing here yet"]);

        }






        $allfriendsinfo = [];
//        $storagePath = Storage::disk('s3')->put("uploads", $my_file, 'public');
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();
//        $friends = \User::friends();
        foreach ($friends as $friend) {
            $friendsinfo = DB::table('profileinfo')->where('username', '=', $friend->followsusername)->get();

            array_push($allfriendsinfo, $friendsinfo);
        }

        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();
            return view('home', ['friends' => $friends, 'allfriendsinfo' => $allfriendsinfo, 'notifs'=> $notifs]);
        }
    }
