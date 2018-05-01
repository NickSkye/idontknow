<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class SearchController extends Controller {

    public function index(Request $request)
    {

//        $data = array(
//            'query' => $request->query
//
//
//        );
//$data['query']

        $searchedusers = DB::table('users')->where('name', 'LIKE', $request->query)
            ->orWhere('username', 'LIKE', $request->query)->orWhere('email', 'LIKE', $request->query)
            ->get();

        return view('results', ['searchedusers'=> $searchedusers]);
    }

}

