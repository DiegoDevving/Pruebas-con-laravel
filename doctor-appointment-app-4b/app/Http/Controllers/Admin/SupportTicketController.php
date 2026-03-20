<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = SupportTicket::latest()->paginate(10);
        return view('admin.support-tickets.index', compact('tickets'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SupportTicket $supportTicket)
    {
        return view('admin.support-tickets.show', compact('supportTicket'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupportTicket $supportTicket)
    {
        $supportTicket->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Hecho!',
            'text' => 'El ticket ha sido eliminado correctamente.'
        ]);

        return redirect()->route('admin.support-tickets.index');
    }
}
