<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLogin()
{
    return view('auth.login');
}


    public function Authentication(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {
        $request->session()->regenerate();
        return redirect('/')->with('message', 'Login Successfully');
    }

    return redirect('/login')->with('error', 'Invalid Credentials');
}

public function logout()
{
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login')->with('message','Logout Successfully');
}
}
