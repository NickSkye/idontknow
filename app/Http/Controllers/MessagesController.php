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


    public function getFrendsOnline(){
        $friends_online = DB::table('follows')->join('users', 'follows.followsusername', '=', 'users.username')->select('users.updated_at', 'users.username')->where('follows.username', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();
        return $friends_online;
    }


    public function messages()
    {


        $messages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', false],])->orderBy('created_at', 'desc')->get();
        $oldmessages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', true],])->orWhere([['from_username', Auth::user()->username],['seen', true],])->orderBy('updated_at', 'desc')->limit(50)->get();

        $friends  = $this->getFriendsInfo(); //DB::table('follows')->where('username', Auth::user()->username)->get();

       $hasfriends = $friends->isNotEmpty();
        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();

        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        $me = DB::table('users')->where('username', Auth::user()->username)->join('profileinfo', 'users.username', '=', 'profileinfo.username')->first();

        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);


        return view('messages', ['messages'=> $messages, 'oldmessages'=> $oldmessages, 'me'=> $me, 'friends'=>$friends, 'hasfriends'=>$hasfriends, 'notifs'=>$notifs, 'now'=> $now, 'online_frends'=> $online_frends ]);


    }

    public function autocomplete(){
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('users')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('username', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->first_name.' '.$query->last_name ];
        }
        return Response::json($results);
    }

    public function shout(Request $request)
    {

        $this->validate($request, [
            'shout' => 'required', //|max:2048
        ]);

        $messages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', false],])->orderBy('created_at', 'desc')->get();
        $friends = $this->getFriendsInfo(); //DB::table('follows')->where('username', Auth::user()->username)->get();

        DB::table('messages')->insert(
            ['username' => $request->sendtousername, 'from_username' => Auth::user()->username, 'message' => $request->shout, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );
        DB::table('notifications')->insert(
            ['username' => $request->sendtousername, 'notification' => '<a href="/shouts" class="dropdown-item">You got a new shout</a>', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);

        $emails = $this->getSpecificFriendsInfo($request->sendtousername);

        $getsemails = DB::table('profileinfo')->select('email_notifications')->where('username', $request->sendtousername)->first();
       if($getsemails->email_notifications){
           Mail::to($emails->email)->send(new NotificationMail());
       }


        return redirect('/shouts')->with(['messages'=> $messages, 'friends'=>$friends, 'getsemails' => $getsemails])->with('message', 'Shout delivered!');


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

        $getsemails = DB::table('profileinfo')->select('email_notifications')->where('username', $request->sendtousername)->first();
        if($getsemails->email_notifications){
            Mail::to($emails->email)->send(new NotificationMail());
        }


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


//        $email = DB::table('users')->where('username', $request->from_user)->first();
//        Mail::to($email)->send(new NotificationMail());



        return redirect('/shouts')->with(['theshout'=> $theshout, 'messages'=> $messages, 'friends'=>$friends]);


    }
}
