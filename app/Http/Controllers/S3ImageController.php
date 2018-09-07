<?php


namespace App\Http\Controllers;

use Mail;
use App\Mail\NotificationMail;
use Illuminate\Http\Request;

use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Image;


class S3ImageController extends Controller
{

    public function getFrendsOnline()
    {
        $friends_online = DB::table('follows')->join('users', 'follows.followsusername', '=', 'users.username')->select('users.updated_at', 'users.username')->where('follows.username', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();
        return $friends_online;
    }


    public function imageUploadProfilePic(Request $request)
    {
        $this->validate($request, [
            'profimage' => 'image|mimes:jpeg,png,jpg,gif,svg', //|max:2048
        ]);

        if (is_null($request->aboutme)) {
            $request->aboutme = " ";
        }


        if ($request->hasFile('profimage')) {
            $imageName = time().'.'.$request->profimage->getClientOriginalExtension();
            $image = $request->file('profimage');
            $image = Image::make($image)->orientate();
            $image = $image->stream(null, 50);
            $t = Storage::disk('s3')->put("profilepics/".$imageName, $image->__toString(), 'public');
            $imageName = Storage::disk('s3')->url("profilepics/".$imageName);
            if (DB::table('profileinfo')->where('username', '=', Auth::user()->username)->exists()) {
                DB::table('profileinfo')->where('username', '=', Auth::user()->username)->update(
                    ['profileimage' => $imageName, 'aboutme' => $request->aboutme, 'birthday' => $request->birthday, 'email_notifications' => $request->email_notifications, 'updated_at' => date('Y-m-d H:i:s')]
                );
            }
            else {
                DB::table('profileinfo')->insert(
                    ['username' => Auth::user()->username, 'profileimage' => $imageName, 'aboutme' => $request->aboutme, 'birthday' => $request->birthday, 'created_at' => date('Y-m-d H:i:s')]
                );
            }
        }
        else {
            if (DB::table('profileinfo')->where('username', '=', Auth::user()->username)->exists()) {
                DB::table('profileinfo')->where('username', '=', Auth::user()->username)->update(
                    ['aboutme' => $request->aboutme, 'birthday' => $request->birthday, 'email_notifications' => $request->email_notifications, 'updated_at' => date('Y-m-d H:i:s')]
                );
            }
            else {
                DB::table('profileinfo')->insert(
                    ['username' => Auth::user()->username, 'aboutme' => $request->aboutme, 'birthday' => $request->birthday, 'created_at' => date('Y-m-d H:i:s')]
                );
            }

        }


        DB::table('users')->where('username', Auth::user()->username)->update(['name' => $request->name,'latitude' => $request->latitude, 'longitude' => $request->longitude, 'phonenumber' => $request->phone, 'updated_at' => date('Y-m-d H:i:s')]);

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();


        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();

        return redirect('/me')->with(['generalinfo' => $generalinfo, 'mybio' => $mybio, 'myposts' => $myposts, 'myfriends' => $myfriends])->with('success', 'Profile Updated successfully.');
    }




    public function firstUploadProfilePic(Request $request)
    {
        $this->validate($request, [
            'profimage' => 'image|mimes:jpeg,png,jpg,gif,svg', //|max:2048
        ]);




        if ($request->hasFile('profimage')) {
            $imageName = time().'.'.$request->profimage->getClientOriginalExtension();
            $image = $request->file('profimage');
            $image = Image::make($image)->orientate();
            $image = $image->stream(null, 50);
            $t = Storage::disk('s3')->put("profilepics/".$imageName, $image->__toString(), 'public');
            $imageName = Storage::disk('s3')->url("profilepics/".$imageName);
            if (DB::table('profileinfo')->where('username', '=', Auth::user()->username)->exists()) {
                DB::table('profileinfo')->where('username', '=', Auth::user()->username)->update(
                    ['profileimage' => $imageName, 'updated_at' => date('Y-m-d H:i:s')]
                );
            }
            else {
                $profileinfo = $this->getMySettingsInfo();
                $online_frends = $this->getFrendsOnline();
                return view('newUserAbout', ['profileinfo' => $profileinfo, 'online_frends' => $online_frends]);
            }
        }



        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();


        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();

        return redirect('/me')->with(['generalinfo' => $generalinfo, 'mybio' => $mybio, 'myposts' => $myposts, 'myfriends' => $myfriends])->with('success', 'Profile Updated successfully.');
    }

    /**
     * Manage Post Request
     *
     * @return void
     */
    public function imageUploadPost(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg', //|max:2048
        ]);

