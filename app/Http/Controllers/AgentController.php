<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $users = User::whereHas('role', function($q){
            $q->where('role', 'agent');
        })->get();
        return view('agents.index', compact('users'));
    }

    public function create()
    {
        return view('agents.create_agent');
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
            'password' => bcrypt($request->password),
        ]);

        $user->role()->create([
            'role' => 'agent',
        ]);

        return redirect()->back()->with('success', 'Agent created successfully');
    }
}
