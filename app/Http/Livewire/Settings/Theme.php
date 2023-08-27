<?php

namespace App\Http\Livewire\Settings;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Theme extends Component
{
    public $theme;

    public function mount(): void
    {
        $this->theme = auth()->user()->theme;
    }

    public function switchTheme(): void
    {
        $this->theme = ($this->theme === 'light') ? 'dark' : 'light';
        auth()->user()->update([
            'theme' => $this->theme
        ]);
        $this->emit('themeChanged');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.settings.theme');
    }
}
