<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function messages()
    {

        //if (Auth::check()) {
        $messages = DB::table('messages')->where('username', Auth::user()->username)->get();

        return view('messages', ['messages'=> $messages]);
//        }
//        else{
//            return view('auth.login');
//        }

    }
}
