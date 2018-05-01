<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Page;



class SearchController extends Controller {

    public function index(Request $request)
    {
        $query = $request->get('query');

       // $pages = Page::where('title', 'LIKE', "%$query%")->get();

        $users = User::where('name', 'LIKE', "%$query%")
            ->orWhere('body', 'LIKE', "%$query%")
            ->get();

        return view('results', compact( 'users'));
    }

}

