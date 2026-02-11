<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

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




}
