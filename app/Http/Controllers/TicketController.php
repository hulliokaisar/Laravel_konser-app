<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index()
    {
        // Mendapatkan daftar pemesanan tiket
        $tickets = Ticket::all();

        return view('ticket.index', compact('tickets'));
    }

    public function create()
    {
        return view('ticket.create');
    }

    public function store(Request $request)
    {
        // Validasi inputan form
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'token' => 'required',
        ]);

        // Simpan data pemesanan tiket ke dalam database
        $ticket = new Ticket();
        $ticket->name = $validatedData['name'];
        $ticket->email = $validatedData['email'];
        $ticket->phone = $validatedData['phone'];
        $ticket->token = $validatedData['token'];
        $ticket->save();

        // Redirect ke halaman tiket dengan menampilkan nomor ID
        return redirect()->route('ticket.create')->with('success', 'Ticket booked successfully! Your ticket ID is ' . $ticket->token);
    }

    public function show(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'token' => 'required',
        ]);

        $ticket = Ticket::where('token', $validatedData['token'])->first();

        if (!$ticket) {
            return redirect()->back()->with('error', 'Invalid ticket token!');
        }

        return view('ticket.show', compact('ticket'));
    }


    public function edit($id)
    {
        // Mendapatkan data pemesanan tiket berdasarkan ID
        $ticket = Ticket::findOrFail($id);

        return view('ticket.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        // Validasi inputan form
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'token' => 'required',
        ]);

        // Update data pemesanan tiket
        $ticket = Ticket::findOrFail($id);
        $ticket->name = $validatedData['name'];
        $ticket->email = $validatedData['email'];
        $ticket->phone = $validatedData['phone'];
        $ticket->token = $validatedData['token'];
        $ticket->save();

        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully! Your ticket ID is ' . $ticket->id);
    }

    public function destroy($id)
    {
        // Hapus data pemesanan tiket berdasarkan ID
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('ticket.index')->with('success', 'Ticket deleted successfully!');
    }
}
