<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use Nexmo\Client;
use Nexmo\Laravel\Facade\Nexmo;
use Stevebauman\Location\Position;
use Stevebauman\Location\Drivers\Driver;
use Stevebauman\Location\Location;
class DashboardController extends Controller
{
    public function aroundme(){
        return view('aroundme');
    }
}
