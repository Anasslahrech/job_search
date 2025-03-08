@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="w-50">
        <h2 class="text-center mb-4">Inscription Candidat</h2>
        <form action="{{ route('register.candidate.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="civility" class="form-label">Civilité :</label>
                <select id="civility" name="civility" class="form-control" required>
                    <option value="Monsieur">Monsieur</option>
                    <option value="Madame">Madame</option>
                </select>
                @error('civility')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nom :</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email_confirmation" class="form-label">Confirmer l'Email :</label>
                <input type="email" id="email_confirmation" name="email_confirmation" class="form-control" required>
                @error('email_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Numéro de téléphone :</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Ex: +212600000000" required>
                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe :</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
        </form>
    </div>
</div>
@endsection