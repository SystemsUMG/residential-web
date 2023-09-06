<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Rules\MatchOldPassword;
use App\Traits\ToastTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{
    use ToastTrait;

    public Collection $user;
    public $currentPassword, $newPassword, $newPassword_confirmation;

    public function mount(): void
    {
        $user = auth()->user();
        $this->fill([
            'user' => collect([
                'id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'phone' => $user->phone,
            ]),
        ]);
    }

    public function saveProfile(): void
    {
        $this->validate([
            'user.name' => 'required|string|max:255',
            'user.surname' => 'required|string|max:255',
            'user.email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'user.phone' => 'required|string|max:255',
        ]);
        try {
            DB::beginTransaction();
            User::whereId($this->user['id'])->update($this->user->toArray());
            DB::commit();
            $this->toast('success', 'Usuario editado');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function savePassword(): void
    {
        $this->validate([
            'currentPassword' => ['required', 'string', new MatchOldPassword()],
            'newPassword' => ['required', 'string', 'confirmed'],
        ]);
        try {
            DB::beginTransaction();
            User::whereId($this->user['id'])->update([
                'password' => Hash::make($this->newPassword)
            ]);
            $this->currentPassword = '';
            $this->newPassword = '';
            $this->newPassword_confirmation = '';
            DB::commit();
            $this->toast('success', 'Contraseña cambiada');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->toast('error', errorHelper($e));
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.profile.profile');
    }
}
