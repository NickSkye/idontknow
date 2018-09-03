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
use Stevebauman;
use Stevebauman\Location\Location;



class PagesController extends Controller
{
    /*
     * GETS ALL USERS FRENDS WHO ARE ONLINE
     */
    public function getFrendsOnline(){
        $friends_online = DB::table('follows')->join('users', 'follows.followsusername', '=', 'users.username')->select('users.updated_at', 'users.username')->where('follows.username', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();

        return $friends_online;
    }

    public function currentuser(){

        return Auth::user()->username;
    }

    public function nearbyPosts() {

        $location = DB::table('users')->select('latitude', 'longitude')
            ->where('username', Auth::user()->username)->first();
        if(is_null($location->latitude) or is_null($location->longitude)){
            $location->latitude = 0;
            $location->longitude = 0;
        }

        return DB::table('posts')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$location->latitude.') ) * cos( radians( posts.latitude ) ) * cos( radians( posts.longitude ) - radians('.$location->longitude.') ) + sin( radians('.$location->latitude.') ) * sin( radians( posts.latitude ) ) ) ) AS distance'), 'posts.username as username', 'profileinfo.profileimage as profileimage', 'posts.created_at as created_at', 'posts.description as description', 'posts.id as id', 'posts.imagepath as imagepath', 'posts.views as views', 'posts.votes as votes', 'post_votes.post_id as post_id', 'post_votes.vote as vote', 'posts.deleted as deleted', 'posts.comments as comments')
            ->leftJoin('users', 'posts.username', '=', 'users.username')
            ->leftJoin('profileinfo', 'posts.username', '=', 'profileinfo.username')
            ->leftJoin('post_votes', function ($leftJoin) {
                $leftJoin->on('posts.id', '=', 'post_votes.post_id')
                    ->where('post_votes.username', Auth::user()->username);
            })->where('deleted', false)
            ->orderBy('distance', 'asc')->orderBy('posts.created_at', 'desc')->distinct()->get();


//            ->leftJoin('post_votes', 'posts.id', '=', 'post_votes.post_id')

    }


    public function nearbyPostsGuest() {



        return DB::table('posts')->select('posts.username as username', 'profileinfo.profileimage as profileimage', 'posts.created_at as created_at', 'posts.description as description', 'posts.id as id', 'posts.imagepath as imagepath', 'posts.views as views', 'posts.deleted as deleted', 'posts.comments as comments')
            ->leftJoin('users', 'posts.username', '=', 'users.username')
            ->leftJoin('profileinfo', 'posts.username', '=', 'profileinfo.username')
            ->where('deleted', false)
            ->orderBy('posts.created_at', 'desc')->distinct()->limit(100)->get();


//            ->leftJoin('post_votes', 'posts.id', '=', 'post_votes.post_id')

    }

    public function getFollowingsInfo($friendsusername){
        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.followsusername', '=', 'profileinfo.username')->join('users', 'follows.followsusername', '=', 'users.username')->where('follows.username', $friendsusername)->orderBy('users.updated_at', 'desc')->get();

        return $friends_info_full;
    }

    public function getFollowersInfo($friendsusername){
        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.username', '=', 'profileinfo.username')->join('users', 'follows.username', '=', 'users.username')->where('follows.followsusername', $friendsusername)->orderBy('users.updated_at', 'desc')->get();

        return $friends_info_full;
    }

    public function postLocation($postlocid) {


        $location = DB::table('users')->select('latitude', 'longitude')->where('username', Auth::user()->username)->first();
        if(is_null($location->latitude) or is_null($location->longitude)){
            $location->latitude = 0;
            $location->longitude = 0;
        }

        return DB::table('posts')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$location->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$location->longitude.') ) + sin( radians('.$location->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))->where('posts.id', $postlocid)->first();
    }

    /*
     * GETS SPECIFIC USER LOCATION Takes Frends Username as argument
     */
    public function frendsLocation($frend) {


        $location = DB::table('users')->select('latitude', 'longitude')->where('username', Auth::user()->username)->first();
        if(is_null($location->latitude) or is_null($location->longitude)){
            $location->latitude = 0;
            $location->longitude = 0;
        }

        return DB::table('users')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$location->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$location->longitude.') ) + sin( radians('.$location->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))->where('users.username', $frend)->join('profileinfo', 'profileinfo.username', '=', 'users.username')->first();
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
        $frends = DB::table('follows as f1')
            ->join('follows as f2','f1.followsusername', '=', 'f2.username')
            ->where('f1.followsusername', '=', 'f2.username')
            ->where('f2.username', '=', Auth::user()->username)->get();

        return $frends;
    }

    public function poll()
    {


        return view('poll');


    }

    public function dashboard()
    {


        return view('dashboard');


    }

    public function apps()
    {


        return view('apps');


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
        $totalvote = DB::table('post_votes')->where('post_id', $request->postid)->sum('vote');

        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        DB::table('posts')->where('id', $request->postid)->update(['votes' => $totalvote]);


//        return Response::json(['done']);
        return response([$totalvote, $isred, $request->postid]);

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

        $totalvote = DB::table('post_votes')->where('post_id', $request->postid)->sum('vote');
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        DB::table('posts')->where('id', $request->postid)->update(['votes' => $totalvote]);

//        return Response::json(['done']);
        return response([$totalvote, $isblue, $request->postid]);

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
        $score = DB::table('users')->select('score')->where('username', Auth::user()->username)->first();
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        $allfriendsinfo = $this->getFollowingsInfo(Auth::user()->username);
        $allfollowersinfo = $this->getFollowersInfo(Auth::user()->username);
        //User follow and post meta data
        $numfollowers = DB::table('follows')->where('followsusername', Auth::user()->username)->count();
        $numposts = DB::table('posts')->where('username', Auth::user()->username)->where('deleted', false)->count();
        $numfollowing = DB::table('follows')->where('username', Auth::user()->username)->count();
        $achievements = DB::table('achievements')->where('username', Auth::user()->username)->get();
        return view('myprofile', ['generalinfo'=> $generalinfo, 'myposts'=> $myposts,'myfriends'=> $myfriends,'notifs'=> $notifs, 'real' => $real, 'numfollowers'=> $numfollowers, 'numposts'=> $numposts, 'numfollowing'=> $numfollowing, 'now'=> $now, 'online_frends'=> $online_frends, 'achievements' => $achievements, 'allfriendsinfo' => $allfriendsinfo, 'allfollowersinfo' => $allfollowersinfo, 'score' => $score]);


    }
