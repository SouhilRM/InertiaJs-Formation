<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function index(){
        return inertia(
            'Realtor/Index',
            [
                'listings' => Auth::user()->listings,
            ]
        );
    }

    public function delete(listing $listing){

        $this->authorize('delete', $listing);
        
        $listing->delete();
        return redirect()->back();
    }
}
