@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="w-50">
        <h2 class="text-center mb-4">Inscription Recruteur</h2>

        <!-- Afficher les erreurs de validation -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.recruiter.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nom de l'entreprise :</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email :</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>

    <!-- Ajoutez ce champ pour confirmer l'e-mail -->
    <div class="mb-3">
        <label for="email_confirmation" class="form-label">Confirmez l'email :</label>
        <input type="email" id="email_confirmation" name="email_confirmation" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Téléphone :</label>
        <input type="text" id="phone" name="phone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Adresse :</label>
        <input type="text" id="address" name="address" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="postal_code" class="form-label">Code postal :</label>
        <input type="text" id="postal_code" name="postal_code" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="city" class="form-label">Ville :</label>
        <input type="text" id="city" name="city" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="country" class="form-label">Pays :</label>
        <select id="country" name="country" class="form-control" required>
            <option value="Algeria">Algérie</option>
            <option value="Angola">Angola</option>
            <option value="Benin">Bénin</option>
            <!-- Ajoutez d'autres pays africains ici -->
        </select>
    </div>

    <div class="mb-3">
        <label for="employee_count" class="form-label">Nombre d'employés :</label>
        <input type="number" id="employee_count" name="employee_count" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="website" class="form-label">Site web :</label>
        <input type="url" id="website" name="website" class="form-control">
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label">Logo (PDF) :</label>
        <input type="file" id="logo" name="logo" class="form-control">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe :</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmez le mot de passe :</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
</form>
    </div>
</div>
@endsection