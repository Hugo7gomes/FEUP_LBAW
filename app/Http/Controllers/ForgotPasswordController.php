<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{
    

    public function show(){
        return view('auth.forgot-password');
    }

    public function request(Request $request){
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status), 'message' => 'Email sent to recover password!'])
        : back()->withErrors(['email' => __($status)]);
    }

    public function showRecover(Request $request){
        return view('auth.reset-password', ['token' => $request->token]);
    }

    public function recover(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);
      
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                'password' => Hash::make($password)
                ]);
        
                $user->save();
        
                event(new PasswordReset($user));
            }
        );
      
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
