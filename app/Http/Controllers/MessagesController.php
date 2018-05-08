<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function messages()
    {


        $messages = DB::table('messages')->where('username', Auth::user()->username)->where('seen', false)->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();

        return view('messages', ['messages'=> $messages, 'friends'=>$friends]);


    }

    public function shout(Request $request)
    {

        $messages = DB::table('messages')->where('username', Auth::user()->username)->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();

        DB::table('messages')->insert(
            ['username' => $request->sendtousername, 'from_username' => Auth::user()->username, 'message' => $request->shout, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );
        DB::table('notifications')->insert(
            ['username' => $request->sendtousername, 'notification' => 'You got a new shout', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        return redirect('/shouts')->with(['messages'=> $messages, 'friends'=>$friends])->with('message', 'Shout delivered!');


    }

    public function getShout($shoutid)
    {

        $messages = DB::table('messages')->where('username', Auth::user()->username)->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();
        $shouts = DB::table('messages')->where('id', $shoutid)->first();



        return view('messages', ['messages'=> $messages, 'friends'=>$friends, 'shouts'=> $shouts]);


    }

    public function shoutSeen($shoutid)
    {

        $messages = DB::table('messages')->where('username', Auth::user()->username)->get();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();

        DB::table('messages')->where('id', $shoutid)->update('seen', true);

        return view('messages', ['messages'=> $messages, 'friends'=>$friends])->with('message', 'Shout delivered!');


    }
}
