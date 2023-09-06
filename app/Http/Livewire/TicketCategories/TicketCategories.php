<?php

namespace App\Http\Livewire\TicketCategories;

use App\Models\TicketCategory;
use App\Traits\ToastTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TicketCategories extends Component
{
    use ToastTrait, AuthorizesRequests;

    protected $listeners = ['edit', 'delete'];

    public TicketCategory $ticketCategory;
    public $showingModal = false, $isEditing = false, $modalTitle = '';

    protected $rules = [
        'ticketCategory.name' => 'required|string|min:3|max:255',
    ];

    public function createPenalty(): void
    {
        $this->ticketCategory = new TicketCategory();
        $this->modalTitle = 'Crear categoría';
        $this->resetErrorBag();
        $this->isEditing = false;
        $this->showingModal = true;
    }

    public function edit(TicketCategory $ticketCategory): void
    {
        $this->ticketCategory = $ticketCategory;
        $this->modalTitle = 'Editar categoría';
        $this->resetErrorBag();
        $this->isEditing = true;
        $this->showingModal = true;
    }

    public function delete(TicketCategory $ticketCategory): void
    {
        try {
            DB::beginTransaction();
            $ticketCategory->delete();
            $this->emit('closeDeleteModal');
            session()->flash('success', 'Categoría eliminada');
            $this->redirectRoute('tickets.categories');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function save(): void
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $this->ticketCategory->save();
            $this->showingModal = false;
            $this->emit('refreshDatatable');
            $this->toast('success', $this->isEditing ? 'Categoría editada' : 'Categoría creada');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $this->authorize('viewAny', TicketCategory::class);
        return view('livewire.ticket-categories.ticket-categories');
    }
}
