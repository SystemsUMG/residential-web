<?php

use App\Enums\UserType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

function errorHelper($exception): \Illuminate\Foundation\Application|array|string|Translator|Application|null
{
    if (property_exists($exception, 'errorInfo')) {
        $code = $exception->errorInfo[0];
        $message = $exception->errorInfo[2];
    } else {
        $code = $exception->getCode();
        $message = $exception->getMessage();
    }
    return "Código: $code: $message";
}

function getRoleName($role): string
{
    return match ($role) {
        UserType::Admin->value => 'Administrador',
        UserType::Residente->value => 'Residente',
        UserType::Operador->value => 'Operador',
        UserType::Guardia->value => 'Guardia',
        default => 'Sin rol',
    };
}
