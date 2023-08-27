<?php

namespace App\Enums;

enum StatusType: string {
    case Generado = 'generated';
    case Asignado = 'assigned';
    case EnProgreso = 'in_progress';
    case Finalizado = 'finalized';
    case Aprobado = 'approved';
    case Rechazado = 'rejected';
    case Pagado = 'paid';
}
