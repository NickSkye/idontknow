<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use Mail;
use App\Mail\ReportForm;
use App\Mail\ReportCommentForm;
use App\Mail\SupportMail;



class PagesController extends Controller
{
    /*
     * GETS ALL USERS FRENDS WHO ARE ONLINE
     */
    public function getFrendsOnline(){
        $friends_online = DB::table('follows')->join('users', 'follows.followsusername', '=', 'users.username')->select('users.updated_at', 'users.username')->where('follows.username', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();

        return $friends_online;
    }

/*
 * GETS ALL THE GROUPS THE USER IS A PART OF
 */
    public function getGroups(){
        $friends_online = DB::table('groups')->where('username', Auth::user()->username)->orderBy('updated_at', 'desc')->get();

        return $friends_online;
    }

    public function getMySettingsInfo(){
        $my_info_full = DB::table('profileinfo')->join('users', 'profileinfo.username', '=', 'users.username')->where('profileinfo.username', Auth::user()->username)->first();

        return $my_info_full;
    }

//gets all people who follow eachother
    public function getFrends(){
        $frends = DB::table('follows as f1')->join('follows as f2','f1.username', '=', 'f2.followsusername')->where('f1.username', Auth::user()->username)->where('f2.username', 'f1.followsusername')->get();

        return $frends;
    }


    public function like(Request $request)
    {
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        $isred = false;

        if(DB::table('post_votes')->where([['username', Auth::user()->username], ['post_id', $request->postid],])->doesntExist()){
            DB::table('post_votes')->insert(['username'=> Auth::user()->username, 'post_id'=> $request->postid, 'vote'=> 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            $isred = true;

        }
        else{
            $thevote = DB::table('post_votes')->where([['username', Auth::user()->username], ['post_id', $request->postid],])->first();
            if($thevote->vote == 1){
                DB::table('post_votes')->where(['username'=> Auth::user()->username, 'post_id'=> $request->postid, ])->update(['vote'=> 0]);
                $isred = false;
            }
            else{
                DB::table('post_votes')->where(['username'=> Auth::user()->username, 'post_id'=> $request->postid, ])->update(['vote'=> 1]);
                $isred = true;
            }
        }


        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);

        $totalvote = DB::table('post_votes')->where('post_id', $request->postid)->sum('vote');
//        return Response::json(['done']);
        return response([$totalvote, $isred]);

    }

    public function dislike(Request $request)
    {
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        $isblue = false;

        if(DB::table('post_votes')->where([['username', Auth::user()->username], ['post_id', $request->postid],])->doesntExist()){
            DB::table('post_votes')->insert(['username'=> Auth::user()->username, 'post_id'=> $request->postid, 'vote'=> -1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            $isblue = true;
        }
        else{
            $thevote = DB::table('post_votes')->where([['username', Auth::user()->username], ['post_id', $request->postid],])->first();
            if($thevote->vote == -1){
                DB::table('post_votes')->where(['username'=> Auth::user()->username, 'post_id'=> $request->postid, ])->update(['vote'=> 0]);
                $isblue = false;
            }
            else{
                DB::table('post_votes')->where(['username'=> Auth::user()->username, 'post_id'=> $request->postid, ])->update(['vote'=> -1]);
                $isblue = true;
            }
        }


        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);

        $totalvote = DB::table('post_votes')->where('post_id', $request->postid)->sum('vote');
//        return Response::json(['done']);
        return response([$totalvote, $isblue]);

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

        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();

        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);

        return view('settings', ['profileinfo' => $profileinfo, 'notifs' => $notifs, 'now'=> $now, 'online_frends'=> $online_frends]);


    }

    public function myprofile()
    {

        $generalinfo = $this->getMySettingsInfo();
//        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
//        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->where('deleted', false)->orderBy('created_at', 'desc')->get();
        //gets people you follow
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->orderBy('updated_at', 'desc')->get();
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);

        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();

        $real = $this->getFrends();

        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();

        //User follow and post meta data
        $numfollowers = DB::table('follows')->where('followsusername', Auth::user()->username)->count();
        $numposts = DB::table('posts')->where('username', Auth::user()->username)->where('deleted', false)->count();
        $numfollowing = DB::table('follows')->where('username', Auth::user()->username)->count();

        return view('myprofile', ['generalinfo'=> $generalinfo, 'myposts'=> $myposts,'myfriends'=> $myfriends,'notifs'=> $notifs, 'real' => $real, 'numfollowers'=> $numfollowers, 'numposts'=> $numposts, 'numfollowing'=> $numfollowing, 'now'=> $now, 'online_frends'=> $online_frends]);


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

        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();

        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);

        return view('activity', ['generalinfo'=> $generalinfo, 'mybio'=> $mybio, 'allfriendsinfo' => $allfriendsinfo, 'notifs' => $notifs, 'allfollowersinfo' => $allfollowersinfo, 'now'=> $now, 'online_frends'=> $online_frends]);


    }

