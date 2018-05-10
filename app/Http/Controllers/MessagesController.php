<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;




use Illuminate\Mail\Mailer;

class MessagesController extends Controller
{

    public function getFriendsInfo(){
        $friends_info_full = DB::table('follows')->join('profileinfo', 'follows.followsusername', '=', 'profileinfo.username')->join('users', 'follows.followsusername', '=', 'users.username')->where('follows.username', Auth::user()->username)->get();

        return $friends_info_full;
    }

    public function getSpecificFriendsInfo($friendsusername){
        $friends_info_full = DB::table('users')->join('profileinfo', 'users.username', '=', 'profileinfo.username')->where('users.username', $friendsusername)->first();

        return $friends_info_full;
    }



    public function messages()
    {


        $messages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', false],])->get();
        $friends  = $this->getFriendsInfo(); //DB::table('follows')->where('username', Auth::user()->username)->get();

       $hasfriends = $friends->isNotEmpty();

        return view('messages', ['messages'=> $messages, 'friends'=>$friends, 'hasfriends'=>$hasfriends]);


    }

    public function shout(Request $request)
    {

        $messages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', false],])->get();
        $friends = $this->getFriendsInfo(); //DB::table('follows')->where('username', Auth::user()->username)->get();

        DB::table('messages')->insert(
            ['username' => $request->sendtousername, 'from_username' => Auth::user()->username, 'message' => $request->shout, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );
        DB::table('notifications')->insert(
            ['username' => $request->sendtousername, 'notification' => '<a href="/shouts">You got a new shout</a>', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        $emails = $this->getSpecificFriendsInfo($request->sendtousername);


       Mail::to($emails->email)->send(new NotificationMail());

        return redirect('/shouts')->with(['messages'=> $messages, 'friends'=>$friends])->with('message', 'Shout delivered!');


    }

    public function shoutonpage(Request $request)
    {

        $messages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', false],])->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();

        DB::table('messages')->insert(
            ['username' => $request->sendtousername, 'from_username' => Auth::user()->username, 'message' => $request->shout, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );
        DB::table('notifications')->insert(
            ['username' => $request->sendtousername, 'notification' => 'You got a new shout', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        $emails = $this->getSpecificFriendsInfo($request->sendtousername);


        Mail::to($emails->email)->send(new NotificationMail());

        return redirect()->back()->with(['messages'=> $messages, 'friends'=>$friends])->with('message', 'Shout delivered!');


    }

    public function getShout(Request $request)
    {
        $messages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', false],])->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();
        $theshout = DB::table('messages')->where('id', $request->shoutid)->get();
        DB::table('messages')->where('id', $request->shoutid)->update(
            ['seen' => true,'updated_at' => date('Y-m-d H:i:s')]
        );



        return view('messages', ['theshout'=> $theshout, 'messages'=> $messages, 'friends'=>$friends]);


    }

    public function shoutSeen(Request $request)
    {

        $messages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', false],])->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();
        $theshout = DB::table('messages')->where('id', $request->shoutid)->get();
        DB::table('messages')->where('id', $request->shoutid)->update(
            ['seen' => true,'updated_at' => date('Y-m-d H:i:s')]
        );



        return redirect('/shouts')->with(['theshout'=> $theshout, 'messages'=> $messages, 'friends'=>$friends]);


    }
}
