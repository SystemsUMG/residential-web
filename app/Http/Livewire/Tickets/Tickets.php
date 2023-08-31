<?php

namespace App\Http\Livewire\Tickets;

use App\Enums\StatusType;
use App\Enums\UserType;
use App\Models\House;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use App\Traits\ToastTrait;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tickets extends Component
{
    use ToastTrait;

    protected $listeners = ['edit', 'delete', 'changeStatus'];
    public $showingModal = false, $isEditing = false, $modalTitle = '';
    public Ticket $ticket;
    public $houses = [], $users = [], $ticketCategories = [];

    protected $rules = [
        'ticket.description' => 'required',
        'ticket.status' => 'required_if:isEditing,true',
        'ticket.house_id' => 'required|exists:houses,id',
        'ticket.user_id' => 'required_if:isEditing,true|exists:users,id',
        'ticket.ticket_category_id' => 'required|exists:ticket_categories,id',
    ];

    public function mount(): void
    {
        $this->houses = House::pluck('name', 'id');
        $this->users = User::where('role', UserType::Residente)->pluck('name', 'id');
        $this->ticketCategories = TicketCategory::pluck('name', 'id');
    }

    public function createTicket(): void
    {
        $this->ticket = new Ticket();
        $this->modalTitle = 'Crear ticket';
        $this->resetErrorBag();
        $this->isEditing = false;
        $this->showingModal = true;
        $this->ticket->status = StatusType::Generado;
        $this->ticket->user_id = auth()->user()->id;
    }

    public function edit(Ticket $ticket): void
    {
        $this->ticket = $ticket;
        $this->modalTitle = 'Editar ticket';
        $this->resetErrorBag();
        $this->isEditing = true;
        $this->showingModal = true;
    }

    public function delete(Ticket $ticket): void
    {
        try {
            DB::beginTransaction();
            $ticket->delete();
            $this->emit('refreshDatatable');
            $this->emit('closeDeleteModal');
            session()->flash('success', 'Ticket eliminada');
            $this->redirectRoute('tickets');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->toast('error', $e);
        }
    }

    public function changeStatus(Ticket $ticket): void
    {
        try {
            DB::beginTransaction();
            switch ($ticket->status) {
                case StatusType::Generado->value:
                    $ticket->status = StatusType::Asignado;
                    break;
                case StatusType::Asignado->value:
                    $ticket->status = StatusType::EnProgreso;
                    break;
                case StatusType::EnProgreso->value:
                    $ticket->status = StatusType::Finalizado;
                    break;
                case StatusType::Finalizado->value:
                    $ticket->status = StatusType::Generado;
                    break;
            }
            $ticket->save();
            $this->emit('refreshDatatable');
            $this->toast('success', 'Estado de la multa cambiado');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', $e);
        }
    }

    public function save(): void
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $this->ticket->save();
            $this->showingModal = false;
            $this->emit('refreshDatatable');
            $this->toast('success', 'Ticket editado');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->toast('error', $e);
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.tickets.tickets');
    }
}
