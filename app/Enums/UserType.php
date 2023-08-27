<?php

namespace App\Enums;

enum UserType: string {
    case Admin = 'admin';
    case Residente = 'resident';
    case Guardia = 'guard';
    case Operador = 'operator';
}
