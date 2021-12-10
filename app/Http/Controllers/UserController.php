<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\Auth\UserActivationEmail;

class UserController extends Controller
{
    public function verification()
    {
        return view('auth.verification');
    }

    public function sendOTP(Request $request)
    {
        $user = User::where('token_activation', $request->otp)->first();
        if($user==null){
            return redirect()->back()->with('error','Kode OTP salah!');
        }else{
            $user->update([
                'token_activation' => null,
                'isVerified' => true
            ]);
            return redirect('login')->withSuccess('Sukses, akun Anda sudah aktif');
        }
    }


    public function resendOTP(Request $request)
    {
        $this->validates($request);
        $user = User::where('email', $request->email)->first();

        //send request to MAIL
        if($user==null){
            return redirect()->back();
        }else{
            $user->token_activation = random_int(100000, 999999);
            $user->save();

            event(new UserActivationEmail($user));

            return redirect()->route('verification')->withSuccess('Kode OTP berhasil dikirim ulang, silakan cek email Anda!');
        }

    }

    public function validates(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ],[
            'email.exists' => 'Email tidak ditemukan, silakan periksa kembali.'
        ]);
    }
}
