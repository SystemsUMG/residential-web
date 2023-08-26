<?php

namespace App\Http\Livewire\Penalties;

use App\Enums\UserType;
use App\Models\House;
use App\Models\Penalty;
use App\Models\PenaltyCategory;
use App\Models\User;
use App\Traits\Toast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Penalties extends Component
{
    use Toast;
    protected $listeners = ['edit', 'delete'];
    public $showingModal = false, $isEditing = false;
    public Penalty $penalty;
    public $houses = [], $users = [], $penaltyCategories = [];


    protected $rules = [
        'penalty.description' => 'required',
        'penalty.amount' => 'required',
        'penalty.status' => 'required',
        'penalty.house_id' => 'required',
        'penalty.user_id' => 'required',
        'penalty.penalty_category_id' => 'required',
    ];

    public function createPenalty(): void
    {
        $this->penalty = new Penalty();
        $this->showingModal = true;
        $this->isEditing = false;
        $this->penalty->status = 'generated';
        $this->houses = House::pluck('name', 'id');
        $this->users = User::where('role', UserType::Guard)->pluck('name', 'id');
        $this->penaltyCategories = PenaltyCategory::pluck('name', 'id');
    }

    public function edit(Penalty $penalty): void
    {
        $this->penalty = $penalty;
        $this->showingModal = true;
        $this->isEditing = true;
        $this->houses = House::pluck('name', 'id');
        $this->users = User::where('role', UserType::Guard)->pluck('name', 'id');
        $this->penaltyCategories = PenaltyCategory::pluck('name', 'id');
    }

    public function delete(Penalty $penalty): void
    {
        try {
            $penalty->delete();
            $this->emit('refreshDatatable');
            $this->emit('closeDeleteModal');
            $this->toast('success', 'Multa eliminada');
        } catch (\Exception $e) {
            $this->toast('error', $e);
        }
    }

    public function save(): void
    {
        $this->validate();
        try {
            $this->penalty->save();
            $this->showingModal = false;
            $this->emit('refreshDatatable');
            $this->toast('success', 'Ticket editado');
        } catch (\Exception $e) {
            $this->toast('error', $e);
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.penalties.penalties');
    }
}
