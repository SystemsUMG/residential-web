<?php

namespace App\Http\Livewire\Houses;

use App\Enums\UserType;
use App\Models\House;
use App\Models\User;
use App\Traits\ToastTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Houses extends Component
{
    use ToastTrait, AuthorizesRequests;

    protected $listeners = ['edit', 'delete', 'active'];

    public House $house;
    public $showingModal = false, $isEditing = false, $modalTitle = '';
    public $users = [];

    protected $rules = [
        'house.name' => 'required|string|min:3|max:255',
        'house.code' => 'required|string|min:3|max:255',
        'house.active' => 'required_if:isEditing,true',
        'house.user_id' => 'required_if:isEditing,true|exists:users,id',
    ];

    public function mount(): void
    {
        $this->users = User::whereRelation('roles', 'name', UserType::Residente)
            ->pluck(DB::raw("CONCAT(name, ' ', surname)"), 'id');

    }

    public function createHouse(): void
    {
        $this->house = new House();
        $this->modalTitle = 'Crear casa';
        $this->resetErrorBag();
        $this->house->active = true;
        $this->isEditing = false;
        $this->showingModal = true;
    }

    public function edit(House $house): void
    {
        $this->house = $house;
        $this->modalTitle = 'Editar casa';
        $this->resetErrorBag();
        $this->isEditing = true;
        $this->showingModal = true;
    }

    public function delete(House $house): void
    {
        try {
            DB::beginTransaction();
            $house->delete();
            $this->emit('closeDeleteModal');
            session()->flash('success', 'Casa eliminada');
            $this->redirectRoute('houses');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function active(House $house): void
    {
        try {
            DB::beginTransaction();
            if ($house->active) {
                $house->active = false;
            } else {
                $house->active = true;
            }
            $house->save();
            $this->emit('refreshDatatable');
            $this->toast('success', $house->active ? 'Casa activada' : 'Casa desactivada');
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
            $this->house->save();
            $this->showingModal = false;
            $this->emit('refreshDatatable');
            $this->toast('success', $this->isEditing ? 'Casa editada' : 'Casa creada');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }


    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.houses.houses');
    }
}
