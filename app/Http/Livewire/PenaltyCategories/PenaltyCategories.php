<?php

namespace App\Http\Livewire\PenaltyCategories;

use App\Models\PenaltyCategory;
use App\Traits\ToastTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PenaltyCategories extends Component
{
    use ToastTrait;

    protected $listeners = ['edit', 'delete'];

    public PenaltyCategory $penaltyCategory;
    public $showingModal = false, $isEditing = false, $modalTitle = '';

    protected $rules = [
        'penaltyCategory.name' => 'required|string|min:3|max:255',
    ];

    public function createPenalty(): void
    {
        $this->penaltyCategory = new PenaltyCategory();
        $this->modalTitle = 'Crear categoría';
        $this->resetErrorBag();
        $this->isEditing = false;
        $this->showingModal = true;
    }

    public function edit(PenaltyCategory $penaltyCategory): void
    {
        $this->penaltyCategory = $penaltyCategory;
        $this->modalTitle = 'Editar categoría';
        $this->resetErrorBag();
        $this->isEditing = true;
        $this->showingModal = true;
    }

    public function delete(PenaltyCategory $penaltyCategory): void
    {
        try {
            DB::beginTransaction();
            $penaltyCategory->delete();
            $this->emit('closeDeleteModal');
            session()->flash('success', 'Categoría eliminada');
            $this->redirectRoute('penalties.categories');
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
            $this->penaltyCategory->save();
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
        return view('livewire.penalty-categories.penalty-categories');
    }
}
