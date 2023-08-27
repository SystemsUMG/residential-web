<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Traits\Toast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    use Toast;

    public $email, $password, $remember_token = false;
    protected $rules = [
        'email' => ['required', 'email', 'exists:users,email'],
        'password' => ['required'],
        'remember_token' => ['required', 'boolean'],
    ];

    public function login(): void
    {
        $this->validate();
        try {
            $user = User::where('email', $this->email)->first();
            if ($user->active) {
                if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember_token)) {
                    $this->redirectRoute('home');
                } else {
                    $this->toast('error', 'Credenciales incorrectas.');
                }
            } else {
                $this->toast('error', 'Tu cuenta no está activa.');
            }
        } catch (\Exception $e) {
            $this->toast('error', $e->getMessage());
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.auth.login')->layout('auth');
    }
}
