<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function create()
    {
        if(Auth::user() && Auth::user()->role->role == 'admin') {

        $users = User::whereHas('role', function($q){
            $q->where('role', 'user');
        })->get();

        $agents = User::whereHas('role', function($q){
            $q->where('role', 'agent');
        })->get();

        return view('tickets.create_ticket', compact('users','agents'));

    } else {
        return view('tickets.create_ticket');
    }

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'date' => 'required|date',
        ]);

        if(Auth::user() && Auth::user()->role->role == 'admin') {

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'date' => $request->date,
            'user_id' => $request->user_id,
            'agent_id' => $request->agent_id,
        ]);  

    } else {

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'date' => $request->date,
            'user_id' => Auth::id(),
            //'agent_id' => null,
        ]);
    }

    return redirect()->back()->with('success','Ticket Created Successfully');
}


    public function index()
    {
        $user = Auth::user();

        if ($user && $user->role?->role === 'agent') {

            
            $tickets = Ticket::where('agent_id', $user->id)->get();

        } elseif ($user && $user->role?->role === 'user') {

        
            $tickets = Ticket::where('user_id', $user->id)->get();

        } else {

            
            $tickets = Ticket::all();
        }
        return view('tickets.index', compact('tickets'));
    }



    public function show($id)
{
    $ticket = Ticket::findOrFail($id);
    return view('tickets.showTickets', compact('ticket'));

}



//edit ticket details
public function edit($id)
{
    $ticket = Ticket::findOrFail($id);

    return view('tickets.edit', compact('ticket'));
}

public function update(Request $request, $id)
{
    $ticket = Ticket::findOrFail($id);

    $ticket->update([
        'title' => $request->title,
        'description' => $request->description,
        'priority' => $request->priority,
        'date' => $request->date,
    ]);

    return redirect()->route('tickets.index')
        ->with('success', 'Ticket updated successfully');
}

//delete ticket
public function destroy($id)
{
    $ticket = Ticket::findOrFail($id);

    $ticket->delete();

    return redirect()->route('tickets.index')
        ->with('success', 'Ticket deleted successfully');
}


    public function fetchMessages($id)
    {
        $messages = TicketMessage::with('user')->where('ticket_id', $id)->get();
        return response()->json($messages);
    }

}
