<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function index(Request $request){

        //dd((bool)$request->get('deleted') === false);
        //dd($request->boolean('deleted'));
        //true : "true","yes",1;
        //false : "false","no",0;

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        // if($request->boolean('deleted')){
        //     $querry = Auth::user()->listings()->latest()->onlyTrashed()->get();
        // }
        // else{
        //     $querry = Auth::user()->listings()->latest()->get();
        // }

        return inertia(
            'Realtor/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                ->listings()
                ->filter($filters)
                ->withCount('images')
                ->paginate(10)
                ->withQueryString()
            ]
        );

        /*
            listing::latest()->get() : TOUS les listings en commencant par les plus recents

            Auth::user()->listings   : les listings des personnes connectées

            Auth::user()->listings()->latest()->get() : les listings des personnes connectées en commencant par les plus recents

            ->onlyTrashed()->get() : seulement les listings suprimés

            ->withTrashed()()->get() : les listings suprimés + les listings suprimés
        */
    }

    public function delete(listing $listing){

        $this->authorize('delete', $listing);
        
        $listing->delete();
        return redirect()->back();
    }

    public function edit(listing $listing){
        
        $this->authorize('update', $listing);

        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(Request $request, listing $listing){

        $this->authorize('update', $listing);

        //pareil ici tu peux valider durant l'update aucun problème
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

        return redirect()->route('realtor.index');
    }

    public function create(){

        $this->authorize('create', listing::class);

        return inertia(
            'Realtor/Create',
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

    public function restore(listing $listing)
    {
        $listing->restore();

        return redirect()->back();
    }
}
