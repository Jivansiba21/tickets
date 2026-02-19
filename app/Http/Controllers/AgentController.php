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



    public function show($id)
{
    $agent = User::findOrFail($id);
    return view('agents.show_agent', compact('agent'));
}


    public function edit($id)
{
    $agent = User::findOrFail($id);
    return view('agents.edit', compact('agent'));
}
    public function update(Request $request, $id)
{
    $agent = User::findOrFail($id);

    $agent->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? bcrypt($request->password) : $agent->password,
    ]);

    return redirect()->route('agents.index')
                     ->with('success', 'Agent updated successfully.');
}
    public function destroy($id)
    {
        $agent = User::findOrFail($id);
        $agent->delete();

        return redirect()->route('agents.index')
                         ->with('success', 'Agent deleted successfully.');
    }
}
