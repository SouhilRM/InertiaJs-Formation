<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class linstingController extends Controller
{
    public function index(Request $request){

        //$user = Auth::user() ?? false;//Auth::user() ? $user = Auth::user() : $user = false; same thing

        //soit tu mets "listing::class" soit "$listing" et tu le declare dans les parametres
        $this->authorize('viewAny', listing::class);

        //on va stocker les filtres en cours dans un props pour les conserver si jamais l'utilisateur vont envoyé un lien qui contiens le meme filtre de recherche; bien sur notre $filters va aussi servir pour build notre scopeFilter
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,

                'listings' => listing::latest()
                
                ->filter($filters)

                ->paginate(15)//paginate nous donne accés à l'attribut "link" qui permet de naviguer entre les pages

                ->withQueryString(),//permet de garder le filtre en cours de pagination
                
                //'can' => $user,
            ]
        );
    }

    public function show(listing $listing){
        //Pour les authorisations on utilisera le system de policys, il ya principalement 3 méthodes:
        //PREMIERE METHODE : conseillée sur les vues grace à la directive Auth::
        // if(Auth::user()->cannot('view')){
        //     abort(403);
        // }
        //DEUXIEME METHODE : conseillée sur les controller
        // $this->authorize('view', $listing);
        //TROISIEME METHODE : en utilisant le constructeur qui va tous gérer automatiquement à notre place, mais je suis moins fan mieux vaut gerer manuellement les choses
        
        $this->authorize('view', $listing);

        //Trés important pour pouvoir utliser la relationShip entre les deux tables
        $listing->load(['images']);

        $offerMade = !Auth::user() ? null //si le user n'est pas co ca  renvoie null
        : $listing->offers()->byMe()->first(); //ou ->get() ca marche aussi
        //le ->byMe() est une scopedQuerry qu'on a configuré dans le model offer

        //$listing = listing::findOrFail($id); on fesait comme ca precedement !!
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offerMade
            ]
        );
    }
}
