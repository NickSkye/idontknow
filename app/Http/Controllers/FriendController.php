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
        $arefriends = false;
        // $pages = Page::where('title', 'LIKE', "%$query%")->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();
        foreach($info as $item) {
            foreach ($friends as $friend) {
                if ($item->username === $friend->followsusername) {
                    $arefriends = true;
                    return view('friendspage', ['info'=> $info, 'arefriends'=> $arefriends]);
                }
                else{
                    return view('friendspage', ['info'=> $info, 'arefriends'=> $arefriends]);
                }
            }
        }



    }

    public function add($username)
    {
        DB::table('follows')->insert(
            ['username' => Auth::user()->username, 'followsusername' => $username]
        );

        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return redirect("home")->with('status', 'friend added');
    }

    public function remove($username)
    {
        DB::table('follows')->where(['username','=', Auth::user()->username], ['followsusername', '=', $username])->delete();

        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return redirect("home")->with('status', 'friend removed');
    }
}
