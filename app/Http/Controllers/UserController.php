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


    public function show($id)
{
    $user = User::findOrFail($id);
    return view('users.show_user', compact('user'));
}

public function edit($id)
{
    $user = User::findOrFail($id);
    return view('users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email'
    ]);

    $user->update($request->all());

    return redirect()->route('users.index')
        ->with('success', 'User updated successfully');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')
        ->with('success', 'User deleted successfully');
}


    
}
