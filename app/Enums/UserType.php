<?php

namespace App\Enums;

enum UserType: string {
    case Admin = 'admin';
    case Resident = 'resident';
    case Guard = 'guard';
    case Operator = 'operator';
}
