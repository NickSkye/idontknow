<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Check either username or email.
     * @return string
     */
    public function username()
    {

        $fieldName = filter_var('email', FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldName => 'email']);
        return $fieldName;
    }
    /**
     * Validate the user login.
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|string',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'Username or email is required',
                'password.required' => 'Password is required',
            ]
        );
    }
   


    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }

        DB::table('users')->where('username', $user->username)->update(['updated_at' => date('Y-m-d H:i:s')]);
        $noprofpic = DB::table('profileinfo')->where('username', $user->username)->where('profileimage', '/images/default-avatar.jpg')->exists();
        if($noprofpic){
            return redirect('/about');
        }else{
            return redirect()->intended($this->redirectPath());
        }


    }
}
