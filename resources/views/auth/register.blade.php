@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="text-center">
        <h2>Inscription</h2>
        <p>Choisissez votre type de compte :</p>
        <div class="d-flex justify-content-center gap-5 mt-4">
            <a href="{{ route('register.recruiter') }}" class="text-decoration-none">
                <img src="/images/recruiter.png" alt="Recruteur" class="img-fluid" style="max-width: 510px; max-height: 500px;">
                <h4 class="mt-2">Recruteur</h4>
            </a>
            <a href="{{ route('register.candidate') }}" class="text-decoration-none">
                <img src="/images/candidate.png" alt="Candidat" class="img-fluid" style="max-width: 600px; max-height: 500px;">
                <h4 class="mt-2">Candidat</h4>
            </a>
        </div>
    </div>
</div>
@endsection
