<?php

namespace App\Http\Controllers;

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

        $allfriendsinfo = [];
//        $storagePath = Storage::disk('s3')->put("uploads", $my_file, 'public');
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();
        foreach ($friends as $friend) {
            $friendsinfo = DB::table('profileinfo')->where('username', '=', $friend->username);

            array_push($allfriendsinfo, $friendsinfo->username);
        }
            return view('home', ['friends' => $friends, 'allfriendsinfo' => $allfriendsinfo]);
        }
    }
