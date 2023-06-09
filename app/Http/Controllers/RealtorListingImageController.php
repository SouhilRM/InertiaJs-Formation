<?php

namespace App\Http\Controllers;

use App\Models\listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;

class RealtorListingImageController extends Controller
{
    public function create(listing $listing)
    {
        return inertia(
            'Realtor/ListingImage/Create',
            [
                'listing' => $listing
            ]
        );
    }

    public function store(listing $listing, Request $request)
    {
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path
                ]));
            }
        }

        return redirect()->back();
    }
}
