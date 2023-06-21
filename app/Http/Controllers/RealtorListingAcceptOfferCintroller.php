<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferCintroller extends Controller
{
    //"__invoke" c'est ce qu'on appel un onesingletache controller, il n'effectue qu'une seule et unique tache 
    public function __invoke(Offer $offer)
    {
        $this->authorize('update', $offer->listing);

        //Accept selected offer
        $offer->update(['accepted_at' => now()]);
        
        $offer->listing->sold_at = now();
        $offer->listing->save();
        //ou ca c'est la meme chose $offer->listing()->update(['sold_at' => now()]);

        //Reject all other offers
        $offer->listing->offers()->except($offer)
           ->update(['rejected_at' => now()]);

        return redirect()->back();
    }
}
