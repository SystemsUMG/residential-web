<?php

namespace App\Http\Livewire\Component;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ModalDelete extends Component
{
    protected $listeners = ['showingDeleteModal', 'closeDeleteModal'];
    public $showingDeleteModal = false;
    public $model;

    public function showingDeleteModal($model): void
    {
        $this->model = $model;
        $this->showingDeleteModal = true;
    }

    public function delete(): void
    {
        $this->emit('delete', $this->model);
    }

    public function closeDeleteModal(): void
    {
        $this->showingDeleteModal = false;
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.component.modal-delete');
    }
}
