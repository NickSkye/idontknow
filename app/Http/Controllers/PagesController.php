<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;

class PagesController extends Controller
{

    public function getMySettingsInfo(){
        $my_info_full = DB::table('profileinfo')->join('users', 'profileinfo.username', '=', 'users.username')->where('profileinfo.username', Auth::user()->username)->first();

        return $my_info_full;
    }


    public function settings()
    {

        //if (Auth::check()) {
//            $info = DB::table('users')->where('username', Auth::user()->username)->get();
        $profileinfo = $this->getMySettingsInfo(); //DB::table('profileinfo')->where('username', Auth::user()->username)->get();
            return view('settings', ['profileinfo' => $profileinfo]);
//        }
//        else{
//            return view('auth.login');
//        }

    }

    public function myprofile()
    {

        $generalinfo = $this->getMySettingsInfo();
//        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
//        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->where('deleted', false)->orderBy('created_at', 'desc')->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->orderBy('updated_at', 'desc')->get();
        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();

        return view('myprofile', ['generalinfo'=> $generalinfo, 'myposts'=> $myposts,'myfriends'=> $myfriends,'notifs'=> $notifs]);


    }

    public function getFriendsInfoWithPosts(){

//        $selfincluded = DB::table('posts')->where('username',  Auth::user()->username)->get();

        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.followsusername', '=', 'profileinfo.username')->join('users', 'follows.followsusername', '=', 'users.username')->join('posts', 'follows.followsusername', '=', 'posts.username')->where('follows.username', Auth::user()->username)->where('deleted', false)->orderBy('posts.created_at', 'desc')->paginate(10); //'posts.updated_at'

        return $friends_info_full;
    }

    public function activity()
    {

//        TEST
        $allfriendsinfo = $this->getFriendsInfoWithPosts();
//        $allfriendsposts = [];

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();

        return view('activity', ['generalinfo'=> $generalinfo, 'mybio'=> $mybio, 'allfriendsinfo' => $allfriendsinfo, 'notifs' => $notifs]);


    }

    public function viewpost($post_id)
    {

        //$allcommentersinfo = [];

        $thepost = DB::table('posts')->where('id', $post_id)->where('deleted', false)->get();
        DB::table('posts')->where('id', $post_id)->increment('views');
        $thecomments = DB::table('comments')->join('profileinfo', 'comments.username', '=', 'profileinfo.username')->where('post_id', $post_id)->get();

//        $thecomments = Post::where('id', $post_id)->comments();

//        foreach($thecomments as $comment){
//            $profinfos = DB::table('profileinfo')->where('username', $comment->username)->get();
//            array_push($allcommentersinfo, $profinfos);
//        }
//        $profinfos = DB::table('profileinfo')->where('id', $post_id)->get();

        return view('post', ['thepost'=> $thepost, 'thecomments' => $thecomments]);


    }

    public function deletepost($id)
    {


        DB::table('posts')->where('username', Auth::user()->username)->where('id', $id)->update(['deleted' => true]);


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

    public function clearnotifications(){

        DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->update(['seen' => true]);


        return redirect("home")->with('status', 'Notifications cleared');
    }

}
