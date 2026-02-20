<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    public function create()
    {
        if (Auth::user() && Auth::user()->role->role == 'admin') {

            $users = User::whereHas('role', function ($q) {
                $q->where('role', 'user');
            })->get();

            $agents = User::whereHas('role', function ($q) {
                $q->where('role', 'agent');
            })->get();

            return view('tickets.create_ticket', compact('users', 'agents'));
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

        if (Auth::user() && Auth::user()->role->role == 'admin') {

            Ticket::create([
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
                'date' => $request->date,
                'user_id' => $request->user_id,
                'agent_id' => $request->agent_id,
                'status'=>'open'
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

        return redirect()->back()->with('success', 'Ticket Created Successfully');
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
        $tickets = $tickets->load('user', 'agent');
        // dd($tickets);
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
        try {
            $messages = TicketMessage::with('user')->where(['ticket_id' => $id, 'read_at' => null])->get();
            $data = [
                'error' => false,
                'message' => 'Messages retrived successfully',
                'messages' => $messages
            ];
        } catch (Exception $e) {
            $data = [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }


        return response()->json($data);
    }



    public function updateStatus(Request $request, $id)
    {

        $request->validate([
        'status' => 'required|in:open,in_progress,closed'
      ]);

        $ticket = Ticket::findOrFail($id);

        $ticket->status = $request->status;

        $ticket->save();

        return back();
    }

    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role->role == 'admin') {

            $myTickets = Ticket::count();
            $ongoing = Ticket::where('status', 'in_progress')->count();
            $closed = Ticket::where('status', 'closed')->count();

        } elseif ($user->role->role == 'agent') {

            $myTickets = Ticket::where('agent_id', $user->id)->count();
            $ongoing = Ticket::where('agent_id', $user->id)
                            ->where('status', 'in_progress')
                            ->count();
            $closed = Ticket::where('agent_id', $user->id)
                            ->where('status', 'closed')
                            ->count();

        } else { // user

            $myTickets = Ticket::where('user_id', $user->id)->count();
            $ongoing = Ticket::where('user_id', $user->id)
                            ->where('status', 'in_progress')
                            ->count();
            $closed = Ticket::where('user_id', $user->id)
                            ->where('status', 'closed')
                            ->count();
        }

        return view('dashboard', compact('myTickets','ongoing','closed'));
    }

    


}
