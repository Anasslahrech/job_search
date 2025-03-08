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
    // Méthode pour enregistrer un candidat
    public function registerCandidate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'civility' => 'required|in:Monsieur,Madame',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|confirmed',
            'email_confirmation' => 'required|same:email',
            'phone' => 'required|string|regex:/^\+\d{1,3}\d{4,14}$/',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Les mots de passe doivent correspondre.',
            'email.confirmed' => 'Les emails doivent correspondre.',
            'phone.regex' => 'Le numéro de téléphone doit être au format international (+XX suivi du numéro).',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register.candidate')
                             ->withErrors($validator)
                             ->withInput();
        }

        $user = User::create([
            'civility' => $request->civility,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'candidate',
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    // Méthode pour enregistrer un recruteur
    public function registerRecruiter(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email|confirmed',
        'email_confirmation' => 'required|same:email',
        'phone' => 'required|string|regex:/^\+\d{1,3}\d{4,14}$/',
        'address' => 'required|string|max:255',
        'postal_code' => 'required|string|max:20',
        'city' => 'required|string|max:100',
        'country' => 'required|string|max:100|in:Algeria,Angola,Benin,...',
        'employee_count' => 'required|integer|min:1',
        'website' => 'nullable|url',
        'logo' => 'nullable|mimes:pdf|max:10240',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'email.confirmed' => 'Les emails doivent correspondre.',
        'email_confirmation.required' => 'Le champ de confirmation de l\'email est requis.',
        'email_confirmation.same' => 'Les emails doivent correspondre.',
        'password.confirmed' => 'Les mots de passe doivent correspondre.',
        'phone.regex' => 'Le numéro de téléphone doit être au format international (+XX suivi du numéro).',
        'logo.mimes' => 'Le logo doit être un fichier PDF.',
    ]);

    if ($validator->fails()) {
        return redirect()->route('register.recruiter')
                         ->withErrors($validator)
                         ->withInput();
    }

    // Gestion du fichier logo
    $logoPath = null;
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
    }

    // Création de l'utilisateur
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'postal_code' => $request->postal_code,
        'city' => $request->city,
        'country' => $request->country,
        'employee_count' => $request->employee_count,
        'website' => $request->website,
        'logo' => $logoPath,
        'password' => Hash::make($request->password),
        'role' => 'recruiter',
    ]);

    // Connexion de l'utilisateur
    Auth::login($user);

    // Redirection vers la page d'accueil
    return redirect()->route('home')->with('success', 'Inscription réussie !');
}
}
