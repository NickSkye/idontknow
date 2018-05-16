<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function addcomment(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required', //|max:2048
        ]);
        DB::table('comments')->insert(
            ['username' => Auth::user()->username, 'post_id' => $request->post_id, 'comment' => $request->comment, 'likes' => 0, 'dislikes' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);

        DB::table('posts')->where('id', $request->post_id)->update(['updated_at' => date('Y-m-d H:i:s')]);
        $user = DB::table('posts')->where('id', $request->post_id)->value('username');
        DB::table('notifications')->insert(
            ['username' => $user, 'notification' => '<a class="dropdown-item" href="/post/' . $request->post_id . '">' . ' New Comment on your post</a>', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );




//
//        // $pages = Page::where('title', 'LIKE', "%$query%")->get();
//
        return redirect('/post/' . $request->post_id);
    }




//        $thecomments = Post::where('id', $post_id)->comments();

//        foreach($thecomments as $comment){
//            $profinfos = DB::table('profileinfo')->where('username', $comment->username)->get();
//            array_push($allcommentersinfo, $profinfos);
//        }
//        $profinfos = DB::table('profileinfo')->where('id', $post_id)->get();



}
