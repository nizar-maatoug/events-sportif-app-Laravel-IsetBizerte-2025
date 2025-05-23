<?php

namespace App\Policies;

use App\Models\EventSportif;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventSportifPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Assuming all users can view any event
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EventSportif $eventSportif): bool
    {
        return true; // Assuming all users can view any event
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isOrganizer();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EventSportif $eventSportif): bool
    {
        return $user->isAdmin() || ($user->isOrganizer() && $eventSportif->organizer_id == $user->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EventSportif $eventSportif): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EventSportif $eventSportif): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EventSportif $eventSportif): bool
    {
        return $user->isAdmin();
    }
}
