<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
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
