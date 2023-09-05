<?php

namespace App\Http\Livewire\Users;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function builder(): Builder
    {
        return User::query()
            ->select('users.*');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->searchable()
                ->sortable(),
            Column::make("Apellido", "surname")
                ->searchable()
                ->sortable(),
            Column::make("Correo Electrónico", "email")
                ->searchable()
                ->sortable(),
            Column::make("Teléfono", "phone")
                ->searchable()
                ->sortable(),
            BooleanColumn::make("Activo", "active")
                ->sortable(),
            Column::make("Rol")
                ->searchable()
                ->sortable()
                ->label(function ($row) {
                    $role = $row->roles->first();
                    return $role?->name;
                }),
            Column::make("Lista de Familiares")
                ->label(function ($row) {
                    $id = $row->id;
                    $count = count($row->family_list ?? []);
                    return auth()->user()->can('update', $row) ? "<span class='badge text-bg-primary cursor-pointer' wire:click='seeFamily($id)'>$count</span>" : '';
                })->html(),
            Column::make("Creación", "created_at")
                ->sortable(),
            Column::make("Acciones")->label(
                function ($row) {
                    $edit = "<button class='btn btn-success' wire:click='edit({$row->id})'>
                                   <i class='ti ti-pencil'></i>
                               </button>";
                    $delete = "<button class='btn btn-danger' wire:click='delete({$row->id})'>
                                   <i class='ti ti-trash-x'></i>
                               </button>";
                    return '<div class="btn-group" role="group">' .
                        (auth()->user()->can('update', $row) ? $edit : '') .
                        (auth()->user()->can('delete', $row) ? $delete : '') . '</div>';
                }
            )->html(),
        ];
    }

    public function seeFamily($user): void
    {
        $this->emit('seeFamily', $user);
    }

    public function edit(User $user): void
    {
        $this->emit('edit', $user);
    }

    public function delete(User $user): void
    {
        $this->emit('showingDeleteModal', $user);
    }
}
