<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;

class linstingController extends Controller
{
    public function index(){
        return inertia(
            'Listing/Index',
            [
                'listings' => listing::all()
            ]
        );
    }

    public function show(listing $listing){
        //$listing = listing::findOrFail($id); on fesait comme ca precedement !!
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }

    public function create(){
        return inertia(
            'Listing/Create',
        );
    }

    public function store(Request $request){
        //dd($request->all());

        // listing::insert([
        //     'beds' => $request->beds,
        //     'baths' => $request->baths,
        //     'area' => $request->area,
        //     'city' => $request->city,
        //     'street' => $request->street,
        //     'code' => $request->code,
        //     'street_nr' => $request->street_nr,
        //     'price' => $request->price,
        // ]);
        listing::create($request->all());

        return redirect()->route('listing.index')->with('success', 'Listing was created!');
    }

    public function edit(listing $listing){
        return inertia(
            'Listing/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(Request $request, listing $listing){
        
        $listing->update($request->all());

        return redirect()->route('listing.index')->with('success', 'Listing was UPDATE !!');
    }

    public function delete(listing $listing){
        $listing->delete();
        return redirect()->back()->with('success', 'Listing was deleted !!');
    }
}
