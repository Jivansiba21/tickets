<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereHas('role', function($q){
            $q->where('role', 'user');
        })->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create_user');
    }

    public function store(Request $request)
    {

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    UserRole::create([
        'user_id' => $user->id,
        'role' => 'user',
    ]);

    return redirect()->back()->with('success', 'User created successfully');

    }

    
}
