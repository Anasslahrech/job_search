<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;

// Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

// Other Static Pages
Route::get('/category', function () {
    return view('category');
})->name('category');

Route::get('/testimonial', function () {
    return view('testimonial');
})->name('testimonial');

Route::get('/404', function () {
    return view('404');
})->name('404');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/job-list', function () {
    return view('job-list');
})->name('job-list');

Route::get('/job-detail', function () {
    return view('job-detail');
})->name('job-detail');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Registration Routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/register/recruiter', function () {
    return view('auth.register-recruiter');
})->name('register.recruiter');

Route::post('/register/recruiter', [RegisterController::class, 'registerRecruiter'])->name('register.recruiter.submit');

Route::get('/register/candidate', function () {
    return view('auth.register-candidate');
})->name('register.candidate');

Route::post('/register/candidate', [RegisterController::class, 'registerCandidate'])->name('register.candidate.submit');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Home Route After Login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Routes protégées pour les recruteurs
Route::middleware('auth')->group(function () {
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
});