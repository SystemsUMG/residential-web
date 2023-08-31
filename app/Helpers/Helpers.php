<?php

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

function errorHelper($exception): \Illuminate\Foundation\Application|array|string|Translator|Application|null
{
    return match ($exception->getCode()) {
        "23000" => 'No se puede eliminar el registro porque tiene registros relacionados',
        default => $exception->getMessage(),
    };
}
