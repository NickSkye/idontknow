<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Storage;

class FriendController extends Controller
{
    public function index($username)
    {
        $info = DB::table('users')->where('username', $username)->get();

        // $pages = Page::where('title', 'LIKE', "%$query%")->get();



        return view('friendspage', $info);
    }
}
