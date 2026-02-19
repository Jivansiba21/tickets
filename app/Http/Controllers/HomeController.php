<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;
// use Illuminate\Http\Request;
use App\Models\Ticket;

class HomeController extends Controller
{
    public function home()
    {   
        
        $totalUsers = User::count();

        // $totalAgents = User::where('role', 'agent')->count();

        $totalTickets = Ticket::count();

        //return view('page', compact('totalUsers', 'totalAgents', 'totalTickets'));
        // dd($totalUsers, $totalAgents, $totalTickets);
        return view('page', [
            'totalUsers' => $totalUsers,
            // 'totalAgents' => $totalAgents,
            'totalTickets' => $totalTickets
        ]);
    }
    
    
}
