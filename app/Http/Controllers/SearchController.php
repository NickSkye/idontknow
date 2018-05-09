<?php

namespace App\Http\Controllers;
use App\Mail\Signup;
use Illuminate\Http\Request;
use App\Post;
use App\Page;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class SearchController extends Controller {

    public function index(Request $request)
    {

        $data = array(
            'query' => $request->query


        );
        //$users = User::all();


        $searchedusers = User::where('name', 'LIKE', '%' . $request->input('query') . '%')->orWhere('username', 'LIKE', '%' . $request->input('query') . '%')->orWhere('email', 'LIKE', '%' . $request->input('query') . '%')->get();

        return view('results')->with('searchedusers', $searchedusers);//['searchedusers'=> $searchedusers]);
    }



    public function sendinvite(Request $request){
        $user = DB::table('users')->where('username', Auth::user()->username)->first();

        Mail::to($request->email)->send(new Signup($user));
        return view('results')->with('searchedusers', $searchedusers);
    }



}

