<?php

namespace App\Http\Livewire\PenaltyCategories;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PenaltyCategory;

class PenaltyCategoriesTable extends DataTableComponent
{
    protected $model = PenaltyCategory::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),
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
    public function edit($penaltyCategory): void
    {
        $this->emit('edit', $penaltyCategory);
    }

    public function delete($penaltyCategory): void
    {
        $this->emit('showingDeleteModal', $penaltyCategory);
    }
}
