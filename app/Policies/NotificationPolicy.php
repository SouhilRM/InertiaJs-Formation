<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

use Illuminate\Notifications\DatabaseNotification;//Attention à ne pas confondre avec ca "use App\Models\DatabaseNotification;" ici il ne s'agit pas du model mais de Notification de laravel

class NotificationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DatabaseNotification $databaseNotification): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DatabaseNotification $databaseNotification): bool
    {
        //dans ce cas là on veux juste modifier plus tard si tu veux supprimer ou autre n'oublie pas d'utiliser les autres méthodes
        return $user->id === $databaseNotification->notifiable_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DatabaseNotification $databaseNotification): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DatabaseNotification $databaseNotification): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DatabaseNotification $databaseNotification): bool
    {
        //
    }
}
