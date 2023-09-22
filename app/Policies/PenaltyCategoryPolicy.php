<?php

namespace App\Policies;

use App\Models\PenaltyCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PenaltyCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view penalty categories');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PenaltyCategory $penaltyCategory): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create penalty categories');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PenaltyCategory $penaltyCategory): bool
    {
        return $user->hasPermissionTo('edit penalty categories');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PenaltyCategory $penaltyCategory): bool
    {
        return $user->hasPermissionTo('delete penalty categories');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PenaltyCategory $penaltyCategory): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PenaltyCategory $penaltyCategory): bool
    {
        //
    }
}
