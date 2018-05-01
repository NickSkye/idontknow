<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Storage;

class FriendController extends Controller
{
    public function index($username)
    {
        $info = DB::table('users')->where('username', $username)->get();

        // $pages = Page::where('title', 'LIKE', "%$query%")->get();



        return view('friendspage', ['info'=> $info]);
    }

    public function add($username)
    {
        DB::table('follows')->insert(
            ['username' => Auth::user()->username, 'followsusername' => $username]
        );

        // $pages = Page::where('title', 'LIKE', "%$query%")->get();



        return redirect()->back()->with('status', 'friend added');
    }
}
