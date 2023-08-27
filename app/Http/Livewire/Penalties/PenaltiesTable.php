<?php

namespace App\Http\Livewire\Penalties;

use App\Models\Penalty;
use App\Models\User;
use App\Traits\StatusTrait;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class PenaltiesTable extends DataTableComponent
{
    use StatusTrait;

    protected $model = Penalty::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function builder(): Builder
    {
        return Penalty::query()
            ->select('penalties.*');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")->searchable()->sortable(),
            Column::make("Descripción", "description"),
            Column::make("Categoría", "penaltyCategory.name")->searchable()->sortable(),
            Column::make("Cantidad", "amount")->searchable()->sortable()->format(
                fn($value) => 'Q.' . $value
            ),
            Column::make("Casa", "house.name")->searchable()->sortable(),
            Column::make("Guardia", "user.id")->searchable()->sortable()->format(
                function ($row) {
                    $user = User::find($row);
                    return "$user->name $user->surname";
                }
            )->html(),
            Column::make("Estado")->label(
                function ($row) {
                    return "<div wire:click='changeStatus({$row->id})' class='cursor-pointer'>
                                    {$this->getStatusBadge($row->status)}</div>";
                }
            )->html(),
            Column::make("Acciones")->label(
                function ($row) {
                    $edit = "<button class='btn btn-success' wire:click='edit({$row->id})'>
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

    public function changeStatus(Penalty $penalty): void
    {
        $this->emit('changeStatus', $penalty);
    }
}
