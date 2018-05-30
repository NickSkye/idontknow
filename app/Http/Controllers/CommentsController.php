<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\NotificationMail;

class CommentsController extends Controller
{

    public function getFrendsOnline(){
        $friends_online = DB::table('follows')->join('users', 'follows.followsusername', '=', 'users.username')->select('users.updated_at', 'users.username')->where('follows.username', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();
        return $friends_online;
    }

    public function addcomment(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required', //|max:2048
        ]);
        DB::table('comments')->insert(
            ['username' => Auth::user()->username, 'post_id' => $request->post_id, 'comment' => $request->comment, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);


        $totalcomment = DB::table('comments')->where('post_id', $request->post_id)->sum('number');


        DB::table('posts')->where('id', $request->post_id)->update(['comments' => $totalcomment, 'updated_at' => date('Y-m-d H:i:s')]);
        $user = DB::table('posts')->where('id', $request->post_id)->value('username');
        DB::table('notifications')->insert(
            ['username' => $user, 'notification' => $request->comment, 'from_username' => Auth::user()->username, 'type' => 'comment', 'route' => $request->post_id ,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );




        $this_post = DB::table('posts')->where('id', $request->post_id)->first();
        preg_match_all('/@([\w\-]+)/', $request->comment, $thedescription);

        if(!is_null($thedescription)){
            foreach($thedescription[1] as $users){
                try {
                    DB::table('notifications')->insert(
                        ['username' => $users, 'notification' => $request->comment, 'from_username' => Auth::user()->username, 'type' => 'commentmention', 'route' => $request->post_id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                    );
                    $email = DB::table('users')->where('username', $users)->first();


                    $getsemails = DB::table('profileinfo')->select('email_notifications')->where('username', $users)->first();
                    if ($getsemails->email_notifications) {
                        Mail::to($email->email)->send(new NotificationMail());
                    }
                }
                catch(\Exception $e){

                }

            }
        }


        return redirect('/post/' . $request->post_id);

    }



    public function addactivitycomment(Request $request)
    {

        $this->validate($request, [
            'comment' => 'required', //|max:2048
        ]);
        DB::table('comments')->insert(
            ['username' => Auth::user()->username, 'post_id' => $request->post_id, 'comment' => $request->comment, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);


        $totalcomment = DB::table('comments')->where('post_id', $request->post_id)->sum('number');


        DB::table('posts')->where('id', $request->post_id)->update(['comments' => $totalcomment, 'updated_at' => date('Y-m-d H:i:s')]);
        $user = DB::table('posts')->where('id', $request->post_id)->value('username');
        DB::table('notifications')->insert(
            ['username' => $user, 'notification' => $request->comment, 'from_username' => Auth::user()->username, 'type' => 'comment', 'route' => $request->post_id ,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        $this_post = DB::table('posts')->where('id', $request->post_id)->first();
        preg_match_all('/@([\w\-]+)/', $request->comment, $thedescription);

        if(!is_null($thedescription)){
            foreach($thedescription[1] as $users){
                try {
                    DB::table('notifications')->insert(
                        ['username' => $user, 'notification' => $request->comment, 'from_username' => Auth::user()->username, 'type' => 'commentmention', 'route' => $request->post_id ,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                    );
                    $email = DB::table('users')->where('username', $users)->first();


                    $getsemails = DB::table('profileinfo')->select('email_notifications')->where('username', $users)->first();
                    if ($getsemails->email_notifications) {
                        Mail::to($email->email)->send(new NotificationMail());
                    }
                }
                catch(\Exception $e){

                }
            }
        }

        return response([$request->post_id]);

    }





}
