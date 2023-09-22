<?php

namespace App\Http\Livewire\Dashboard;

use App\Enums\StatusType;
use App\Models\House;
use App\Models\Penalty;
use App\Models\PenaltyCategory;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Traits\StatusTrait;
use App\Traits\ToastTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    use StatusTrait, ToastTrait;

    protected $listeners = ['updateChart'];
    public $dateMin, $dateMax, $startDate, $endDate;
    public $ticketCategories, $dataTickets, $ticketColors;
    public $houseAvailable, $houseNotAvailable;
    public $totalPenalties, $penaltyCategories, $dataPenalties;
    public $dataTransactions;
    public $rankingPenalties;

    public function mount(): void
    {
        $this->initializeDatesAndCategories();

        $this->getTicketStatistics();
        $this->getPenaltyStatistics();

        $this->getHouseStatistics();

        $this->getRecentTransactions();

        $this->getRatingPenalties();
    }

    public function updateChart(): void
    {
        try {
            $this->updateTicketStatistics();
            $this->updatePenaltyStatistics();

            $this->getRecentTransactions();
            $this->getRatingPenalties();
        } catch (\Exception $e) {
            $this->toast('error', $e->getMessage());
        }
    }

    private function initializeDatesAndCategories(): void
    {
        $dateMin = Ticket::min('created_at');
        $this->dateMin = date('Y-m-d', strtotime($dateMin));
        $dateMax = Ticket::max('created_at');
        $this->dateMax = date('Y-m-d', strtotime($dateMax));
        $this->endDate = $this->dateMax;
        $this->startDate = date('Y-m-d', strtotime('-1 month', strtotime($this->endDate)));

        $this->ticketCategories = TicketCategory::pluck('name');
        $this->ticketColors = [
            "#E6B0AA", "#D2B4DE", "#AED6F1", "#A2D9CE", "#F9E79F", "#F5CBA7", "#CCD1D1", "#ABB2B9", "#F1948A", "#BB8FCE",
            "#85C1E9", "#76D7C4", "#F7DC6F", "#F4D03F", "#D7DBDD", "#99A3A4", "#EC7063", "#AF7AC5", "#5DADE2", "#48C9B0",
        ];
    }

    private function getTicketStatistics(): void
    {
        $this->dataTickets = Ticket::groupBy('ticket_category_id')
            ->selectRaw('ticket_category_id, COUNT(*) as total')
            ->pluck('total', 'ticket_category_id')
            ->toArray();
        $this->dataTickets = array_values($this->dataTickets);
    }

    private function getPenaltyStatistics(): void
    {
        $this->totalPenalties = Penalty::pluck('amount')->sum();
        $this->penaltyCategories = PenaltyCategory::pluck('name');

        $this->dataPenalties = Penalty::groupBy('penalty_category_id')
            ->selectRaw('penalty_category_id, COUNT(*) as total')
            ->pluck('total', 'penalty_category_id')
            ->toArray();
        $this->dataPenalties = array_values($this->dataPenalties);
    }

    private function getHouseStatistics(): void
    {
        $this->houseAvailable = House::where('user_id', '!=', null)->count();
        $this->houseNotAvailable = House::where('user_id', null)->count();
    }

    private function getRecentTransactions(): void
    {
        $tickets = $this->getRecentTransactionsOfType(Ticket::class, 'Ticket');
        $penalties = $this->getRecentTransactionsOfType(Penalty::class, 'Multa');
        $this->dataTransactions = $tickets->merge($penalties);
    }

    private function getRatingPenalties(): void
    {
        $startDate = date('Y-m-d', strtotime('+1 day', strtotime($this->startDate))) . ' 00:00:00';
        $endDate = date('Y-m-d', strtotime('+1 day', strtotime($this->endDate))) . ' 23:59:59';

        $this->rankingPenalties = House::selectRaw(
            'houses.id,
            users.name as owner,
            houses.code,
            COUNT(house_id) as total_penalties,
            SUM(penalties.amount) as total_sum'
        )
            ->join('users', 'houses.user_id', '=', 'users.id')
            ->leftJoin('penalties', 'houses.id', '=', 'penalties.house_id')
            ->whereBetween('penalties.created_at', [$startDate, $endDate])
            ->whereNotIn('penalties.status', [StatusType::Finalizado, StatusType::Rechazado])
            ->groupBy('houses.id', 'users.name', 'houses.code')
            ->orderBy('total_sum', 'desc')
            ->take(5)
            ->get()
            ->toArray();
    }

    private function getRecentTransactionsOfType($modelClass, $type)
    {
        $startDate = date('Y-m-d', strtotime('+1 day', strtotime($this->startDate))) . ' 00:00:00';
        $endDate = date('Y-m-d', strtotime('+1 day', strtotime($this->endDate))) . ' 23:59:59';

        return $modelClass::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->select('created_at as datetime', 'status', 'description', \DB::raw("'$type' as type"))
            ->get()
            ->map(function ($item) use ($type) {
                $datetime = new \DateTime($item->datetime);
                return [
                    'datetime' => $datetime->format('d-m-Y H:i:s'),
                    'status' => $this->getStatusColor($item->status),
                    'description' => $item->description,
                    'type' => $type,
                ];
            });
    }

    private function updateTicketStatistics(): void
    {
        $startDate = date('Y-m-d', strtotime('+1 day', strtotime($this->startDate))) . ' 00:00:00';
        $endDate = date('Y-m-d', strtotime('+1 day', strtotime($this->endDate))) . ' 23:59:59';

        $this->dataTickets = Ticket::whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('ticket_category_id')
            ->selectRaw('ticket_category_id, COUNT(*) as total')
            ->pluck('total', 'ticket_category_id')
            ->toArray();
        $this->dataTickets = array_values($this->dataTickets);

        $this->emit('updateDataTickets', $this->dataTickets);
    }

    private function updatePenaltyStatistics(): void
    {
        $startDate = date('Y-m-d', strtotime('+1 day', strtotime($this->startDate))) . ' 00:00:00';
        $endDate = date('Y-m-d', strtotime('+1 day', strtotime($this->endDate))) . ' 23:59:59';

        $this->totalPenalties = Penalty::whereBetween('created_at', [$startDate, $endDate])->pluck('amount')->sum();

        $this->dataPenalties = Penalty::whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('penalty_category_id')
            ->selectRaw('penalty_category_id, COUNT(*) as total')
            ->pluck('total', 'penalty_category_id')
            ->toArray();
        $this->dataPenalties = array_values($this->dataPenalties);

        $this->emit('updateDataPenalties', $this->dataPenalties);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.dashboard.dashboard');
    }
}
