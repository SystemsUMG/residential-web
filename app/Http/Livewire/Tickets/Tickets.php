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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Tickets extends Component
{
    use ToastTrait, AuthorizesRequests, WithFileUploads;

    protected $listeners = ['edit', 'delete', 'changeStatus'];
    public $showingModal = false, $isEditing = false, $modalTitle = '';
    public Ticket $ticket;
    public $houses = [], $users = [], $ticketCategories = [], $images = [], $files = [];

    protected $rules = [
        'ticket.description' => 'required',
        'ticket.status' => 'required_if:isEditing,true',
        'ticket.house_id' => 'required|exists:houses,id',
        'ticket.user_id' => 'required_if:isEditing,true|exists:users,id',
        'ticket.ticket_category_id' => 'required|exists:ticket_categories,id',
        'images.*' => 'mimes:png,jpg,jpeg',
    ];

    public function mount(): void
    {
        $this->houses = auth()->user()->hasRole([UserType::Operador->value, UserType::Admin->value]) ? House::pluck('name', 'id') : auth()->user()->houses->pluck('name', 'id');
        $this->users = User::whereRelation('roles', 'name', UserType::Residente)
            ->pluck(DB::raw("CONCAT(name, ' ', surname)"), 'id');
        $this->ticketCategories = TicketCategory::pluck('name', 'id');
    }

    public function createTicket(): void
    {
        $this->ticket = new Ticket();
        $this->modalTitle = 'Crear ticket';
        $this->resetErrorBag();
        $this->images = [];
        $this->files = [];
        $this->isEditing = false;
        $this->ticket->status = StatusType::Generado;
        $this->ticket->user_id = auth()->user()->id;
        $this->showingModal = true;
    }

    public function edit(Ticket $ticket): void
    {
        $this->ticket = $ticket;
        $this->modalTitle = 'Editar ticket';
        $this->resetErrorBag();
        $this->images = [];
        $this->files = $this->ticket->images?->pluck('url')->toArray();
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
            $this->toast('error', errorHelper($e));
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
            $this->toast('error', errorHelper($e));
        }
    }

    public function removeFile($file): void
    {
        try {
            DB::beginTransaction();
            $image = $this->ticket->images()->where('url', $file)->first();
            if ($image->count() === 0) {
                $this->toast('error', 'Archivo no encontrado');
                return;
            }
            $image->delete();
            Storage::disk('public')->delete($file);
            $this->files = $this->ticket->images?->pluck('url')->toArray();
            $this->files = $this->ticket->images()
                ->where('imageable_id', $this->ticket->id)
                ->where('imageable_type', Ticket::class)
                ->pluck('url')
                ->toArray();
            DB::commit();
        } catch (\Exception $e) {
            $this->toast('error', errorHelper($e));
        }
    }

    public function save(): void
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $this->ticket->save();
            if (count($this->images) > 0) {
                foreach ($this->images as $image) {
                    $this->ticket->images()->updateOrCreate(['url' => $image->store('images')]);
                }
            }
            DB::commit();
            $this->showingModal = false;
            $this->emit('refreshDatatable');
            $this->toast('success', $this->isEditing ? 'Ticket editado' : 'Ticket creado');
        } catch (Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('viewAny', Ticket::class);
        return view('livewire.tickets.tickets');
    }
}
