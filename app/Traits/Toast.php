<?php

namespace App\Traits;

use Livewire\Event;

trait Toast
{
    public function toast(string $type = '', string $message = ''): Event
    {
        return $this->emit('toast', ['type' => $type, 'message' => $message]);
    }
}
