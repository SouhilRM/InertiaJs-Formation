<?php

namespace App\Http\Controllers;

use App\Models\listing;
use App\Models\Offer;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function store(listing $listing, Request $request){
        $this->authorize('view', $listing);
        $listing->offers()->save(
            Offer::make(
                $request->validate([
                    'amount' => 'required|integer|min:1|max:20000000'
                ])
            )->bidder()->associate($request->user())
        );
        return redirect()->back();
    }

    public function show(listing $listing)
    {
        //dd($listing->offers());
        //dd($listing->offers[0]->bidder->email);
        //$offres = $listing->load('offers')->offers->load('bidder');
        return inertia(
            'Realtor/Show', 
            
            //load('offers') permet d'acceder aux offres liées à ton listings spécifique car n'oublie pas que chaque listings à plusieurs offres ( vas re-check le model listing ); et load('offers.bidder') permet d'acceder l'utilisateur propre à ton offre
            ['listing' => $listing->load('offers','offers.bidder')]
        );
    }
}
