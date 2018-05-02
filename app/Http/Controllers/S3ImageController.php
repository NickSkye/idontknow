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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);




        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $image = $request->file('image');
        $t = Storage::disk('s3')->put("profilepics/".$imageName, file_get_contents($image), 'public');
        $imageName = Storage::disk('s3')->url("profilepics/".$imageName);


        DB::table('profileinfo')->where('username', Auth::user()->username)->updateOrInsert(
            ['username' => Auth::user()->username, 'profileimage' => $imageName, 'aboutme' => $request->aboutme]
        );

        return back()
            ->with('success','Image Uploaded successfully.')
            ->with('path',$imageName);
    }

    /**
     * Manage Post Request
     *
     * @return void
     */
    public function imageUploadPost(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);




        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $image = $request->file('image');
        $t = Storage::disk('s3')->put("posts/".$imageName, file_get_contents($image), 'public');
        $imageName = Storage::disk('s3')->url("posts/".$imageName);


        DB::table('posts')->insert(
            ['username' => Auth::user()->username, 'imagepath' => $imageName, 'description' => $request->description, 'likes' => 0, 'dislikes' => 0, 'views' => 0]
        );

        return back()
            ->with('success','Image Uploaded successfully.')
            ->with('path',$imageName);
    }
}