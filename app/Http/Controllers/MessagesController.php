<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use Nexmo\Client;
use Nexmo\Laravel\Facade\Nexmo;



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


        $messages = DB::table('messages')->select('messages.id as id', 'messages.from_username as from_username' , 'messages.username as username', 'messages.message as message', 'messages.created_at as created_at', 'messages.updated_at as updated_at', 'profileinfo.profileimage as profileimage')->join('profileinfo', 'messages.from_username', '=', 'profileinfo.username')->join('users', 'messages.from_username', '=', 'users.username')->where([['messages.username', Auth::user()->username], ['seen', false],])->orderBy('messages.created_at', 'desc')->get();



        $sentmessages = DB::table('messages')->select('messages.id as id', 'messages.from_username as from_username' , 'messages.username as username', 'messages.message as message', 'messages.created_at as created_at', 'messages.updated_at as updated_at', 'profileinfo.profileimage as profileimage')->join('profileinfo', 'messages.from_username', '=', 'profileinfo.username')->join('users', 'messages.from_username', '=', 'users.username')->where([['messages.from_username', Auth::user()->username],['seen', false],])->orderBy('messages.created_at', 'desc')->limit(50)->get();

        $oldmessages = DB::table('messages')->select('messages.id as id', 'messages.from_username as from_username' , 'messages.username as username', 'messages.message as message', 'messages.created_at as created_at', 'messages.updated_at as updated_at', 'profileinfo.profileimage as profileimage')->join('profileinfo', 'messages.from_username', '=', 'profileinfo.username')->join('users', 'messages.from_username', '=', 'users.username')->where([['messages.username', Auth::user()->username], ['seen', true],])->orWhere([['messages.from_username', Auth::user()->username],['seen', true],])->orderBy('messages.updated_at', 'desc')->limit(50)->get();


        $friends  = $this->getFriendsInfo(); //DB::table('follows')->where('username', Auth::user()->username)->get();
//        $friends = DB::table('follows')->select('username')->where('followsusername', Auth::user()->username)->union($friendss)->get();

