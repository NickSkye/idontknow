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


class SearchController extends Controller {

    public function getFrendsOnline(){
        $friends_online = DB::table('follows')->join('users', 'follows.followsusername', '=', 'users.username')->select('users.updated_at', 'users.username')->where('follows.username', Auth::user()->username)->orderBy('users.updated_at', 'desc')->get();
        return $friends_online;
    }


    public function scopeIsWithinMaxDistance() {

        $location = DB::table('users')->select('latitude', 'longitude')->where('username', Auth::user()->username)->first();


        return $candidates = DB::table('users')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$location->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$location->longitude.') ) + sin( radians('.$location->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))->having('distance', '<', 1)->orderBy('distance')->get();
    }

    public function index(Request $request)
    {

        $data = array(
            'query' => $request->query


        );
        //$users = User::all();

        $now = new \DateTime();
        $online_frends = $this->getFrendsOnline();



        $suggest = $this->scopeIsWithinMaxDistance();

        $searchedusers = User::join('profileinfo', 'users.username', '=', 'profileinfo.username')->where('users.name', 'LIKE', '%' . $request->input('query') . '%')->orWhere('users.username', 'LIKE', '%' . $request->input('query') . '%')->orWhere('users.email', 'LIKE', '%' . $request->input('query') . '%')->paginate(10);

        return view('results', ['now'=> $now, 'online_frends'=> $online_frends, 'suggest'=> $suggest])->with('searchedusers', $searchedusers);//['searchedusers'=> $searchedusers]);
    }





    public function sendinvite(Request $request){
        $user = DB::table('users')->where('username', Auth::user()->username)->get();

        Mail::to($request->email)->send(new Signup($user));
        return redirect('/')->with('status', 'invite sent');
    }

    public function autocomplete(){
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('users')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->orWhere('username', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->first_name.' '.$query->last_name ];
        }
        return Response::json($results);
    }





}

