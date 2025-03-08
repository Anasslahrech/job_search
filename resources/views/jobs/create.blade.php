@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Poster une offre d'emploi</h2>
    
    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire de création d'offre d'emploi -->
    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titre de l'offre :</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lieu :</label>
            <input type="text" id="location" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="salary" class="form-label">Salaire :</label>
            <input type="text" id="salary" name="salary" class="form-control">
        </div>

        <div class="mb-3">
            <label for="company_name" class="form-label">Nom de l'entreprise :</label>
            <input type="text" id="company_name" name="company_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="company_website" class="form-label">Site web de l'entreprise :</label>
            <input type="url" id="company_website" name="company_website" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Publier l'offre</button>
    </form>
</div>
@endsection