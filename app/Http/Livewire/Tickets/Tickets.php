<?php

namespace App\Http\Livewire\Tickets;

use App\Enums\UserType;
use App\Models\House;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use App\Traits\Toast;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Tickets extends Component
{
    use Toast;

    protected $listeners = ['edit', 'delete'];
    public $showingModal = false, $isEditing = false;
    public Ticket $ticket;
    public $houses = [], $users = [], $ticketCategories = [];

    protected $rules = [
        'ticket.description' => 'required',
        'ticket.status' => 'required',
        'ticket.house_id' => 'required',
        'ticket.user_id' => 'required',
        'ticket.ticket_category_id' => 'required',
    ];

    public function createTicket(): void
    {
        $this->ticket = new Ticket();
        $this->showingModal = true;
        $this->isEditing = false;
        $this->ticket->status = 'generated';
        $this->houses = House::pluck('name', 'id');
        $this->users = User::where('role', UserType::Resident)->pluck('name', 'id');
        $this->ticketCategories = TicketCategory::pluck('name', 'id');
    }

    public function edit(Ticket $ticket): void
    {
        $this->ticket = $ticket;
        $this->showingModal = true;
        $this->isEditing = true;
        $this->houses = House::pluck('name', 'id');
        $this->users = User::where('role', 2)->pluck('name', 'id');
        $this->ticketCategories = TicketCategory::pluck('name', 'id');
    }

    public function delete(Ticket $ticket): void
    {
        try {
            $ticket->delete();
            $this->emit('refreshDatatable');
            $this->emit('closeDeleteModal');
            $this->toast('success', 'Ticket eliminado');
        } catch (Exception $e) {
            $this->toast('error', $e);
        }
    }

    public function save()
    {
        $this->validate();
        try {
            $this->ticket->save();
            $this->showingModal = false;
            $this->emit('refreshDatatable');
            $this->toast('success', 'Ticket editado');
        } catch (Exception $e) {
            $this->toast('error', $e);
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.tickets.tickets');
    }
}
