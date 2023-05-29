<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function register()
    {
        return inertia('UserAccount/Create');
    }

    public function store(Request $request){

        // $user = User::make($request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:8|confirmed'
        // ]));

        // $user->password = Hash::make($user->password);

        // $user->save();

        $user = User::create($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]));

        Auth::login($user);

        return redirect()->route('listing.index');
    }
}
