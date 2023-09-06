<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class TicketCategory extends Model
{
    use HasFactory, HasRoles;

    protected $guarded = [];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
