<?php

namespace App\Http\Livewire\Tickets;

use App\Models\User;
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
            ->select('tickets.*');
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
                    return "<div wire:click='changeStatus({$row->id})' class='cursor-pointer'>
                                    {$this->getStatusBadge($row->status)}</div>";
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

    public function changeStatus(Ticket $ticket): void
    {
        $this->emit('changeStatus', $ticket);
    }
}
