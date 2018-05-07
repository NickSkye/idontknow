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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg', //|max:2048
        ]);

        if(is_null($request->aboutme)){
            $request->aboutme = " ";
        }



        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $image = $request->file('image');
        $t = Storage::disk('s3')->put("profilepics/".$imageName, file_get_contents($image), 'public');
        $imageName = Storage::disk('s3')->url("profilepics/".$imageName);

        if (DB::table('profileinfo')->where('username', '=', Auth::user()->username)->exists()) {
            DB::table('profileinfo')->where('username', '=', Auth::user()->username)->update(
                ['profileimage' => $imageName, 'aboutme' => $request->aboutme]
            );
        }else{
            DB::table('profileinfo')->insert(
                ['username' => Auth::user()->username, 'profileimage' => $imageName, 'aboutme' => $request->aboutme]
            );
        }

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();

        return view('myprofile', ['generalinfo'=> $generalinfo, 'mybio'=> $mybio,'myposts'=> $myposts,'myfriends'=> $myfriends])->with('success','Profile Image Uploaded successfully.')->with('path',$imageName);
    }

    /**
     * Manage Post Request
     *
     * @return void
     */
    public function imageUploadPost(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg', //|max:2048
        ]);

        if(is_null($request->description)){
            $request->description = " ";
        }


        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $image = $request->file('image');
        $t = Storage::disk('s3')->put("posts/".$imageName, file_get_contents($image), 'public');
        $imageName = Storage::disk('s3')->url("posts/".$imageName);


        DB::table('posts')->insert(
            ['username' => Auth::user()->username, 'imagepath' => $imageName, 'description' => $request->description, 'likes' => 0, 'dislikes' => 0, 'views' => 0]
        );

        $generalinfo = DB::table('users')->where('username', Auth::user()->username)->get();
        $mybio = DB::table('profileinfo')->where('username', Auth::user()->username)->get();
        $myposts = DB::table('posts')->where('username', Auth::user()->username)->get();
        $myfriends = DB::table('follows')->where('username', Auth::user()->username)->get();


        return view('myprofile', ['generalinfo'=> $generalinfo, 'mybio'=> $mybio,'myposts'=> $myposts,'myfriends'=> $myfriends])->with('success','Image Uploaded successfully.')->with('path',$imageName);


    }
}