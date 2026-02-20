<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ticket;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        // ================= ADMIN =================
        if ($user->role?->role === 'admin') {

            $totalUsers = User::whereHas('role', function ($q) {
                $q->where('role', 'user');
            })->count();

            $totalAgents = User::whereHas('role', function ($q) {
                $q->where('role', 'agent');
            })->count();

            $totalTickets = Ticket::count();

            return view('admin_dash', compact(
                'totalUsers',
                'totalAgents',
                'totalTickets'
            ));
        }

       
        elseif ($user->role?->role === 'agent') {

            $myTicketsCount = Ticket::where('agent_id', $user->id)->count();

            $ongoingCount = Ticket::where('agent_id', $user->id)
                ->where('status', 'in_progress')
                ->count();

            $closedCount = Ticket::where('agent_id', $user->id)
                ->where('status', 'closed')
                ->count();


            $latestTickets = Ticket::where('agent_id', $user->id)
                ->latest()
                ->take(5)
                ->get();


            return view('agent_dash', compact(
                'myTicketsCount',
                'ongoingCount',
                'closedCount',
                'latestTickets'

            ));
        }

        
        else {

            $myTicketsCount = Ticket::where('user_id', $user->id)->count();

            $ongoingCount = Ticket::where('user_id', $user->id)
                ->where('status', 'in_progress')
                ->count();

            $closedCount = Ticket::where('user_id', $user->id)
                ->where('status', 'closed')
                ->count();

            $latestTickets = Ticket::where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();


            return view('user_dash', compact(
                'myTicketsCount',
                'ongoingCount',
                'closedCount',
                'latestTickets'
            ));
        }
    }
}
