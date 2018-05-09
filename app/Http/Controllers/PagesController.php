<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;

class PagesController extends Controller
{
    public function settings()
    {

        //if (Auth::check()) {
            $info = DB::table('users')->where('username', Auth::user()->username)->get();
        $profileinfo = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
            return view('settings', ['info'=> $info, 'profileinfo' => $profileinfo]);
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

    public function getFriendsInfoWithPosts(){
        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.followsusername', '=', 'profileinfo.username')->join('users', 'follows.followsusername', '=', 'users.username')->join('posts', 'follows.followsusername', '=', 'posts.username')->where('follows.username', Auth::user()->username)->get();

        return $friends_info_full;
    }

    public function activity()
    {

//        TEST
        $allfriendsinfo = $this->getFriendsInfoWithPosts();
//        $allfriendsposts = [];

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        //$myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
//        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();

//        foreach ($myfriends as $friend) {
//            $friendsinfo = DB::table('profileinfo')->where('username', '=', $friend->followsusername)->get();
//            $friendsposts = DB::table('posts')->where('username', '=', $friend->followsusername)->get();
//
//            array_push($allfriendsinfo, $friendsinfo);
//            array_push($allfriendsposts, $friendsposts);
//        }

        return view('activity', ['generalinfo'=> $generalinfo, 'mybio'=> $mybio, 'allfriendsinfo' => $allfriendsinfo]);


    }

    public function viewpost($post_id)
    {

        $allcommentersinfo = [];

        $thepost = DB::table('posts')->where('id', $post_id)->get();
        DB::table('posts')->where('id', $post_id)->increment('views');
        $thecomments = DB::table('comments')->where('post_id', $post_id)->get();

//        $thecomments = Post::where('id', $post_id)->comments();

        foreach($thecomments as $comment){
            $profinfos = DB::table('profileinfo')->where('username', $comment->username)->get();
            array_push($allcommentersinfo, $profinfos);
        }
        $profinfos = DB::table('profileinfo')->where('id', $post_id)->get();

        return view('post', ['thepost'=> $thepost, 'thecomments' => $thecomments, 'allcommentersinfo' => $allcommentersinfo]);


    }

    public function deletepost($id)
    {


        DB::table('posts')->where('username', Auth::user()->username)->where('id', $id)->delete();


        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return redirect("home")->with('status', 'post removed');
    }

    public function notifications($id)
    {


        $notifs = DB::table('notifications')->where('id', $id)->get();

        DB::table('notifications')->where('id', $id)->update(
            ['seen' => true, 'updated_at' => date('Y-m-d H:i:s')]
        );
        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return view('notifications', ['notifs'=> $notifs]);
    }

}
