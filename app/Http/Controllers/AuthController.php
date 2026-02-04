<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    public function Authentication(Request $request)
    {
        //$request=['email','password']


        $user = User::where('email', $request->email)->first();
        // dd($user);
        if ($user) {
            $dbpass = $user->password;
            $password = $request->password;

             if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      
                
                return redirect('/page')->with('message','Login Successfully');
            } else {
                return redirect('/login')->with('error', 'Invalid Credentials');
            }
        } else {
            return redirect('/login')->with('error', 'User Not Found');
        }
    }

    public function logout(){
        Auth::logout();
	return redirect('/login')->with('message','Logout Successfully');
    }
}
