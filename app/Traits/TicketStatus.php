<?php

namespace App\Traits;

trait TicketStatus
{
    public function getTicketStatus($status): string
    {
        $statuses = [
            'generated' => 'Generado',
            'assigned' => 'Asignado',
            'in_progress' => 'En progreso',
            'finalized' => 'Finalizado',
        ];
        return array_key_exists($status, $statuses) ? $statuses[$status] : 'Estado Desconocido';
    }

    public function getTicketStatusBadge($status): string
    {
        $statuses = [
            'generated' => '<span class="badge rounded-pill text-bg-secondary">Generado</span>',
            'assigned' => '<span class="badge rounded-pill text-bg-primary">Asignado</span>',
            'in_progress' => '<span class="badge rounded-pill text-bg-warning">En progreso</span>',
            'finalized' => '<span class="badge rounded-pill text-bg-success">Finalizado</span>',
        ];
        return array_key_exists($status, $statuses) ? $statuses[$status] : 'Estado Desconocido';
    }
}
