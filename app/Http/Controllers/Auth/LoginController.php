<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


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
//    protected $redirectTo = '/home'
    protected function authenticated()
    {

        if(Auth::User()->isAdmin()){

            return redirect('/admin');

        }
        else if(Auth::User()->isIGP()){
            return redirect('/IGP');

        }
        else if(Auth::User()->isCitizen()){
            return redirect('/RegisteredCitizen');

        }
        else if(Auth::User()->isOIC()){
            return redirect('/OIC');

        }
        else if(Auth::User()->isBOIC()){
            return redirect('/BOIC');

        }
        else if(Auth::User()->isDOIG()){
            return redirect('/DOIG');

        }
        else{
            $message="login successfully";
            Auth::logout();
            return view('errors.loginError');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