//    USED FOR ACTIVITY AND NEARBY
    public function getFollowingInfoWithPosts(){

//        $selfincluded = DB::table('posts')->where('username',  Auth::user()->username)->get();

        $friends_info_full = DB::table('posts')
            ->select('posts.username as username', 'profileinfo.profileimage as profileimage', 'posts.created_at as created_at', 'posts.description as description', 'posts.id as id', 'posts.imagepath as imagepath', 'posts.views as views', 'post_votes.post_id as post_id', 'post_votes.vote as vote', 'posts.votes as votes', 'posts.comments as comments')
            ->leftJoin('profileinfo', 'posts.username', '=', 'profileinfo.username')
            ->leftJoin('users', 'posts.username', '=', 'users.username')
            ->leftJoin('follows', 'posts.username', '=', 'follows.followsusername')
//            ->leftJoin('post_votes', 'posts.id', '=', 'post_votes.post_id')
            ->leftJoin('post_votes', function ($leftJoin) {
                $leftJoin->on('posts.id', '=', 'post_votes.post_id')
                    ->where('post_votes.username', Auth::user()->username);
            })
            ->where(function ($query) {
                $query->where('follows.username', Auth::user()->username)
                    ->orWhere('posts.username', Auth::user()->username);
            })->where('deleted', false)
            ->orderBy('posts.created_at', 'desc')->distinct()->get(); //'posts.updated_at'






        return $friends_info_full;
    }



    public function getFollowersInfoWithPosts(){

//        $selfincluded = DB::table('posts')->where('username',  Auth::user()->username)->get();

        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.username', '=', 'profileinfo.username')->join('users', 'follows.username', '=', 'users.username')->join('posts', 'follows.username', '=', 'posts.username')->where('follows.followsusername', Auth::user()->username)->where('deleted', false)->orderBy('posts.created_at', 'desc')->get(); //'posts.updated_at'

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
//        $post_votes = 0;

//        if(DB::table('post_votes')->where([['username', Auth::user()->username], ['post_id', $post_id],])->exists()){
//            $post_votes = DB::table('post_votes')->where('username', Auth::user()->username)->get();

//        }
//        $totalvote = DB::table('post_votes')->where('post_id', $post_id)->sum('vote');
//        $totalcomment = DB::table('comments')->where('post_id', $post_id)->count();
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        $allwhoblocked = array();
        $allwhoblockeds = DB::table('blocked')->select('username')->where('blockedusername', Auth::user()->username)->get()->toArray();
        foreach($allwhoblockeds as $awb){
            array_push($allwhoblocked, $awb->username);
        }

        return view('activity', ['generalinfo'=> $generalinfo, 'mybio'=> $mybio, 'allfriendsinfo' => $allfriendsinfo, 'notifs' => $notifs, 'allfollowersinfo' => $allfollowersinfo, 'now'=> $now, 'online_frends'=> $online_frends, 'allwhoblocked' => $allwhoblocked]);


    }

    public function nearby()
    {

//        TEST



        if(Auth::check()) {
            $allfriendsinfo = $this->nearbyPosts();
            $allfollowersinfo = $this->getFollowersInfoWithPosts();
            $post_votes = DB::table('post_votes')->select('post_votes.post_id as post_id', 'post_votes.vote as vote')
                ->where('username', Auth::user()->username)->get();
            $newtest = $allfriendsinfo->merge($post_votes);

            $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
            $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
            $notifs = DB::table('notifications')->where([
                ['username', Auth::user()->username],
                ['seen', false],
            ])->get();

            $now = new \DateTime();
            $online_frends = $this->getFrendsOnline();
            DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
            $allwhoblocked = array();
            $allwhoblockeds = DB::table('blocked')->select('username')->where('blockedusername', Auth::user()->username)->get()->toArray();
            foreach($allwhoblockeds as $awb){
                array_push($allwhoblocked, $awb->username);
            }
            $notifcount = DB::table('notifications')->where([
                ['username', Auth::user()->username],
                ['seen', false],
            ])->count();
            setcookie("FG_Notifications", $notifcount, time() + (86400 * 30), "/");
            $messagescount = DB::table('messages')->where([['messages.username', Auth::user()->username], ['seen', false],])->count();
            setcookie('FG_Shoutcount', $messagescount, time() + (86400 * 30), "/");
            return view('nearby', ['generalinfo'=> $generalinfo, 'mybio'=> $mybio, 'allfriendsinfo' => $allfriendsinfo, 'notifs' => $notifs, 'allfollowersinfo' => $allfollowersinfo, 'now'=> $now, 'online_frends'=> $online_frends, 'post_votes'=> $post_votes, 'newtest'=>$newtest, 'allwhoblocked' => $allwhoblocked]);
        } else{
            $allfriendsinfo = $this->nearbyPostsGuest();
            return view('nearby', ['allfriendsinfo' => $allfriendsinfo]);
        }






    }

    public function viewpost($post_id)
    {

        //$allcommentersinfo = [];
        if(Auth::check()) {
            $allwhoblocked = [];
            $allwhoblockeds = DB::table('blocked')->select('username')->where('blockedusername', Auth::user()->username)->get()->toArray();
            foreach ($allwhoblockeds as $awb) {
                array_push($allwhoblocked, $awb->username);
            }
            $userblock = DB::table('posts')->where('posts.id', $post_id)->first();
            if (in_array($userblock->username, $allwhoblocked)) {
                return redirect('/search')->with('error', 'Tagged user does not exist. Search or invite them to Join.');
            }
        }

        try{

        $post = DB::table('profileinfo')->join('posts', 'profileinfo.username', '=', 'posts.username')->where('posts.id', $post_id)->where('posts.deleted', false)->first();

        if(DB::table('post_votes')->where('post_id', $post_id)->exists()){
            $votes_total = DB::table('post_votes')->where('post_id', $post_id)->sum('vote');
        }

        $post_vote = 0;
        if(Auth::guest())
        {


//            $post_location = $this->postLocation($post_id);

            DB::table('posts')->where('id', $post_id)->increment('views');
            $thecomments = DB::table('profileinfo')->join('comments', 'profileinfo.username', '=', 'comments.username')->where('post_id', $post_id)->orderBy('comments.created_at', 'asc')->paginate(10);
            $now = new \DateTime();

            $totalvote = DB::table('post_votes')->where('post_id', $post_id)->sum('vote');
            $totalcomment = DB::table('comments')->where('post_id', $post_id)->count();

$online_frends = [];


            return view('post', ['post'=> $post, 'thecomments' => $thecomments, 'now'=> $now, 'online_frends'=> $online_frends, 'post_vote'=> $post_vote, 'totalvote'=> $totalvote, 'totalcomment'=> $totalcomment]);

        }
        else {
            if (DB::table('post_votes')->where([['username', Auth::user()->username], ['post_id', $post_id],])->exists()) {
                $post_vote = DB::table('post_votes')->where([['username', Auth::user()->username], ['post_id', $post_id],])->first()->vote;
            }

            $post_location = $this->postLocation($post_id);

            DB::table('posts')->where('id', $post_id)->increment('views');
            $thecomments = DB::table('profileinfo')->join('comments', 'profileinfo.username', '=', 'comments.username')->where('post_id', $post_id)->orderBy('comments.created_at', 'asc')->paginate(10);
            $now = new \DateTime();
            $online_frends = $this->getFrendsOnline();
            $totalvote = DB::table('post_votes')->where('post_id', $post_id)->sum('vote');
            $totalcomment = DB::table('comments')->where('post_id', $post_id)->count();
            DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);

            $friends = DB::table('follows')->join('users', 'follows.followsusername', '=', 'users.username')->where('follows.username', Auth::user()->username)->get();

            return view('post', ['post' => $post, 'thecomments' => $thecomments, 'now' => $now, 'online_frends' => $online_frends, 'post_vote' => $post_vote, 'totalvote' => $totalvote, 'totalcomment' => $totalcomment, 'post_location' => $post_location, 'friends' => $friends]);
        }


        }
        catch(\Exception $e){
            return redirect('/')->with('error', 'Tagged user does not exist. Search or invite them to Join.');
        }


    }

    public function updatelocation(Request $request){



        $ip= request()->ip();
//        $ip = $ip->ip();
        setcookie("ipaddress", $ip, time() + (86400 * 30), "/");
        if(Auth::check()){
            if(!is_null($request->latitude) and !is_null($request->longitude)){
                DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);
                setcookie('FG_Latitude', $request->latitude, time() + (86400 * 30), "/");
                setcookie('FG_Longitude', $request->longitude, time() + (86400 * 30), "/");
                $closeusers =  DB::table('users')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$request->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))->having('distance', '<', 0.03)->join('profileinfo', 'profileinfo.username', '=', 'users.username')->where('users.username', '!=', Auth::user()->username)->orderBy('distance')->get();

                foreach($closeusers as $user){
                    if(DB::table('notifications')->where(['username' => Auth::user()->username, 'notification' => 'bumped into', 'from_username' => $user->username, 'type' => 'bump', 'route' => $user->username, 'seen' => false])->doesntExist()) {
                        DB::table('notifications')->insert(
                            ['username' => Auth::user()->username, 'notification' => 'bumped into', 'from_username' => $user->username, 'type' => 'bump', 'route' => $user->username, 'seen' => false, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                        );
                    }

                    if(DB::table('notifications')->where(['username' => $user->username, 'notification' => 'bumped into', 'from_username' => Auth::user()->username, 'type' => 'bump', 'route' => Auth::user()->username, 'seen' => false])->doesntExist()) {
                        DB::table('notifications')->insert(
                            ['username' => $user->username, 'notification' => 'bumped into', 'from_username' => Auth::user()->username, 'type' => 'bump', 'route' => Auth::user()->username, 'seen' => false, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                        );
                    }


                }
            }
            else{
                $position = new Location();
                $latitude = $position->get($ip)->latitude;
                $longitude = $position->get($ip)->longitude;



                DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $latitude, 'longitude' => $longitude, 'updated_at' => date('Y-m-d H:i:s')]);
                setcookie('FG_Latitude', $latitude, time() + (86400 * 30), "/");
                setcookie('FG_Longitude', $longitude, time() + (86400 * 30), "/");
                $closeusers =  DB::table('users')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))->having('distance', '<', 0.03)->join('profileinfo', 'profileinfo.username', '=', 'users.username')->where('users.username', '!=', Auth::user()->username)->orderBy('distance')->get();

                foreach($closeusers as $user){
                    if(DB::table('notifications')->where(['username' => Auth::user()->username, 'notification' => 'bumped into', 'from_username' => $user->username, 'type' => 'bump', 'route' => $user->username, 'seen' => false])->doesntExist()) {
                        DB::table('notifications')->insert(
                            ['username' => Auth::user()->username, 'notification' => 'bumped into', 'from_username' => $user->username, 'type' => 'bump', 'route' => $user->username, 'seen' => false, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                        );
                    }

                    if(DB::table('notifications')->where(['username' => $user->username, 'notification' => 'bumped into', 'from_username' => Auth::user()->username, 'type' => 'bump', 'route' => Auth::user()->username, 'seen' => false])->doesntExist()) {
                        DB::table('notifications')->insert(
                            ['username' => $user->username, 'notification' => 'bumped into', 'from_username' => Auth::user()->username, 'type' => 'bump', 'route' => Auth::user()->username, 'seen' => false, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                        );
                    }


                }




            }
        }
        else{
            if(!is_null($request->latitude) and !is_null($request->longitude)){

                setcookie('FG_Latitude', $request->latitude, time() + (86400 * 30), "/");
                setcookie('FG_Longitude', $request->longitude, time() + (86400 * 30), "/");


            }
            else{
                $position = new Location();
                $latitude = $position->get($ip)->latitude;
                $longitude = $position->get($ip)->longitude;
                setcookie('FG_Latitude', $latitude, time() + (86400 * 30), "/");
                setcookie('FG_Longitude', $longitude, time() + (86400 * 30), "/");
            }
        }





    }






    public function updateLocationSwift($lat, $long){





        if(!is_null($lat) and !is_null($long)){

            setcookie('FG_Latitude', $lat, time() + (86400 * 30), "/");
            setcookie('FG_Longitude', $long, time() + (86400 * 30), "/");
            DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $lat, 'longitude' => $long, 'updated_at' => date('Y-m-d H:i:s')]);

            $closeusers =  DB::table('users')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))->having('distance', '<', 0.03)->join('profileinfo', 'profileinfo.username', '=', 'users.username')->where('users.username', '!=', Auth::user()->username)->orderBy('distance')->get();

            foreach($closeusers as $user){
                if(DB::table('notifications')->where(['username' => Auth::user()->username, 'notification' => 'bumped into', 'from_username' => $user->username, 'type' => 'bump', 'route' => $user->username, 'seen' => false])->doesntExist()) {
                    DB::table('notifications')->insert(
                        ['username' => Auth::user()->username, 'notification' => 'bumped into', 'from_username' => $user->username, 'type' => 'bump', 'route' => $user->username, 'seen' => false, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                    );
                }

                if(DB::table('notifications')->where(['username' => $user->username, 'notification' => 'bumped into', 'from_username' => Auth::user()->username, 'type' => 'bump', 'route' => Auth::user()->username, 'seen' => false])->doesntExist()) {
                    DB::table('notifications')->insert(
                        ['username' => $user->username, 'notification' => 'bumped into', 'from_username' => Auth::user()->username, 'type' => 'bump', 'route' => Auth::user()->username, 'seen' => false, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                    );
                }


            }
        }




    }



    public function deletepost($id)
    {


        DB::table('posts')->where('username', Auth::user()->username)->where('id', $id)->update(['deleted' => true]);


        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return redirect("/me")->with('status', 'post removed');
    }

    public function notifications($id)
    {


        $notifs = DB::table('notifications')->where('id', $id)->orderBy('created_at', 'asc')->get();
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();

        DB::table('notifications')->where('id', $id)->update(
            ['seen' => true, 'updated_at' => date('Y-m-d H:i:s')]
        );
        $notifcount = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->count();
        setcookie("FG_Notifications", $notifcount, time() + (86400 * 30), "/");
        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return view('notifications', ['notifs'=> $notifs, 'now'=> $now, 'online_frends'=> $online_frends]);
    }

    public function allnotifications()
    {

        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
//        $notifs = DB::table('notifications')->where('username', Auth::user()->username)->orderBy('created_at', 'asc')->get();
//        $notifs = DB::table('notifications')->where('username', $id)->get();
        $notifs = DB::table('notifications')->select('notifications.from_username as from_username', 'notifications.created_at as created_at', 'notifications.notification as notification', 'notifications.route as route', 'notifications.type as type', 'notifications.id as id', 'profileinfo.profileimage as profileimage')->leftJoin('profileinfo', 'profileinfo.username', '=', 'notifications.from_username')->where([
            ['notifications.username', Auth::user()->username],
            ['notifications.seen', false],
        ])->orderBy('notifications.created_at', 'desc')->get();

        $oldnotifs = DB::table('notifications')->select('notifications.from_username as from_username', 'notifications.created_at as created_at', 'notifications.notification as notification', 'notifications.route as route', 'notifications.type as type', 'notifications.id as id', 'profileinfo.profileimage as profileimage')->leftJoin('profileinfo', 'profileinfo.username', '=', 'notifications.from_username')->where([
            ['notifications.username', Auth::user()->username],
            ['notifications.seen', true],
        ])->orderBy('notifications.created_at', 'desc')->get();
        $notifcount = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->count();
        setcookie("FG_Notifications", $notifcount, time() + (86400 * 30), "/");

        return view('notifications', ['notifs'=> $notifs, 'oldnotifs'=> $oldnotifs, 'now'=> $now, 'online_frends'=> $online_frends]);
    }

    public function clearnotifications(){

        DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->update(['seen' => true]);



        return redirect("home")->with('status', 'Notifications cleared');
    }


    public function deletenotification($id){

        DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['id', $id],
        ])->update(['seen' => true]);



        return redirect("notification");
    }

    public function about(){
//        $now = new \DateTime();
//        $online_frends = $this->getFrendsOnline();
//        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        return view('about');
    }
    public function agreement(){
//        $now = new \DateTime();
//        $online_frends = $this->getFrendsOnline();
//        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        return view('agreement');
    }

    public function donate(){
//        $now = new \DateTime();
//        $online_frends = $this->getFrendsOnline();
//        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        return view('donate');
    }

    public function legal(){
//        $now = new \DateTime();
//        $online_frends = $this->getFrendsOnline();
//        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        return view('legal');
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
