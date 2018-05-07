<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AchievementsController extends Controller
{
    public function add($achievement)
    {
//        DB::table('follows')->insert(
//            ['username' => Auth::user()->username, 'followsusername' => $username]
//        );
//
//        // $pages = Page::where('title', 'LIKE', "%$query%")->get();
//
//        return redirect("home")->with('status', 'friend added');
    }
}