//        $friendstoshout = DB::table('follows')->join('profileinfo', 'follows.followsusername', '=', 'profileinfo.username')->join('users', 'follows.followsusername', '=', 'users.username')->where('follows.username', Auth::user()->username)->orWhere('followsusername', Auth::user()->username)->get();

       $hasfriends = $friends->isNotEmpty();
        $notifs = DB::table('notifications')->where([
            ['username', Auth::user()->username],
            ['seen', false],
        ])->get();

        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        $me = DB::table('users')->join('profileinfo', 'users.username', '=', 'profileinfo.username')->where('users.username', Auth::user()->username)->first();

        DB::table('users')->where('username', Auth::user()->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        $messagescount = DB::table('messages')->where([['messages.username', Auth::user()->username], ['seen', false],])->count();
        setcookie('FG_Shoutcount', $messagescount, time() + (86400 * 30), "/");

        return view('messages', ['messages'=> $messages, 'oldmessages'=> $oldmessages,'sentmessages'=> $sentmessages, 'me'=> $me, 'friends'=>$friends, 'hasfriends'=>$hasfriends, 'notifs'=>$notifs, 'now'=> $now, 'online_frends'=> $online_frends ]);


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
        $phonenum = DB::table('users')->select('phonenumber')->where('username', $request->sendtousername)->first();
        $friends = $this->getFriendsInfo(); //DB::table('follows')->where('username', Auth::user()->username)->get();

        DB::table('messages')->insert(
            ['username' => $request->sendtousername, 'from_username' => Auth::user()->username, 'message' => $request->shout, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );
        DB::table('notifications')->insert(
            ['username' => $request->sendtousername, 'notification' => 'shout', 'from_username' => Auth::user()->username, 'type' => 'shout', 'route' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);

        $emails = $this->getSpecificFriendsInfo($request->sendtousername);

        $getsemails = DB::table('profileinfo')->select('email_notifications')->where('username', $request->sendtousername)->first();
       if($getsemails->email_notifications){
           Mail::to($emails->email)->send(new NotificationMail());
       }
        $user = DB::table('users')->where('username', Auth::user()->username)->get();

        if ( !is_null($phonenum->phonenumber) ) {


            Nexmo::message()->send([
                'to' => $phonenum->phonenumber,
                'from' => '19493403561',
                'text' => 'Your friend ' . Auth::user()->username . ' sent you a message https://frendgrid.com/shouts !'
            ]);
        }
        DB::table('users')->where('username', Auth::user()->username)->increment('score', 2);


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
            ['username' => $request->sendtousername, 'notification' => 'shout', 'from_username' => Auth::user()->username, 'type' => 'shout', 'route' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        $emails = $this->getSpecificFriendsInfo($request->sendtousername);

        $getsemails = DB::table('profileinfo')->select('email_notifications')->where('username', $request->sendtousername)->first();
        if($getsemails->email_notifications){
            Mail::to($emails->email)->send(new NotificationMail());
        }

        DB::table('users')->where('username', Auth::user()->username)->increment('score', 2);

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

    public function shoutBack(Request $request)
    {

//        $messages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', false],])->get();
//        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();
//        $theshout = DB::table('messages')->where('id', $request->shoutid)->get();
        DB::table('messages')->where('id', $request->shoutid)->update(
            ['seen' => true,'updated_at' => date('Y-m-d H:i:s')]
        );


//        $email = DB::table('users')->where('username', $request->from_user)->first();
//        Mail::to($email)->send(new NotificationMail());
        DB::table('users')->where('username', Auth::user()->username)->increment('score', 2);


        return response([$request->shoutid, $request->from_user]);


    }



    public function localchat(){
        if(!isset($_COOKIE["FG_LocalChat_Distance"])) {
            setcookie("FG_LocalChat_Distance", 100, time() + (86400 * 30), "/");
        }

        if(isset($_COOKIE['FG_Latitude']) && isset($_COOKIE['FG_Longitude']))  {
            $messages = DB::table('localchats')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$_COOKIE['FG_Latitude'].') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$_COOKIE['FG_Longitude'].') ) + sin( radians('.$_COOKIE['FG_Latitude'].') ) * sin( radians( latitude ) ) ) ) AS distance'))->having('distance', '<=', '100')->get();
        } else if(Auth::check()){
            $latitude = DB::table('users')->select('latitude')->where(['username', Auth::user()->username])->first;
            $longitude = DB::table('users')->select('longitude')->where(['username', Auth::user()->username])->first;
            $messages = DB::table('localchats')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))->having('distance', '<=', '100')->get();
        }
        else{
            return redirect('/register');
        }

        return view('localchat', ['messages' => $messages]);
    }

    public function setdistance(Request $request){
        setcookie("FG_LocalChat_Distance", $request->distance, time() + (86400 * 30), "/");
        if(isset($_COOKIE['FG_Latitude']) && isset($_COOKIE['FG_Longitude']))  {
            $messages = DB::table('localchats')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$_COOKIE['FG_Latitude'].') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$_COOKIE['FG_Longitude'].') ) + sin( radians('.$_COOKIE['FG_Latitude'].') ) * sin( radians( latitude ) ) ) ) AS distance'))->having('distance', '<=', $request->distance)->get();
        } else {
            $messages = DB::table('localchats')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$request->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))->having('distance', '<=', $request->distance)->get();
        }

    }
    public function sendlocalchat(Request $request){
        if(Auth::check()){
            DB::table('localchats')->insert(['username'=> Auth::user()->username, 'message'=> $request->localchat, 'latitude'=> $request->latitude, 'longitude'=> $request->longitude, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        }
        else{
            DB::table('localchats')->insert(['username'=> 'Anon', 'message'=> $request->localchat, 'latitude'=> $request->latitude, 'longitude'=> $request->longitude, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        }

//        return response([$request->localchat]);
        $messages = DB::table('localchats')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$request->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))->having('distance', '<=', $_COOKIE['FG_Latitude'])->get();
        return redirect('localchat')->with( ['messages' => $messages]);
    }
}
