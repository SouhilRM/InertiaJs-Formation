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

    public function show(Listing $listing){
        //$listing = listing::findOrFail($id); on fesait comme ca precedement !!
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }
}
