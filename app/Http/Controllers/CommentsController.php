<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function addcomment(Request $request)
    {
        DB::table('comments')->insert(
            ['username' => Auth::user()->username, 'post_id' => $request->post_id, 'comment' => $request->comment, 'likes' => 0, 'dislikes' => 0]
        );
//
//        // $pages = Page::where('title', 'LIKE', "%$query%")->get();
//
        return redirect()->back();
    }
}
