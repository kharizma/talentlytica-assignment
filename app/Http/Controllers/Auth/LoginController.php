<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $remember_me = $request->remember_me ? true : false;

        $user = User::where('email',$request->email)->first();

        if(isset($user->email_verified_at)){
            if(auth()->attempt(array('email' => $request->email, 'password' => $request->password),$remember_me))
            {
                Auth::login(User::where('email',$request->email)->first());

                $request->session()->regenerate();
                
                return redirect()->intended('home');
            }else{
                return back()->with('error','Email atau Password Salah')->onlyInput('email');
            }
        }else{
            return back()->with('error','Akun Anda Belum Terverifikasi')->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
