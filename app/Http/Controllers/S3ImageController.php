<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Storage;


class S3ImageController extends Controller
{





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
        $t = Storage::disk('s3')->put($imageName, file_get_contents($image), 'public');
        $imageName = Storage::disk('s3')->url($imageName);


//        DB::table('follows')->insert(
//            ['username' => Auth::user()->username, 'followsusername' => $username]
//        );

        return back()
            ->with('success','Image Uploaded successfully.')
            ->with('path',$imageName);
    }
}