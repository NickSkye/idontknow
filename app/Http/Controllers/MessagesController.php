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
    public function messages()
    {


        $messages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', false],])->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();

        return view('messages', ['messages'=> $messages, 'friends'=>$friends]);


    }

    public function shout(Request $request)
    {

        $messages = DB::table('messages')->where([['username', Auth::user()->username], ['seen', false],])->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();

        DB::table('messages')->insert(
            ['username' => $request->sendtousername, 'from_username' => Auth::user()->username, 'message' => $request->shout, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );
        DB::table('notifications')->insert(
            ['username' => $request->sendtousername, 'notification' => 'You got a new shout', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

//        Mail::to( $request->email)->send(new NotificationMail());

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
