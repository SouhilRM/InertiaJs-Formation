<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return inertia('Auth/Login');
    }

    public function store(Request $request)
    {
        //pour l'authentification on va la faire manuellement, n'oublie pas d'importer la facade "Auth" en haut
        //on utilise la méthode attempt() que fournit Laravel via la facade Auth qui prends en compte deux parametres
        if(!Auth::attempt(
            //le premier paramettre prends la validation pour permettre à la methode de verifier si le mail et le mdp match bien et renvoie True si c'est le cas et continue son execution et False sinon avec le renvoie des messages d'erreur de validation.
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]),
            //le second parametre concerne la session du user si elle reste ouverte de manière prolongéé ou non; si tu mets à "True" la session restera ouverte grace aux coukies du navigateur, si tu mets "False" la session se fermera normalement et l'utilisateur sera deconnecté au bout de 24min ( PHP convention )
            true
            )){
                //bien n'oublions pas qu'on est dans une négation càd que si tt se passe bien et que la méthode attempt() renvoie un TRUE on va juste continuer la navigation, mais si elle renvoie un False alors on va lever une ValidationException
                throw ValidationException::withMessages([
                    //on utilisera la method withMessages qui comprendra les messages d'erreurs
                    //ATTENTION : mieux vaut ne pas tros preciser les erreurs de validation pour eviter de fournir les information aux pottentiels hack; donc tu mets juste un simple message d'erreur du genre 'Authentification failed' c'st tt !!
                    'email' => 'Authentification failed'
                ]);
            }
        //bien nous avons finis avec la negation maintenant que faire s'il n ya aucune erreur ? on va regenerer la session pour eviter qu'un hack ne puisse acceder à la session de l'utilisateur c'est pour ca qu'on reinitialises l'ID de la session
        $request->session()->regenerate();
        return redirect()->intended('/index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
