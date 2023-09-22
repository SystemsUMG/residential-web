<?php

namespace App\Http\Livewire\Auth;

use App\Traits\ToastTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Logout extends Component
{
    use ToastTrait;

    public function logout()
    {
        try {
            auth()->logout();
            return redirect()->route('login');
        } catch (\Exception $e) {
            $this->toast('error', $e->getMessage());
        }
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.auth.logout');
    }
}
