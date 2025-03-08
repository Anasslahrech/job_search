<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Afficher la liste des offres d'emploi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer toutes les offres d'emploi
        $jobs = Job::latest()->get(); // Triées par date de création (du plus récent au plus ancien)
        return view('home', compact('jobs'));
    }

    /**
     * Afficher le formulaire de création d'une offre d'emploi.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        // Vérifier que l'utilisateur est un recruteur
        if (Auth::check() && Auth::user()->role === 'recruiter') {
            return view('jobs.create');
        }

        // Rediriger les autres utilisateurs vers la page d'accueil avec un message d'erreur
        return redirect()->route('home')->with('error', 'Accès refusé. Vous devez être un recruteur pour accéder à cette page.');
    }

    /**
     * Enregistrer une nouvelle offre d'emploi.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Vérifier que l'utilisateur est un recruteur
        if (!Auth::check() || Auth::user()->role !== 'recruiter') {
            return redirect()->route('home')->with('error', 'Accès refusé. Vous devez être un recruteur pour accéder à cette page.');
        }

        // Valider les données du formulaire
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string',
            'company_name' => 'required|string|max:255',
            'company_website' => 'nullable|url',
        ]);

        // Créer l'offre d'emploi
        Job::create([
            'user_id' => Auth::user()->id, // Lier l'offre au recruteur connecté
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary' => $request->salary,
            'company_name' => $request->company_name,
            'company_website' => $request->company_website,
        ]);

        return redirect()->route('home')->with('success', 'Offre d\'emploi publiée avec succès !');
    }

    /**
     * Gérer la candidature à une offre d'emploi.
     *
     * @param int $id ID de l'offre d'emploi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apply($id)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour postuler à une offre.');
        }

        // Trouver l'offre d'emploi
        $job = Job::findOrFail($id);

        // Enregistrer la candidature
        Application::create([
            'user_id' => Auth::id(), // ID du candidat connecté
            'job_id' => $job->id, // ID de l'offre d'emploi
            'message' => request('message', ''), // Message facultatif (valeur par défaut vide)
        ]);

        // Rediriger vers la page d'accueil avec un message de succès
        return redirect()->route('home')->with('success', 'Votre candidature a été envoyée avec succès !');
    }
}