<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function create()
    {
        return view('tickets.create_ticket');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'date' => 'required|date',
        ]);

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Ticket Created Successfully');
    }


    public function index(){
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $tickets = Ticket::with('messages.user')->find($id);
        return view('tickets.show', compact('tickets'));
    }

    public function reply(Request $request, $id)
    {
        TicketMessage::create([
            'ticket_id' => $id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);
        return back();
    }



}
