<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;

use Nexmo\Laravel\Facade\Nexmo;
use Stevebauman\Location\Position;
use Stevebauman\Location\Drivers\Driver;
use Stevebauman\Location\Location;
use Stevenmaguire\OAuth2\Client\Provider;
use GuzzleHttp\Client;
class DashboardController extends Controller
{
    public function aroundme(){


        if(isset($_COOKIE['FG_Latitude']) && isset($_COOKIE['FG_Longitude']))  {
            $lat= $_COOKIE['FG_Latitude'];
            $long = $_COOKIE['FG_Longitude'];
            $options = array(

                'apiHost' => 'api.yelp.com', // Optional, default 'api.yelp.com',
                'apiKey' => 'qtyg5X9i7ytaZvOiOMtrdCq-XfBpag3tgR_JAl3DWpcrjUhDeHX083XaEM592Sa3teW5RZ5n7D7vEQyqbZ6NpsICbZNUdA6aOB5qwceb-IEeFpraXogZ6YYiu0opW3Yx', // Required, unless accessToken is provided
            );

            $client = \Stevenmaguire\Yelp\ClientFactory::makeWith(
                $options,
                \Stevenmaguire\Yelp\Version::THREE
            );



//        $response = $client->request('GET', 'https://api.yelp.com/v3/businesses/search');
            $request = $client->getRequest('GET', '/v3/businesses/search?latitude=' .$lat. '&longitude=' .$long. '&radius=5000&categories=Restaurants'); //location=92625&term=burrito

// Send that request
            $response = $client->getResponse($request);
        }






        return view('aroundme')->with(compact('responses', $response->getBody()));
    }
}