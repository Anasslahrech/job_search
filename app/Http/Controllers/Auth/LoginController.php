<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Affichage du formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traitement de la soumission du formulaire de connexion
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Connexion réussie
            $user = Auth::user();

            // Redirection en fonction du rôle
            if ($user->role === 'recruiter') {
                return redirect()->route('jobs.create'); // Rediriger vers la page de création d'offre
            } else {
                return redirect()->route('home'); // Rediriger vers la page d'accueil pour les autres rôles
            }
        }

        // En cas d'échec, renvoyer à la page de connexion avec une erreur
        return redirect()->back()->withErrors(['email' => 'Les informations d\'identification sont incorrectes.']);
    }

    // Déconnexion
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}