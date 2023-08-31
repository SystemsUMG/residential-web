<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Traits\ToastTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Users extends Component
{
    use ToastTrait;

    protected $listeners = ['edit', 'delete'];

    public User $user;
    public $showingModal = false, $isEditing = false, $modalTitle = '', $password;

    protected function rules(): array
    {
        return [
            'user.name' => ['required', 'min:3', 'max:255', 'string'],
            'user.surname' => ['required', 'min:3', 'max:255', 'string'],
            'user.email' => [
                'required', Rule::unique('users', 'email')->ignore($this->user), 'email',
            ],
            'user.phone' => ['nullable', 'string'],
            'password' => [Rule::requiredIf(!$this->isEditing)],
            'user.role' => ['required'],
        ];
    }

    public function createPenalty(): void
    {
        $this->user = new User();
        $this->user->password = '';
        $this->modalTitle = 'Crear usuario';
        $this->resetErrorBag();
        $this->isEditing = false;
        $this->showingModal = true;
    }

    public function edit(User $user): void
    {
        $this->user = $user;
        $this->modalTitle = 'Editar usuario';
        $this->resetErrorBag();
        $this->isEditing = true;
        $this->showingModal = true;
    }

    public function delete(User $user): void
    {
        try {
            DB::beginTransaction();
            $user->delete();
            $this->emit('closeDeleteModal');
            session()->flash('success', 'Usuario eliminado');
            $this->redirectRoute('users');
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
            if ($this->isEditing) {
                unset($this->user->password);
            } else {
                $this->user->password = bcrypt($this->password);
            }
            $this->user->save();
            $this->showingModal = false;
            $this->emit('refreshDatatable');
            $this->toast('success', $this->isEditing ? 'Usuario editado' : 'Usuario creado');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.users.users');
    }
}
