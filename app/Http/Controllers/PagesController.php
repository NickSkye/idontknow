<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function settings()
    {
        $info = DB::table('users')->where('username', Auth::user()->username)->get();



        return view('settings', ['info'=> $info]);
    }
}
