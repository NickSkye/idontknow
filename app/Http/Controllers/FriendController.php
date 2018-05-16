<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use Storage;
use App\Mail\NotificationMail;
use App\Mail\AddFrendMail;

class FriendController extends Controller
{


    public function getFriendsInfoWithPosts(){
        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.followsusername', '=', 'profileinfo.username')->join('users', 'follows.followsusername', '=', 'users.username')->join('posts', 'follows.followsusername', '=', 'posts.username')->where('follows.username', Auth::user()->username)->where('deleted', false)->orderBy('posts.created_at', 'desc')->paginate(10);; //'posts.updated_at'

        return $friends_info_full;
    }

    public function getSpecificFriendsInfo($friendsusername){
        $friends_info_full = DB::table('profileinfo')->join('users', 'profileinfo.username', '=', 'users.username')->where('users.username', $friendsusername)->get();

        return $friends_info_full;
    }

    public function index($username)
    {
//        $info = DB::table('users')->where('username', $username)->get();
            $info = $this->getSpecificFriendsInfo($username);
        $arefriends = false;
        // $pages = Page::where('title', 'LIKE', "%$query%")->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();
        $friendsposts = DB::table('posts')->where('username', $username)->where('deleted', false)->orderBy('created_at', 'desc')->get();

        //User follow and post meta data
        $numfollowers = DB::table('follows')->where('followsusername', $username)->count();
        $numposts = DB::table('posts')->where('username', $username)->where('deleted', false)->count();
        $numfollowing = DB::table('follows')->where('username', $username)->count();
        //$friendsinfo = DB::table('profileinfo')->where('username', $username)->get();
        foreach($info as $item) {
            foreach ($friends as $friend) {
                if ($item->username === $friend->followsusername) {
                    $arefriends = true;

                    return view('friendspage', ['info'=> $info, 'arefriends'=> $arefriends, 'friendsposts'=> $friendsposts, 'numfollowers'=> $numfollowers, 'numposts'=> $numposts, 'numfollowing'=> $numfollowing]);
                }

            }
        }




        return view('friendspage', ['info'=> $info, 'arefriends'=> $arefriends, 'friendsposts'=> $friendsposts, 'numfollowers'=> $numfollowers, 'numposts'=> $numposts, 'numfollowing'=> $numfollowing]);


    }

    public function add($username)
    {
        DB::table('follows')->insert(
            ['username' => Auth::user()->username, 'followsusername' => $username, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        // $pages = Page::where('title', 'LIKE', "%$query%")->get();
//        $user = DB::table('posts')->where('id', $request->post_id)->value('username');
        DB::table('notifications')->insert(
            ['username' => $username, 'notification' => '<a class="dropdown-item" href="/users/' . Auth::user()->username . '">' . Auth::user()->username . ' added you as a friend</a>', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);

        $email = DB::table('users')->where('username', $username)->first();


        $getsemails = DB::table('profileinfo')->select('get_email_notifications')->where('username', $username)->first();
        if($getsemails){
            Mail::to($email->email)->send(new AddFrendMail());
        }


        return redirect("home")->with('status', 'friend added');
    }

    public function remove($username)
    {


       DB::table('follows')->where('username', Auth::user()->username)->where('followsusername', $username)->delete();
        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);

        // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        return redirect("home")->with('status', 'friend removed');
    }
}
