<?php

namespace App\Policies;

use App\Models\PerjadianForm;
use App\Models\User;

class PerjadianFormPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PerjadianForm $perjadianForm): bool
    {
        return $user->id === $perjadianForm->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'user';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PerjadianForm $perjadianForm): bool
    {
        return $user->id === $perjadianForm->user_id && $perjadianForm->status === 'draft';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PerjadianForm $perjadianForm): bool
    {
        return $user->id === $perjadianForm->user_id && $perjadianForm->status === 'draft';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PerjadianForm $perjadianForm): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PerjadianForm $perjadianForm): bool
    {
        return false;
    }
}
