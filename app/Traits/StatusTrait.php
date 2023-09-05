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
            'generated' => '<button class="btn btn-secondary py-0 px-1 rounded-pill text-light">Generado</button>',
            'assigned' => '<button class="btn btn-primary py-0 px-1 rounded-pill text-light">Asignado</button>',
            'in_progress' => '<button class="btn btn-warning py-0 px-1 rounded-pill text-light fs-2">En progreso</button>',
            'finalized' => '<button class="btn btn-success py-0 px-1 rounded-pill text-light">Finalizado</button>',
            'approved' => '<button class="btn btn-success py-0 px-1 rounded-pill text-light">Aprobado</button>',
            'rejected' => '<button class="btn btn-danger py-0 px-1 rounded-pill text-light">Rechazado</button>',
            'paid' => '<button class="btn btn-muted py-0 px-1 rounded-pill text-light">Pagado</button>',
        ];
        return array_key_exists($status, $statuses) ? $statuses[$status] : 'Estado Desconocido';
    }
}