        //checks if description and image empty then redirects back
        if (is_null($request->description)) {
            $request->description = " ";

            if (!$request->hasFile('image')) {
                return redirect('/')->with('error', 'Post must either contain text or image');
            }
        }


//        $('body').text()
// create an image manager instance with favored driver


//IF HAS IMAGE DO SOMETHING, IF JUST TEXT DO SOMETHING ELSE
        if ($request->hasFile('image')) {
            //
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image = $request->file('image');
            if ($request->image->getClientOriginalExtension() == 'gif') {
                $t = Storage::disk('s3')->put("posts/".$imageName, file_get_contents($image), 'public');
                $imageName = Storage::disk('s3')->url("posts/".$imageName);
            }
            else {
                $image = Image::make($image)->orientate();

                $image = $image->stream(null, 50);

                $t = Storage::disk('s3')->put("posts/".$imageName, $image->__toString(), 'public');
                $imageName = Storage::disk('s3')->url("posts/".$imageName);
            }
        }
        else {
            $imageName = null;
        }


//upload post
        DB::table('posts')->insert(
            ['username' => Auth::user()->username, 'imagepath' => $imageName, 'description' => $request->description, 'views' => 1, 'votes' => 1, 'latitude' => $request->latitude, 'longitude' => $request->longitude, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        $post_id = DB::table('posts')->where('username', Auth::user()->username)->orderBy('id', 'desc')->first();

        DB::table('post_votes')->insert(['username' => Auth::user()->username, 'post_id' => $post_id->id, 'vote' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('users')->where('username', Auth::user()->username)->increment('score', 10);
        //update location
        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();


        $this_post = DB::table('posts')->where('username', Auth::user()->username)->latest()->first();
        preg_match_all('/@([\w\-]+)/', $request->description, $thedescription);


        if (!is_null($thedescription)) {
            foreach ($thedescription[1] as $users) {
                try {
                    DB::table('notifications')->insert(
                        ['username' => $users, 'notification' => $request->description, 'from_username' => Auth::user()->username, 'type' => 'postmention', 'route' => $post_id->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                    );
                    $email = DB::table('users')->where('username', $users)->first();


                    $getsemails = DB::table('profileinfo')->select('email_notifications')->where('username', $users)->first();
                    if ($getsemails->email_notifications) {
                        Mail::to($email->email)->send(new NotificationMail());
                    }
                }
                catch (\Exception $e) {

                }
            }
        }

        $postcount = DB::table('posts')->where('username', Auth::user()->username)->where('deleted', false)->count();
        if ($postcount > 4) {
            if (DB::table('achievements')->where('username', Auth::user()->username)->where('title', 'First 5 Posts')->doesntExist()) {
                DB::table('achievements')->insert(['username' => Auth::user()->username, 'achievement' => '✍️', 'title' => 'First 5 Posts', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }
        if ($postcount > 24) {
            if (DB::table('achievements')->where('username', Auth::user()->username)->where('title', '25 Posts')->doesntExist()) {
                DB::table('achievements')->insert(['username' => Auth::user()->username, 'achievement' => '✍️', 'title' => '25 Posts', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }
        if ($postcount > 99) {
            if (DB::table('achievements')->where('username', Auth::user()->username)->where('title', '100 Posts')->doesntExist()) {
                DB::table('achievements')->insert(['username' => Auth::user()->username, 'achievement' => '✍️', 'title' => '100 Posts', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }


        return redirect('/me')->with(['generalinfo' => $generalinfo, 'mybio' => $mybio, 'myposts' => $myposts, 'myfriends' => $myfriends])->with('success', 'Image Uploaded successfully.')->with('path', $imageName);


    }



    public function hangout(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg', //|max:2048
        ]);

        //checks if description and image empty then redirects back
        if (is_null($request->description)) {
            $request->description = " ";

            if (!$request->hasFile('image')) {
                return redirect('/')->with('error', 'Post must either contain text or image');
            }
        }


//        $('body').text()
// create an image manager instance with favored driver


//IF HAS IMAGE DO SOMETHING, IF JUST TEXT DO SOMETHING ELSE
        if ($request->hasFile('image')) {
            //
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image = $request->file('image');
            if ($request->image->getClientOriginalExtension() == 'gif') {
                $t = Storage::disk('s3')->put("posts/".$imageName, file_get_contents($image), 'public');
                $imageName = Storage::disk('s3')->url("posts/".$imageName);
            }
            else {
                $image = Image::make($image)->orientate();
                $image = $image->stream();
                $t = Storage::disk('s3')->put("posts/".$imageName, $image->__toString(), 'public');
                $imageName = Storage::disk('s3')->url("posts/".$imageName);
            }
        }
        else {
            $imageName = null;
        }


//upload post
        DB::table('posts')->insert(
            ['username' => Auth::user()->username, 'imagepath' => $imageName, 'description' => $request->description, 'views' => 1, 'votes' => 1, 'latitude' => $request->latitude, 'longitude' => $request->longitude, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        $post_id = DB::table('posts')->where('username', Auth::user()->username)->orderBy('id', 'desc')->first();

        DB::table('post_votes')->insert(['username' => Auth::user()->username, 'post_id' => $post_id->id, 'vote' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        DB::table('users')->where('username', Auth::user()->username)->increment('score', 50);
        //update location
        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();


        $this_post = DB::table('posts')->where('username', Auth::user()->username)->latest()->first();
        preg_match_all('/@([\w\-]+)/', $request->description, $thedescription);


        if (!is_null($thedescription)) {
            foreach ($thedescription[1] as $users) {
                try {
                    DB::table('notifications')->insert(
                        ['username' => $users, 'notification' => $request->description, 'from_username' => Auth::user()->username, 'type' => 'postmention', 'route' => $post_id->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                    );
                    $email = DB::table('users')->where('username', $users)->first();


                    $getsemails = DB::table('profileinfo')->select('email_notifications')->where('username', $users)->first();
                    if ($getsemails->email_notifications) {
                        Mail::to($email->email)->send(new NotificationMail());
                    }
                }
                catch (\Exception $e) {

                }
            }
        }

        $postcount = DB::table('posts')->where('username', Auth::user()->username)->where('deleted', false)->count();
        if ($postcount > 4) {
            if (DB::table('achievements')->where('username', Auth::user()->username)->where('title', 'First 5 Posts')->doesntExist()) {
                DB::table('achievements')->insert(['username' => Auth::user()->username, 'achievement' => '✍️', 'title' => 'First 5 Posts', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }
        if ($postcount > 24) {
            if (DB::table('achievements')->where('username', Auth::user()->username)->where('title', '25 Posts')->doesntExist()) {
                DB::table('achievements')->insert(['username' => Auth::user()->username, 'achievement' => '✍️', 'title' => '25 Posts', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }
        if ($postcount > 99) {
            if (DB::table('achievements')->where('username', Auth::user()->username)->where('title', '100 Posts')->doesntExist()) {
                DB::table('achievements')->insert(['username' => Auth::user()->username, 'achievement' => '✍️', 'title' => '100 Posts', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }
        }


        return redirect('/me')->with(['generalinfo' => $generalinfo, 'mybio' => $mybio, 'myposts' => $myposts, 'myfriends' => $myfriends])->with('success', 'Image Uploaded successfully.')->with('path', $imageName);


    }



    public function imageEditPost(Request $request)
    {

        /*
         * STEPS TO EDIT POST
         */

        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg', //|max:2048
        ]);

        //checks if description and image empty then redirects back
        if (is_null($request->description)) {
            $request->description = " ";

            if (!$request->hasFile('image') and is_null($request->oldimage)) {
                return redirect('/')->with('error', 'Post must either contain text or image');
            }
        }


//        $('body').text()
// create an image manager instance with favored driver


//IF HAS IMAGE DO SOMETHING, IF JUST TEXT DO SOMETHING ELSE
        if ($request->hasFile('image')) {
            //
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image = $request->file('image');
            if ($request->image->getClientOriginalExtension() == 'gif') {
                $t = Storage::disk('s3')->put("posts/".$imageName, file_get_contents($image), 'public');
                $imageName = Storage::disk('s3')->url("posts/".$imageName);
            }
            else {
                $image = Image::make($image)->orientate();
                $image = $image->stream();
                $t = Storage::disk('s3')->put("posts/".$imageName, $image->__toString(), 'public');
                $imageName = Storage::disk('s3')->url("posts/".$imageName);
            }


        }
        else {
            $imageName = $request->oldimage;
        }


//upload post


        DB::table('posts')->where('id', $request->id)->update(
            ['imagepath' => $imageName, 'description' => $request->description, 'latitude' => $request->latitude, 'longitude' => $request->longitude, 'edited' => true, 'updated_at' => date('Y-m-d H:i:s')]
        );

        //update location
        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();


        $this_post = DB::table('posts')->where('username', Auth::user()->username)->latest()->first();
        preg_match_all('/@([\w\-]+)/', $request->description, $thedescription);


        if (!is_null($thedescription)) {
            foreach ($thedescription[1] as $users) {
                try {
                    DB::table('notifications')->insert(
                        ['username' => $users, 'notification' => $request->description, 'from_username' => Auth::user()->username, 'type' => 'postmention', 'route' => $request->id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                    );
                    $email = DB::table('users')->where('username', $users)->first();


                    $getsemails = DB::table('profileinfo')->select('email_notifications')->where('username', $users)->first();
                    if ($getsemails->email_notifications) {
                        Mail::to($email->email)->send(new NotificationMail());
                    }
                }
                catch (\Exception $e) {

                }
            }
        }




        return redirect('/me')->with(['generalinfo' => $generalinfo, 'mybio' => $mybio, 'myposts' => $myposts, 'myfriends' => $myfriends])->with('success', 'Image Uploaded successfully.');


    }
}