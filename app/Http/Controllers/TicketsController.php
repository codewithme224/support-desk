<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Status;
use App\Models\Shift;
use App\Models\MOP;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allTickets = Ticket::all();
        $tickets = Ticket::with('status', 'mop')->get();
        $mops = Mop::all();
        

        return view('tickets.index', compact('tickets','mops', 'allTickets'));


    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $issue_status = Status::all();
        $mops = MOP::all();



        return view('tickets.create', compact('issue_status','mops'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'issue' => 'required',
            'status_id' => 'required',
            'resolution' => 'nullable',
            'mop' => 'nullable',

        ]);

        $ticket = new Ticket;
        $ticket->issue = $request->issue;
        $ticket->status_id = $request->status_id;
        $ticket->resolution = $request->resolution;
        $ticket->mop = $request->mop;
        $ticket->user_id = Auth::id();
        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Ticket Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Use join to select the script column
        // $ticketWithMopScript = Ticket::join('m_o_p_s', 'tickets.mop_id', '=', 'm_o_p_s.id')
        // ->where('tickets.id', $id)
        // ->select('tickets.*', 'm_o_p_s.script as mop_script')
        // ->firstOrFail();

        $ticket = Ticket::findOrFail($id);
        // $mopScript = $ticket->mop->script;
        $script = DB::table('m_o_p_s')->where('id', $ticket->mop_id)->value('script');

        $issue_status = Status::all();
        $selectedStatusId = $ticket->status_id;
        return view('tickets.show', compact('ticket', 'script', 'issue_status','selectedStatusId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);


        // if (!$ticket) {
        //     // Handle the case where the ticket with the given ID is not found
        //     abort(404);
        // }

        $issue_status = Status::all();
        $mops = MOP::all();

        $selectedStatusId = $ticket->status_id;
        $selectedMopId = $ticket->mop;

         return view('tickets.edit', compact('ticket', 'issue_status','selectedStatusId','mops','selectedMopId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->issue = $request->issue;
        $ticket->status_id = $request->status_id;
        $ticket->resolution = $request->resolution;
        $ticket->mop = $request->mop;
        $ticket->user_id = Auth::id();
        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->delete();
            return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('tickets.index')->with('error', 'Ticket not deleted');
        }
    }
}
