<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class UserController extends Controller
{
    public function store(Request $request)
    {

        //example creates text file and uploads to s3 bucket
//        $my_file = 'file.txt';
//        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
//        $data = 'Test data to see if this works!';
//        fwrite($handle, $data);



//sends the photo to the uploads file on s3
        $storagePath = Storage::disk('s3')->put("uploads", $request->user_photo, 'public');

        //gets link to image on s3
//        Storage::disk('s3')->get($storagePath).


    }
}
