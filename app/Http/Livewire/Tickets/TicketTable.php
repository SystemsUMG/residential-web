<?php

namespace App\Http\Livewire\Tickets;

use App\Enums\UserType;
use App\Models\User;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Ticket;

class TicketTable extends DataTableComponent
{
    use StatusTrait;

    protected $model = Ticket::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function builder(): Builder
    {
        $user = auth()->user();

        $query = Ticket::query()
            ->with('house', 'user', 'ticketCategory')
            ->select('tickets.*');

        if (!$user->hasRole([UserType::Operador->value, UserType::Admin->value])) {
            $query->where('tickets.user_id', $user->id);
        }

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Descripción", "description")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Estado")->label(
                function ($row) {
                    if (auth()->user()->can('status', $row)) {
                        return "<div wire:click='changeStatus($row->id)'>
                                    {$this->getStatusBadge($row->status)}</div>";
                    }
                    return "<div>{$this->getStatusBadge($row->status)}</div>";
                }
            )->html(),
            Column::make("Casa", "house.name")
                ->sortable()
                ->searchable(),
            Column::make("Residente", "user.id")->searchable()->sortable()->format(
                function ($row) {
                    $user = User::find($row);
                    return "$user->name $user->surname";
                }
            )->html(),
            Column::make("Categoría", "ticketCategory.name")
                ->sortable()
                ->searchable(),
            Column::make("Fecha", "created_at")
                ->sortable()
                ->searchable(),
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

    public function edit($ticket): void
    {
        $this->emit('edit', $ticket);
    }

    public function delete($ticket): void
    {
        $this->emit('showingDeleteModal', $ticket);
    }

    public function changeStatus($ticket): void
    {
        $this->emit('changeStatus', $ticket);
    }
}
