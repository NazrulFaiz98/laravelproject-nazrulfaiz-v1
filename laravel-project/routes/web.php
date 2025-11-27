<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompaniesController;
use Illuminate\Support\Facades\Route;

Route::get("/",[WelcomeController::class,"welcome"])->name("welcome");

// Auth Routes
Route::middleware('guest')->group(function () {
	Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
	Route::post('/login', [AuthController::class, 'login'])->name('login.post');
	});

// Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
	// Keep a single canonical URL for the companies listing.
	// Redirect /dashboard -> /companies with a 301 permanent redirect.
	Route::redirect('/dashboard', '/companies', 301)->name('dashboard');
	Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');

	// Company management - static routes first
	Route::get('/companies/create', [CompaniesController::class, 'create'])->name('companies.create');
	Route::post('/companies', [CompaniesController::class, 'store'])->name('companies.store');

	// Employee nested routes (add employee to a specific company)
	Route::get('/companies/{id}/employees/create', [CompaniesController::class, 'createEmployee'])->name('companies.employees.create');
	Route::post('/companies/{id}/employees', [CompaniesController::class, 'storeEmployee'])->name('companies.employees.store');
	Route::delete('/companies/{id}/employees/{employeeId}', [CompaniesController::class, 'destroyEmployee'])->name('companies.employees.destroy');

	// Show and delete (dynamic)
	Route::get('/companies/{id}', [CompaniesController::class, 'show'])->name('companies.show');
	Route::delete('/companies/{id}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
});

