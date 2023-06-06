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
                //->latest() inclu dans les filttres
                ->filter($filters)
                ->get(),
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
}
