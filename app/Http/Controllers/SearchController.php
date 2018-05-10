<?php

namespace App\Http\Controllers;
use App\Mail\Signup;
use Illuminate\Http\Request;
use App\Post;
use App\Page;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;


class SearchController extends Controller {

    public function index(Request $request)
    {

        $data = array(
            'query' => $request->query


        );
        //$users = User::all();


        $searchedusers = User::join('profileinfo', 'users.username', '=', 'profileinfo.username')->where('users.name', 'LIKE', '%' . $request->input('query') . '%')->orWhere('users.username', 'LIKE', '%' . $request->input('query') . '%')->orWhere('users.email', 'LIKE', '%' . $request->input('query') . '%')->paginate(4);

        return view('results')->with('searchedusers', $searchedusers);//['searchedusers'=> $searchedusers]);
    }

//    public function show(Request $request)
//    {
//
//        $data = array(
//            'query' => $request->query
//
//
//        );
//        //$users = User::all();
//
//
//        $searchedusers = User::where('name', 'LIKE', '%' . $request->input('query') . '%')->orWhere('username', 'LIKE', '%' . $request->input('query') . '%')->orWhere('email', 'LIKE', '%' . $request->input('query') . '%')->paginate(3);
//
//        return redirect('results')->with('searchedusers', $searchedusers);//['searchedusers'=> $searchedusers]);
//    }



    public function sendinvite(Request $request){
        $user = DB::table('users')->where('username', Auth::user()->username)->get();

        Mail::to($request->email)->send(new Signup($user));
        return redirect('/')->with('status', 'invite sent');
    }



}

