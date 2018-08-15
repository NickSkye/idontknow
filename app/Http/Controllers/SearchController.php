<?php

namespace App\Http\Controllers;
use App\Mail\Signup;
use Illuminate\Http\Request;
use App\Post;
use App\Page;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use Illuminate\Notifications\Messages\NexmoMessage;
use Nexmo\Client;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Notifications\Channels\NexmoSmsChannel;
use Symfony\Component\HttpFoundation\Session\Session;


class SearchController extends Controller {

    public function getFrendsOnline(){
        $friends_online = DB::table('follows')->join('users', 'follows.followsusername', '=', 'users.username')->select('users.updated_at', 'users.username')->where('follows.username', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();
        return $friends_online;
    }


    public function peopleWithinFiveMiles() {


        $location = DB::table('users')->select('latitude', 'longitude')->where('username', Auth::user()->username)->first();
        if(is_null($location->latitude) or is_null($location->longitude)){
                $location->latitude = 0;
                $location->longitude = 0;
        }

        return DB::table('users')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$location->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$location->longitude.') ) + sin( radians('.$location->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))->join('profileinfo', 'profileinfo.username', '=', 'users.username')
            ->whereNotIn('users.username',function($query){
            $query->select('follows.followsusername')->from('follows')->where('follows.username', Auth::user()->username);
        })->where('users.username', '!=', Auth::user()->username)->orderBy('distance')->limit(18)->get();
    }

    public function index(Request $request)
    {

        $data = array(
            'query' => $request->query


        );
        //$users = User::all();

        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();
        $allwhoblocked = array();
        $allwhoblockeds = DB::table('blocked')->select('username')->where('blockedusername', Auth::user()->username)->get()->toArray();
        foreach($allwhoblockeds as $awb){
            array_push($allwhoblocked, $awb->username);
        }

        $suggest = $this->peopleWithinFiveMiles();
        $friends = DB::table('follows')->where('username', Auth::user()->username)->get();
        $searchedusers = User::join('profileinfo', 'users.username', '=', 'profileinfo.username')->where('users.name', 'LIKE', '%' . $request->input('query') . '%')->orWhere('users.username', 'LIKE', '%' . $request->input('query') . '%')->orWhere('users.email', 'LIKE', '%' . $request->input('query') . '%')->limit(81)->paginate(10);

        return view('results', ['now'=> $now, 'online_frends'=> $online_frends, 'suggest'=> $suggest, 'friends'=> $friends, 'allwhoblocked' => $allwhoblocked])->with('searchedusers', $searchedusers);//['searchedusers'=> $searchedusers]);
    }





    public function sendinvite(Request $request){
        $this->validate($request, [
            'email' => 'required',


        ]);
        $user = DB::table('users')->where('username', Auth::user()->username)->get();

        if (DB::table('achievements')->where('username', Auth::user()->username)->where('title', 'Invited A Frend')->doesntExist()) {
            DB::table('achievements')->insert(['username' => Auth::user()->username, 'achievement' => '💌', 'title' => 'Invited A Frend', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        }

        if(is_numeric($request->email)) {
            if (strlen($request->email) == 10) {
                Nexmo::message()->send([
                    'to' => $request->email,
                    'from' => '9493038314',
                    'text' => 'Your friend ' . Auth::user()->name . ' wants to be friends with you on FrendGrid! Join Today at https://frendgrid.com/register !!! or download the mobile app for iOS at https://goo.gl/ygEdQZ !!!'
                ]);
            } else {
                Nexmo::message()->send([
                    'to' => '1' . $request->email,
                    'from' => '9493038314',
                    'text' => 'Your friend ' . Auth::user()->name . ' wants to be friends with you on FrendGrid! Join Today at https://frendgrid.com/register !!! or download the mobile app for iOS at https://goo.gl/ygEdQZ !!!'
                ]);
            }

        }
        else{
            Mail::to($request->email)->send(new Signup($user));
        }


//        $nexmo = new Client;
//        $message = $nexmo->message()->send([
//            'to' => '9493038314',
//            'text' => 'Sending SMS from Laravel. Woohoo!'
//        ]);
//        Log::info('sent message: ' . $message['message-id']);
        return redirect('/home')->with('status', 'invite sent');
    }









}

