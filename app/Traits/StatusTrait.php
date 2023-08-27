<?php

namespace App\Traits;

trait StatusTrait
{
    public function getStatus($status): string
    {
        $statuses = [
            'generated' => 'Generado',
            'assigned' => 'Asignado',
            'in_progress' => 'En progreso',
            'finalized' => 'Finalizado',
            'approved' => 'Aprobado',
            'rejected' => 'Rechazado',
            'paid' => 'Pagado',
        ];
        return array_key_exists($status, $statuses) ? $statuses[$status] : 'Estado Desconocido';
    }

    public function getStatusBadge($status): string
    {
        $statuses = [
            'generated' => '<span class="badge rounded-pill text-bg-secondary">Generado</span>',
            'assigned' => '<span class="badge rounded-pill text-bg-primary">Asignado</span>',
            'in_progress' => '<span class="badge rounded-pill text-bg-warning">En progreso</span>',
            'finalized' => '<span class="badge rounded-pill text-bg-success">Finalizado</span>',
            'approved' => '<span class="badge rounded-pill text-bg-success">Aprobado</span>',
            'rejected' => '<span class="badge rounded-pill text-bg-danger">Rechazado</span>',
            'paid' => '<span class="badge rounded-pill text-bg-muted">Pagado</span>',
        ];
        return array_key_exists($status, $statuses) ? $statuses[$status] : 'Estado Desconocido';
    }
}
