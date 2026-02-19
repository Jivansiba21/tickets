<?php

namespace App\Http\Controllers;

use App\Models\MessageAttachment;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function show($id)
    {
        // dd(Ticket::find($id));
        $ticket = Ticket::with('messages.user')
            ->where('id', $id)
            ->orWhereHas('messages', function ($query) {
                $query->whereNotNull('read_at');
            })
            ->first();   // ✅ returns SINGLE model
        // dd($ticket);
        // $messages = optional($ticket->messages ?? collect()); // ✅ returns collection, even if no messages
        //dd($messages);
        return view('tickets.show', compact('ticket'));
    }

    public function reply(Request $request, $id)
    {


        // dd($request);
    try{
        $request->validate([
            'photo.*' => 'mimes:png,jpg,jpeg|max:3000',
            'message' => 'required|max:300|string'
        ]);


    

        $message =    TicketMessage::create([
            'ticket_id' => $id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        if($request->has('photo')){
            foreach($request->photo as $img){
                
                 $path = $img->store('message-attachments', 'public');
                 $attachment = MessageAttachment::create([
                    'message_id' => $message->id,
                    'filepath' => $path
                 ]);
            }
           
        }

        

        return back();
        }
        catch(Exception $e){
            dd($e);
        }
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
