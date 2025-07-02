<?php

namespace App\Policies;

use App\Models\Booking;
use Illuminate\Auth\Access\Response;
use App\Models\User;

class BookingsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // User dapat melihat daftar booking mereka sendiri
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Booking $booking): bool
    {
        return $user->id === $booking->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // User dapat membuat booking baru
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Booking $booking): bool
    {
        // Hanya pemilik booking dan status masih pending yang bisa update
        return $user->id === $booking->user_id && 
               $booking->status->name === 'pending';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Booking $booking): bool
    {
        // Hanya pemilik booking dan status pending yang bisa dihapus
        return $user->id === $booking->user_id && 
               $booking->status->name === 'pending';
    }

    /**
     * Determine whether the user can cancel the booking.
     */
    public function cancel(User $user, Booking $booking): bool
    {
        // Hanya pemilik booking dan status pending/success yang bisa dicancel
        return $user->id === $booking->user_id && 
               in_array($booking->status->name, ['pending', 'success']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Booking $booking): bool
    {
        return false; // Tidak ada restore untuk booking
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Booking $booking): bool
    {
        return false; // Tidak ada force delete untuk booking
    }
}