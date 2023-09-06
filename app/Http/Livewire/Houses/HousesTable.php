<?php

namespace App\Http\Livewire\Houses;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\House;

class HousesTable extends DataTableComponent
{
    protected $model = House::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function builder(): Builder
    {
        return House::query()
            ->select('houses.*');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),
            Column::make("Código", "code")
                ->searchable()
                ->sortable(),
            Column::make("Activo")
                ->label(
                    fn($row) => $row->active ?
                        "<button type='button' wire:click='active($row->id)' class='btn btn-success rounded-pill py-0 px-1'><span class='ti ti-check'></span></button>" :
                        "<button type='button' wire:click='active($row->id)' class='btn btn-danger rounded-pill py-0 px-1'><span class='ti ti-x'></span></button>"
                )->html(),
            Column::make("Propietario", "user.id")->searchable()->sortable()->format(
                fn($row) => optional(User::find($row))->name . ' ' . optional(User::find($row))->surname
            )->html(),
            Column::make("Acciones")->label(
                function ($row) {
                    $edit = "<button class='btn btn-success' wire:click='edit($row->id)'>
                                   <i class='ti ti-pencil'></i>
                               </button>";
                    $delete = "<button class='btn btn-danger' wire:click='delete($row->id)'>
                                   <i class='ti ti-trash-x'></i>
                               </button>";
                    return '<div class="btn-group" role="group">' .
                        (auth()->user()->can('update', $row) ? $edit : '') .
                        (auth()->user()->can('delete', $row) ? $delete : '') . '</div>';
                }
            )->html(),
        ];
    }

    public function active($house): void
    {
        $this->emit('active', $house);
    }

    public function edit($house): void
    {
        $this->emit('edit', $house);
    }

    public function delete($house): void
    {
        $this->emit('showingDeleteModal', $house);
    }
}
