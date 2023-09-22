<?php

namespace App\Policies;

use App\Models\Penalty;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PenaltyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view penalties');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Penalty $penalty): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create penalties');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Penalty $penalty): bool
    {
        return $user->hasPermissionTo('edit penalties');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Penalty $penalty): bool
    {
        return $user->hasPermissionTo('delete penalties');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Penalty $penalty): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Penalty $penalty): bool
    {
        //
    }

    public function status(User $user, Penalty $penalty): bool
    {
        return $user->hasPermissionTo('status penalties');
    }
}
