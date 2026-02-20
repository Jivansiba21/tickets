<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ticket;
use Carbon\Carbon;


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

            // Closed tickets per month
            $closedTickets = Ticket::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->where('status', 'closed')
                ->groupBy('month')
                ->pluck('total', 'month');

            // Open tickets per month
            $openedTickets = Ticket::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->where('status', 'open')
                ->groupBy('month')
                ->pluck('total', 'month');

            $months = [];
            $closedData = [];
            $openedData = [];

            for ($i = 1; $i <= 12; $i++) {
                $months[] = Carbon::create()->month($i)->format('M');
                $closedData[] = $closedTickets[$i] ?? 0;
                $openedData[] = $openedTickets[$i] ?? 0;
            }

            return view('admin_dash', compact(
                'totalUsers',
                'totalAgents',
                'totalTickets',
                'months',
                'closedData',
                'openedData'
            ));

        } elseif ($user->role?->role === 'agent') {

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
        } else {

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
