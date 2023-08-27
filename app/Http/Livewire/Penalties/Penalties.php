<?php

namespace App\Http\Livewire\Penalties;

use App\Enums\StatusType;
use App\Enums\UserType;
use App\Models\House;
use App\Models\Penalty;
use App\Models\PenaltyCategory;
use App\Models\User;
use App\Traits\ToastTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Penalties extends Component
{
    use ToastTrait;

    protected $listeners = ['edit', 'delete', 'changeStatus'];

    public Penalty $penalty;
    public $showingModal = false, $isEditing = false, $modalTitle = '';
    public $houses = [], $users = [], $penaltyCategories = [];


    protected $rules = [
        'penalty.description' => 'required|string|min:3|max:255',
        'penalty.amount' => 'required|numeric',
        'penalty.status' => 'required_if:isEditing,true',
        'penalty.house_id' => 'required|exists:houses,id',
        'penalty.user_id' => 'required_if:isEditing,true|exists:users,id',
        'penalty.penalty_category_id' => 'required|exists:penalty_categories,id',
    ];

    public function createPenalty(): void
    {
        $this->penalty = new Penalty();
        $this->showingModal = true;
        $this->isEditing = false;
        $this->resetErrorBag();
        $this->modalTitle = 'Crear multa';
        $this->penalty->status = StatusType::Generado;
        $this->penalty->user_id = auth()->user()->id;
        $this->houses = House::pluck('name', 'id');
        $this->users = User::where('role', UserType::Guardia)->pluck('name', 'id');
        $this->penaltyCategories = PenaltyCategory::pluck('name', 'id');
    }

    public function edit(Penalty $penalty): void
    {
        $this->penalty = $penalty;
        $this->showingModal = true;
        $this->isEditing = true;
        $this->resetErrorBag();
        $this->modalTitle = 'Editar multa';
        $this->houses = House::pluck('name', 'id');
        $this->users = User::where('role', UserType::Guardia)->pluck('name', 'id');
        $this->penaltyCategories = PenaltyCategory::pluck('name', 'id');
    }

    public function delete(Penalty $penalty): void
    {
        try {
            DB::beginTransaction();
            $penalty->delete();
            $this->emit('closeDeleteModal');
            session()->flash('success', 'Multa eliminada');
            $this->redirectRoute('penalties');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', $e);
        }
    }

    public function changeStatus(Penalty $penalty): void
    {
        try {
            DB::beginTransaction();
            switch ($penalty->status){
                case StatusType::Pagado->value:
                case StatusType::Generado->value:
                    $penalty->status = StatusType::Aprobado;
                    break;
                case StatusType::Aprobado->value:
                    $penalty->status = StatusType::Rechazado;
                    break;
                case StatusType::Rechazado->value:
                    $penalty->status = StatusType::Pagado;
                    break;
            }
            $penalty->save();
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
            $this->penalty->save();
            $this->showingModal = false;
            $this->emit('refreshDatatable');
            $this->toast('success', 'Ticket editado');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', $e);
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.penalties.penalties');
    }
}
