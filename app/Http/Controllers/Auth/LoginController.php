<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected function redirectTo() {
        if (Auth::check() && Auth::user()->role == 'penjual') {
            return('/penjual');
        }
        elseif (Auth::check() && Auth::user()->role == 'pembeli') {
            return('/pembeli');
        }
        else{
            return('/login');
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

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => [
                'required','string',
                Rule::exists('users')->where(function ($query){
                    $query->where('isVerified', true);
                })
            ],
                'password' => 'required|string',
        ], [
            $this->username(). '.exists' => 'Email anda belum aktif. Silakan aktivasi terlebih dahulu!'
        ]);
    }

}
