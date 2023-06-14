<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function index()
    {
        return view('check-in.index');
    }

    public function verify(Request $request)
    {
        // Validasi inputan form
        $validatedData = $request->validate([
            'token' => 'required',
        ]);

        // Cari tiket berdasarkan token
        $ticket = Ticket::where('token', $validatedData['token'])->first();

        // Jika tiket tidak ditemukan
        if (!$ticket) {
            return redirect()->back()->with('error', 'Invalid ticket token!');
        }

        // Jika tiket sudah tidak berlaku
        if ($ticket->is_checked_in == 'true') {
            return redirect()->back()->with('error', 'Ticket has expired!');
        }

        // Jika tiket sudah terpakai sebelumnya
        if ($ticket->is_checked_in) {
            return redirect()->back()->with('success', 'Ticket has already been checked-in!');
        }

        // Update status tiket menjadi "terpakai"
        $ticket->is_checked_in = true;
        $ticket->save();

        return redirect()->back()->with('success', 'Check-in successful!');
    }
}
