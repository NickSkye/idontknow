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

    public function activity()
    {

        $allfriendsinfo = [];
        $allfriendsposts = [];

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        //$myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();
        foreach ($myfriends as $friend) {
            $friendsinfo = DB::table('profileinfo')->where('username', '=', $friend->followsusername)->get();
            $friendsposts = DB::table('posts')->where('username', '=', $friend->followsusername)->get();

            array_push($allfriendsinfo, $friendsinfo);
            array_push($allfriendsposts, $friendsposts);
        }

        return view('activity', ['generalinfo'=> $generalinfo, 'mybio'=> $mybio,'myfriends'=> $myfriends, 'allfriendsinfo' => $allfriendsinfo, 'allfriendsposts' => $allfriendsposts]);


    }

    public function viewpost($post_id)
    {



        $thepost = DB::table('posts')->where('id', $post_id)->get();
        DB::table('posts')->where('id', $post_id)->increment('views');
        $thecomments = DB::table('comments')->where('post_id', $post_id)->get();


        return view('post', ['thepost'=> $thepost, 'thecomments' => $thecomments]);


    }

    public function deletepost($id)
    {


        DB::table('posts')->where('username', Auth::user()->username)->where('id', $id)->delete();


        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return redirect("home")->with('status', 'post removed');
    }

}
