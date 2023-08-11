<?php

namespace App\Http\Livewire\Penalty;

use App\Models\User;
use Illuminate\Routing\Route;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Penalty;

class PenaltyTable extends DataTableComponent
{
    protected $model = Penalty::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function edit($id): void
    {
        $this->redirectRoute('penalties.edit', $id);
    }

    public function delete($id): void
    {
        $this->redirectRoute('penalties.destroy', $id);
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")->sortable(),
            Column::make("Categoría", "penaltyCategory.name")->sortable(),
            Column::make("Descripción", "description"),
            Column::make("Cantidad", "amount")->sortable()->format(
                fn($value) => 'Q.' . $value
            ),
            Column::make("Casa", "house.name")->sortable(),
            Column::make("Usuario", "user.id")->sortable()->format(
                function ($row) {
                    $user = User::find($row);
                   return "$user->name $user->surname";
                }
            )->html(),
            Column::make("Estado", "status")->sortable()->format(
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
}