    public function viewpost($post_id)
    {

        //$allcommentersinfo = [];

        $post = DB::table('profileinfo')->join('posts', 'profileinfo.username', '=', 'posts.username')->where('posts.id', $post_id)->where('posts.deleted', false)->first();

        if(DB::table('post_votes')->where('post_id', $post_id)->exists()){
            $votes_total = DB::table('post_votes')->where('post_id', $post_id)->sum('vote');
        }

        $post_vote = 0;

        if(DB::table('post_votes')->where([['username', Auth::user()->username], ['post_id', $post_id],])->exists()){
            $post_vote = DB::table('post_votes')->where([['username', Auth::user()->username], ['post_id', $post_id],])->first()->vote;
        }

        DB::table('posts')->where('id', $post_id)->increment('views');
        $thecomments = DB::table('profileinfo')->join('comments', 'profileinfo.username', '=', 'comments.username')->where('post_id', $post_id)->orderBy('comments.created_at', 'asc')->paginate(10);
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        $totalvote = DB::table('post_votes')->where('post_id', $post_id)->sum('vote');
        $totalcomment = DB::table('comments')->where('post_id', $post_id)->count();
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);

        return view('post', ['post'=> $post, 'thecomments' => $thecomments, 'now'=> $now, 'online_frends'=> $online_frends, 'post_vote'=> $post_vote, 'totalvote'=> $totalvote, 'totalcomment'=> $totalcomment]);


    }

    public function updatelocation(Request $request){
        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);
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
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();

        DB::table('notifications')->where('id', $id)->update(
            ['seen' => true, 'updated_at' => date('Y-m-d H:i:s')]
        );
        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return view('notifications', ['notifs'=> $notifs, 'now'=> $now, 'online_frends'=> $online_frends]);
    }

    public function allnotifications()
    {

        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
//        $notifs = DB::table('notifications')->where('username', Auth::user()->username)->orderBy('created_at', 'asc')->get();
//        $notifs = DB::table('notifications')->where('username', $id)->get();
        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->orderBy('created_at', 'desc')->get();


        return view('notifications', ['notifs'=> $notifs, 'now'=> $now, 'online_frends'=> $online_frends]);
    }

    public function clearnotifications(){

        DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->update(['seen' => true]);



        return redirect("home")->with('status', 'Notifications cleared');
    }

    public function about(){
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        return view('about', ['now'=> $now, 'online_frends'=> $online_frends]);
    }

    public function donate(){
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        return view('donate', ['now'=> $now, 'online_frends'=> $online_frends]);
    }

    public function legal(){
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        return view('legal', ['now'=> $now, 'online_frends'=> $online_frends]);
    }

    public function suggestions(){
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        return view('suggestions', ['now'=> $now, 'online_frends'=> $online_frends]);
    }

    public function support(){
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        return view('support', ['now'=> $now, 'online_frends'=> $online_frends]);
    }

    public function supportrequest(Request $request){
        $this->validate($request, [
            'mess' => 'required',


        ]);

        $data = array(
            'mess' => $request->mess,
        );
        Mail::send(new SupportMail($data));

        session()->flash('status', 'Successfully sent message!');

        return redirect('/');
    }




    public function reportpost($id)
    {

        $data = array(
            'id' => $id,
        );


        Mail::send(new ReportForm($data));
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);


        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return redirect("/")->with('status', 'post reported');
    }
//    STILL NEED TO WORK ON THIS. COPY REPORT POST
    public function reportcomment(Request $request, $commentid)
    {


        $data = array(
            'postid' => $request->postid,
            'commentid' => $commentid,
        );


        Mail::send(new ReportCommentForm($data));
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);


        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return redirect("/")->with('status', 'comment reported');
    }


}
