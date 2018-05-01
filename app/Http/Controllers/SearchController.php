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




        $searchedusers = DB::table('users')->where('name', 'LIKE', "%$query%")
            ->orWhere('username', 'LIKE', "%$query%")->orWhere('email', 'LIKE', "%$query%")
            ->get();

        return view('results', ['searchedusers'=> $searchedusers]);
    }

}

