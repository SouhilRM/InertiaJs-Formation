<?php

namespace App\Policies;

use App\Models\User;
use App\Models\listing;
use Illuminate\Auth\Access\Response;

class listingPolicy
{
    // "?User" veut dire que l'objet User est optionnel parcequ'on peut tres bien avoir un utilisateur non connecter qui ne possede donc pas ce model, c'est pour cela qu'on n'utilisera pas le '?User' dans les action ou il faut absolument etre connecter comme la suppression ou la modification, mais qu'on poura l'utiliser dans les action accessible par tout le monde comme visionner tous les listings ou un listing en particulier

    public function before(?User $user, $ability) //le mot clé "before" est important ici !!
    {
        //en PHP.8 tu peux utiliser le ? comme ca "$user?->is_admin" cela signifie que si le $user est null càd que personne n'est conneter ( c'est pour ca qu'on a mis ?User dans les parametres ) cela ne cosera pas de problèmes
        if ($user?->is_admin /*&& $ability === 'update'*/) {
            return true;
        }
        //cela signifie que si l'utilisateur connécté est un admin alors il poura FAIRE tous ce qu'il voudra

        // if ($user?->is_admin && $ability === 'update') {
        //     return true;
        // }
        // cela signifie que si l'utilisateur connécté est un admin alors il poura modifier tous ce qu'il voudra
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, listing $listing): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; //on changera ca plus tard pour juste les users vérifiés et pas le premier venu
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, listing $listing): bool
    {
        //"seuls les user qui ont créé ce listing peuvent le changer"
        return $user->id === $listing->by_user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, listing $listing): bool
    {
        //"seuls les user qui ont créé ce listing peuvent le supprimer"
        return $user->id === $listing->by_user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }
}
