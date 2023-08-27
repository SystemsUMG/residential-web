<?php

namespace App\Http\Livewire\Tickets;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
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
        return Ticket::query()
            ->with('house', 'user', 'ticketCategory')
            ->join('users', 'tickets.user_id', '=', 'users.id')
            ->select(
                DB::raw("CONCAT(users.name, ' ', users.surname) as user_name"),
                DB::raw("DATE_FORMAT(tickets.created_at, '%d-%m-%Y %H:%i:%s') as created_at")
            );
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
            Column::make("Estado", "status")
                ->searchable()
                ->sortable()->format(
                function ($row) {
                    return $this->getStatusBadge($row);
                }
            )->html(),
            Column::make("Casa", "house.name")
                ->sortable()
                ->searchable(),
            Column::make("Usuario")->sortable()->label(
                function ($row) {
                    return $row->user_name;
                }
            )->html(),
            Column::make("Categoría", "ticketCategory.name")
                ->sortable()
                ->searchable(),
            Column::make("Fecha")
                ->sortable()
                ->searchable()
                ->label(
                    function ($row) {
                        return $row->created_at;
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

    public function edit(Ticket $ticket): void
    {
        $this->emit('edit', $ticket);
    }

    public function delete(Ticket $ticket): void
    {
        $this->emit('showingDeleteModal', $ticket);
    }
}
