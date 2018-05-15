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

//gets all people who follow eachother
    public function getFrends(){
        $frends = DB::table('follows as f1')->join('follows as f2','f1.username', '=', 'f2.followsusername')->where('f1.username', Auth::user()->username)->where('f2.username', 'f1.followsusername')->get();

        return $frends;
    }



    public function settings()
    {

        //if (Auth::check()) {
//            $info = DB::table('users')->where('username', Auth::user()->username)->get();
        $profileinfo = $this->getMySettingsInfo(); //DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();
        return view('settings', ['profileinfo' => $profileinfo, 'notifs' => $notifs]);


    }

    public function myprofile()
    {

        $generalinfo = $this->getMySettingsInfo();
//        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
//        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->where('deleted', false)->orderBy('created_at', 'desc')->get();
        //gets people you follow
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->orderBy('updated_at', 'desc')->get();
        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();

        $real = $this->getFrends();

        return view('myprofile', ['generalinfo'=> $generalinfo, 'myposts'=> $myposts,'myfriends'=> $myfriends,'notifs'=> $notifs, 'real' => $real]);


    }

    public function getFollowingInfoWithPosts(){

//        $selfincluded = DB::table('posts')->where('username',  Auth::user()->username)->get();

        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.followsusername', '=', 'profileinfo.username')->join('users', 'follows.followsusername', '=', 'users.username')->join('posts', 'follows.followsusername', '=', 'posts.username')->where('follows.username', Auth::user()->username)->where('deleted', false)->orderBy('posts.created_at', 'desc')->paginate(10); //'posts.updated_at'

        return $friends_info_full;
    }

    public function getFollowersInfoWithPosts(){

//        $selfincluded = DB::table('posts')->where('username',  Auth::user()->username)->get();

        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.username', '=', 'profileinfo.username')->join('users', 'follows.username', '=', 'users.username')->join('posts', 'follows.username', '=', 'posts.username')->where('follows.followsusername', Auth::user()->username)->where('deleted', false)->orderBy('posts.created_at', 'desc')->paginate(10); //'posts.updated_at'

        return $friends_info_full;
    }

    public function activity()
    {

//        TEST
        $allfriendsinfo = $this->getFollowingInfoWithPosts();
        $allfollowersinfo = $this->getFollowersInfoWithPosts();
//        $allfriendsposts = [];

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();

        return view('activity', ['generalinfo'=> $generalinfo, 'mybio'=> $mybio, 'allfriendsinfo' => $allfriendsinfo, 'notifs' => $notifs, 'allfollowersinfo' => $allfollowersinfo]);


    }

    public function viewpost($post_id)
    {

        //$allcommentersinfo = [];

        $post = DB::table('profileinfo')->join('posts', 'profileinfo.username', '=', 'posts.username')->where('posts.id', $post_id)->where('posts.deleted', false)->first();
        DB::table('posts')->where('id', $post_id)->increment('views');
        $thecomments = DB::table('profileinfo')->join('comments', 'profileinfo.username', '=', 'comments.username')->where('post_id', $post_id)->orderBy('comments.created_at', 'asc')->paginate(10);

//        $thecomments = Post::where('id', $post_id)->comments();

//        foreach($thecomments as $comment){
//            $profinfos = DB::table('profileinfo')->where('username', $comment->username)->get();
//            array_push($allcommentersinfo, $profinfos);
//        }
//        $profinfos = DB::table('profileinfo')->where('id', $post_id)->get();

        return view('post', ['post'=> $post, 'thecomments' => $thecomments]);


    }

    public function deletepost($id)
    {


        DB::table('posts')->where('username', Auth::user()->username)->where('id', $id)->update(['deleted' => true]);


        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return redirect("home")->with('status', 'post removed');
    }

    public function notifications($id)
    {


        $notifs = DB::table('notifications')->where('id', $id)->orderBy('created_at', 'asc')->get();


        DB::table('notifications')->where('id', $id)->update(
            ['seen' => true, 'updated_at' => date('Y-m-d H:i:s')]
        );
        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return view('notifications', ['notifs'=> $notifs]);
    }

    public function allnotifications()
    {


//        $notifs = DB::table('notifications')->where('username', $id)->get();
        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();


        return view('notifications', ['notifs'=> $notifs]);
    }

    public function clearnotifications(){

        DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->update(['seen' => true]);


        return redirect("home")->with('status', 'Notifications cleared');
    }

    public function about(){
        return view('about');
    }

    public function donate(){
        return view('donate');
    }

    public function legal(){
        return view('legal');
    }

    public function suggestions(){
        return view('suggestions');
    }

    public function support(){
        return view('support');
    }

}
