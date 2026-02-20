<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Ticket;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function home()
    {
        // Total Users
        $totalUsers = User::whereHas('role', function ($q) {
            $q->where('role', 'user');
        })->count();

        // Total Agents
        $totalAgents = User::whereHas('role', function ($q) {
            $q->where('role', 'agent');
        })->count();

        // Total Tickets
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

        return view('page', compact(
            'totalUsers',
            'totalAgents',
            'totalTickets',
            'months',
            'closedData',
            'openedData'
        ));
    }
}