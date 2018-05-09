<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function addcomment(Request $request)
    {
        DB::table('comments')->insert(
            ['username' => Auth::user()->username, 'post_id' => $request->post_id, 'comment' => $request->comment, 'likes' => 0, 'dislikes' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        DB::table('posts')->where('id', $request->post_id)->update(['updated_at' => date('Y-m-d H:i:s')]);
        $user = DB::table('posts')->where('id', $request->post_id)->value('username');
        DB::table('notifications')->insert(
            ['username' => $user, 'notification' => 'New comment on your post ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );
//
//        // $pages = Page::where('title', 'LIKE', "%$query%")->get();
//
        return redirect()->back();
    }


}
