<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Storage;
use Torann\GeoIP\Facades\GeoIP;


class HomeController extends Controller
{

 /*  LIST OF COMMON DB QUERIES
  *
  * Updates the users updated at field whenever they post or comment or add or remove friend or shout
  * DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
  *
  *
  */




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getFollowingsInfo(){
        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.followsusername', '=', 'profileinfo.username')->join('users', 'follows.followsusername', '=', 'users.username')->where('follows.username', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();

        return $friends_info_full;
    }

    public function getFollowersInfo(){
        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.username', '=', 'profileinfo.username')->join('users', 'follows.username', '=', 'users.username')->where('follows.followsusername', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();

        return $friends_info_full;
    }

    public function getFrendsInfo(){
        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.username', '=', 'profileinfo.username')->join('users', 'follows.username', '=', 'users.username')->where('follows.followsusername', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();

        return $friends_info_full;
    }

    public function peopleWithinFiveMiles() {


        $location = DB::table('users')->select('latitude', 'longitude')->where('username', Auth::user()->username)->first();
        if(is_null($location->latitude) or is_null($location->longitude)){
            $location->latitude = 0;
            $location->longitude = 0;
        }

        return DB::table('users')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$location->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$location->longitude.') ) + sin( radians('.$location->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))->join('profileinfo', 'profileinfo.username', '=', 'users.username')
            ->whereNotIn('users.username',function($query){
                $query->select('follows.followsusername')->from('follows')->where('follows.username', Auth::user()->username);
            })->where('users.username', '!=', Auth::user()->username)->orderBy('distance')->limit(18)->get();
    }


    public function frendsLocation() {


        $location = DB::table('users')->select('latitude', 'longitude')->where('username', Auth::user()->username)->first();
        if(is_null($location->latitude) or is_null($location->longitude)){
            $location->latitude = 0;
            $location->longitude = 0;
        }

        return DB::table('users')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$location->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$location->longitude.') ) + sin( radians('.$location->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'), 'follows.followsusername as followsusername')->join('follows', 'follows.followsusername', '=', 'users.username')->where('follows.username', Auth::user()->username)->get();
    }


    public function getFrendsOnline(){
        $friends_online = DB::table('follows')->join('users', 'follows.followsusername', '=', 'users.username')->select('users.updated_at', 'users.username')->where('follows.username', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();
        return $friends_online;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //example creates text file and uploads to s3 bucket
//        $my_file = 'file.txt';
//        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
//        $data = 'Test data to see if this works!';
//        fwrite($handle, $data);

//        this portion sends the link to the db
//        Storage::disk('s3')->get($storagePath).
        if(is_null(DB::table('profileinfo')->where('username', Auth::user()->username)->first()) ) {
            $imageName = "https://frendgrid.s3.us-west-1.amazonaws.com/profilepics/1525299219.png";
            DB::table('profileinfo')->insert(['username' => Auth::user()->username, 'profileimage' => "https://frendgrid.s3.us-west-1.amazonaws.com/profilepics/1525299219.png", 'aboutme' => "There's nothing here yet"]);

        }

        $friendscount = DB::table('follows')->where('username', Auth::user()->username)->count();
        if($friendscount > 5) {
            if (DB::table('achievements')->where('username', Auth::user()->username)->where('title', 'First 5 Frends')->doesntExist()) {
                DB::table('achievements')->insert(['username' => Auth::user()->username, 'achievement' => '🤝', 'title' => 'First 5 Frends', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }
        if($friendscount > 25) {
            if (DB::table('achievements')->where('username', Auth::user()->username)->where('title', '25 Frends')->doesntExist()) {
                DB::table('achievements')->insert(['username' => Auth::user()->username, 'achievement' => '🤝', 'title' => '25 Frends', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }
        if($friendscount > 100) {
            if (DB::table('achievements')->where('username', Auth::user()->username)->where('title', '100 Frends')->doesntExist()) {
                DB::table('achievements')->insert(['username' => Auth::user()->username, 'achievement' => '🤝', 'title' => '100 Frends', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }



        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        $frendsloc = $this->frendsLocation();
        //all people who you follows info
        $allfriendsinfo = $this->getFollowingsInfo();
        $allfollowersinfo = $this->getFollowersInfo();
        $allwhoblocked = array();

        $suggest = $this->peopleWithinFiveMiles();
        $allwhoblockeds = DB::table('blocked')->select('username')->where('blockedusername', Auth::user()->username)->get()->toArray();
        foreach($allwhoblockeds as $awb){
            array_push($allwhoblocked, $awb->username);
        }
        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();

            $notifcount = DB::table('notifications')->where([
                ['username', Auth::user()->username],
                ['seen', false],
            ])->count();
            setcookie("FG_Notifications", $notifcount, time() + (86400 * 30), "/");
        $messagescount = DB::table('messages')->where([['messages.username', Auth::user()->username], ['seen', false],])->count();
        setcookie('FG_Shoutcount', $messagescount, time() + (86400 * 30), "/");

            return view('home', ['allfriendsinfo' => $allfriendsinfo, 'frendsloc' => $frendsloc, 'notifs'=> $notifs, 'allfollowersinfo' => $allfollowersinfo, 'now'=> $now, 'online_frends'=> $online_frends, 'allwhoblocked' => $allwhoblocked, 'suggest' => $suggest]);
        }
    }
