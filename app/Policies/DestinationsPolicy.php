<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class DestinationsPolicy
{
    // Universal method untuk semua model (Area, Facility, Booking)
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function view(User $user, $model): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function update(User $user, $model): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function delete(User $user, $model): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function restore(User $user, $model): bool
    {
        return $user->hasRole('Super Admin');
    }

    public function forceDelete(User $user, $model): bool
    {
        return $user->hasRole('Super Admin');
    }
}