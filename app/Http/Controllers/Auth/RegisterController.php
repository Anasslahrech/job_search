<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Inscription du recruteur
    public function registerRecruiter(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Les mots de passe doivent correspondre.',
        ]);

        // Si la validation échoue
        if ($validator->fails()) {
            return redirect()->route('register.recruiter')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Création de l'utilisateur recruteur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'recruiter',  // Assurez-vous que ce champ est défini dans votre modèle User
        ]);

        // Connexion automatique de l'utilisateur après l'inscription
        Auth::login($user);

        // Redirection vers la page d'accueil
        return redirect()->route('home');
    }

    // Inscription du candidat
    public function registerCandidate(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Les mots de passe doivent correspondre.',
        ]);

        // Si la validation échoue
        if ($validator->fails()) {
            return redirect()->route('register.candidate')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Création de l'utilisateur candidat
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'candidate',  // Assurez-vous que ce champ est défini dans votre modèle User
        ]);

        // Connexion automatique de l'utilisateur après l'inscription
        Auth::login($user);

        // Redirection vers la page d'accueil
        return redirect()->route('home');
    }
}
