<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class S3ImageController extends Controller
{



    public function imageUploadProfilePic(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg', //|max:2048
        ]);

        if(is_null($request->aboutme)){
            $request->aboutme = " ";
        }


        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image = $request->file('image');
            $t = Storage::disk('s3')->put("profilepics/".$imageName, file_get_contents($image), 'public');
            $imageName = Storage::disk('s3')->url("profilepics/".$imageName);
            if (DB::table('profileinfo')->where('username', '=', Auth::user()->username)->exists()) {
                DB::table('profileinfo')->where('username', '=', Auth::user()->username)->update(
                    ['profileimage' => $imageName, 'aboutme' => $request->aboutme, 'birthday' => $request->birthday, 'email_notifications'=> $request->email_notifications, 'updated_at' => date('Y-m-d H:i:s')]
                );
            }else{
                DB::table('profileinfo')->insert(
                    ['username' => Auth::user()->username, 'profileimage' => $imageName, 'aboutme' => $request->aboutme, 'birthday' => $request->birthday, 'created_at' => date('Y-m-d H:i:s')]
                );
            }
        } else{
            if (DB::table('profileinfo')->where('username', '=', Auth::user()->username)->exists()) {
                DB::table('profileinfo')->where('username', '=', Auth::user()->username)->update(
                    ['aboutme' => $request->aboutme, 'birthday' => $request->birthday, 'email_notifications'=> $request->email_notifications, 'updated_at' => date('Y-m-d H:i:s')]
                );
            }else{
                DB::table('profileinfo')->insert(
                    ['username' => Auth::user()->username, 'aboutme' => $request->aboutme, 'birthday' => $request->birthday,  'created_at' => date('Y-m-d H:i:s')]
                );
            }

        }


        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'phonenumber'=> $request->phone, 'updated_at' => date('Y-m-d H:i:s')]);

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();

        return redirect('/me')->with( ['generalinfo'=> $generalinfo, 'mybio'=> $mybio,'myposts'=> $myposts,'myfriends'=> $myfriends])->with('success','Profile Updated successfully.');
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
        if(is_null($request->description)){
            $request->description = " ";

            if (!$request->hasFile('image')) {
                return redirect('/')->with('error','Post must either contain text or image');
            }
        }




//IF HAS IMAGE DO SOMETHING, IF JUST TEXT DO SOMETHING ELSE
if ($request->hasFile('image')) {
    //
    $imageName = time().'.'.$request->image->getClientOriginalExtension();
    $image = $request->file('image');
    $t = Storage::disk('s3')->put("posts/".$imageName, file_get_contents($image), 'public');
    $imageName = Storage::disk('s3')->url("posts/".$imageName);
} else{
    $imageName = null;
}


//upload post
        DB::table('posts')->insert(
            ['username' => Auth::user()->username, 'imagepath' => $imageName, 'description' => $request->description, 'likes' => 0, 'dislikes' => 0, 'views' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

        //update location
        DB::table('users')->where('username', Auth::user()->username)->update(['latitude' => $request->latitude, 'longitude' => $request->longitude, 'updated_at' => date('Y-m-d H:i:s')]);

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();


        return redirect('/me')->with(['generalinfo'=> $generalinfo, 'mybio'=> $mybio,'myposts'=> $myposts,'myfriends'=> $myfriends])->with('success','Image Uploaded successfully.')->with('path',$imageName);


    }
}