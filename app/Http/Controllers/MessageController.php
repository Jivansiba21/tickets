<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function show($id)
    {
       $ticket = Ticket::with('messages.user')
        ->where('id', $id)
        ->whereHas('messages', function ($query) {
            $query->whereNotNull('read_at');
        })
        ->first();   // ✅ returns SINGLE model
        // dd($ticket);
        $messages = $ticket->messages;
        return view('tickets.show', compact('ticket','messages'));
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

    public function readMessage(Request $request)
    {
        $formFields = $request->validate([
            'messageId' => 'exists:ticket_messages,id'
        ]);

        $msg = TicketMessage::findOrFail($formFields['messageId']);
        if ($msg->read_at == null) {

            $msg->read_at = now()->format('y-m-d h:i:s');
            if ($msg->save()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Message has been readed'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Error has been occured during message update'

                ]);
            }
        } else {
            return response()->json([
                'error' => false,
                'message' => 'Message has been already readed'
            ]);
        }
        //    dd($msg);
    }
}
