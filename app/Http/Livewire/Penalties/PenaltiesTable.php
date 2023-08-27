<?php

namespace App\Http\Livewire\Penalties;

use App\Models\Penalty;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PenaltiesTable extends DataTableComponent
{
    protected $model = Penalty::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id" )->searchable()->sortable(),
            Column::make("Descripción", "description"),
            Column::make("Categoría", "penaltyCategory.name")->searchable()->sortable(),
            Column::make("Cantidad", "amount")->searchable()->sortable()->format(
                fn($value) => 'Q.' . $value
            ),
            Column::make("Casa", "house.name")->searchable()->sortable(),
            Column::make("Usuario", "user.id")->searchable()->sortable()->format(
                function ($row) {
                    $user = User::find($row);
                   return "$user->name $user->surname";
                }
            )->html(),
            Column::make("Estado", "status")->searchable()->sortable()->format(
                function ($row) {
                    return match ($row) {
                        1       => '<span class="badge bg-success rounded-3 fw-semibold">Pagado</span>',
                        default => '<span class="badge bg-danger rounded-3 fw-semibold">Pendiente</span>',
                    };
                }
            )->html(),
            Column::make("Acciones")->label(
                function ($row) {
                    $edit =   "<button class='btn btn-success' wire:click='edit({$row->id})'>
                                   <i class='ti ti-pencil'></i>
                               </button>";
                    $delete = "<button class='btn btn-danger' wire:click='delete({$row->id})'>
                                   <i class='ti ti-trash-x'></i>
                               </button>";
                    return '<div class="btn-group" role="group">' . $edit . $delete . '</div>';
                }
            )->html(),
        ];
    }

    public function edit(Penalty $penalty): void
    {
        $this->emit('edit', $penalty);
    }

    public function delete(Penalty $penalty): void
    {
        $this->emit('showingDeleteModal', $penalty);
    }
}
