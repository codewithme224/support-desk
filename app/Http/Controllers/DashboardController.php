<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Status;

class DashboardController extends Controller
{
    public function index()
    {

        // Total tickets count
        $total_tickets = Ticket::count();
        // Percentage of total tickets count
        $percentage_of_total_tickets = ($total_tickets / 100) * 10;



        // Total open tickets count
        $open_tickets = Ticket::where('status_id', '=', '1')->count();
        // Percentage of open tickets count
        $percentage_of_open_tickets = ($open_tickets / 100) * 10;

        // Total closed tickets count
        $closed_tickets = Ticket::where('status_id', '=', '2')->count();
        // Percentage of closed tickets count
        $percentage_of_closed_tickets = ($closed_tickets / 100) * 10;


        // Total pending tickets count
        $pending_tickets = Ticket::where('status_id', '=', '3')->count();
        // Percentage of pending tickets count
        $percentage_of_pending_tickets = ($pending_tickets / 100) * 10;


        $tickets_dash = Ticket::with('status')->get();

        return view('dashboard', compact('tickets_dash', 'total_tickets', 'percentage_of_total_tickets', 'open_tickets', 'closed_tickets', 'pending_tickets', 'percentage_of_open_tickets', 'percentage_of_closed_tickets', 'percentage_of_pending_tickets'));
    }


    public function indexAll()
    {

        $tickets = Ticket::with('status')->get();


        return view('tables', compact('tickets'));


    }
}
