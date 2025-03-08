<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsRecruiter
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté et a le rôle "recruiter"
        if (Auth::check() && Auth::user()->role === 'recruiter') {
            return $next($request);
        }

        // Rediriger vers la page d'accueil avec un message d'erreur
        return redirect()->route('home')->with('error', 'Accès refusé. Vous devez être un recruteur pour accéder à cette page.');
    }
}