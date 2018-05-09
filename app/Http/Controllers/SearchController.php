<?php

namespace App\Http\Controllers;
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
        $users = User::all();


//        $searchedusers = DB::table('users')->where('name', 'LIKE', '%' . $request->input('query') . '%')->orWhere('username', 'LIKE', '%' . $request->input('query') . '%')->orWhere('email', 'LIKE', '%' . $request->input('query') . '%')->get();

        return view('results', $users);//['searchedusers'=> $searchedusers]);
    }



}

