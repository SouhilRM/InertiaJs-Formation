<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class linstingController extends Controller
{
    public function index(Request $request){

        $user = Auth::user() ?? false;//Auth::user() ? $user = Auth::user() : $user = false; same thing

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
                
                'can' => $user,
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

        //$listing = listing::findOrFail($id); on fesait comme ca precedement !!
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }

    public function create(){

        $this->authorize('create', listing::class);

        return inertia(
            'Listing/Create',
        );
    }

    public function store(Request $request){

        $this->authorize('create', listing::class);
        
        //Avant on fesait comme ci-dessous
        // $request->validate([
        //     'beds' => 'required|integer|min:0|max:20',
        //     'baths' => 'required|integer|min:0|max:20',
        //     'area' => 'required|integer|min:15|max:1500',
        //     'city' => 'required',
        //     'code' => 'required',
        //     'street' => 'required',
        //     'street_nr' => 'required|min:1|max:1000',
        //     'price' => 'required|integer|min:1|max:20000000',
        // ]);
        // listing::create([ //la difference entre insert et create c'est que create donne des valeurs aux champs "created_at" et "updated_at"
        //     'by_user_id' => Auth::user()->id, ou $request->user(), c'est la meme chose //renvoite l'id du user courent
        //     'beds' => $request->beds,
        //     'baths' => $request->baths,
        //     'area' => $request->area,
        //     'city' => $request->city,
        //     'street' => $request->street,
        //     'code' => $request->code,
        //     'street_nr' => $request->street_nr,
        //     'price' => $request->price,
        // ]);
        
        //$request->user() === Auth::user() c'est la meme chose !!!
        //Tous ceci peux etre plus simplifier vu qu'on a une relationship
        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );
        
        return redirect()->route('listing.index');
    }

    public function edit(listing $listing){
        
        $this->authorize('update', $listing);

        return inertia(
            'Listing/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(Request $request, listing $listing){

        $this->authorize('update', $listing);

        //pareil ici tu peux valider durant l'update aucun provlème
        $listing->update(
            $request->validate([
                'beds' => 'required|numeric',
                'baths' => 'required|numeric',
                'area' => 'required|numeric',
                'city' => 'required',
                'street' => 'required',
                'code' => 'required',
                'street_nr' => 'required',
                'price' => 'required|numeric',
            ])
        );

        return redirect()->route('listing.index');
    }

    public function delete(listing $listing){

        $this->authorize('delete', $listing);

        $listing->delete();
        return redirect()->back();
    }
}
