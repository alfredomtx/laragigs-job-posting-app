<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// All listings
Route::get('/', [ListingController::class, 'index']);
// Show create form
Route::get('/listing/create', [ListingController::class, 'create'])
    ->middleware('auth');
// Store listing data
Route::post('/listing', [ListingController::class, 'store'])
    ->middleware('auth');
// Show edit form
Route::get('/listing/{listing}/edit', [ListingController::class, 'edit'])
    ->middleware('auth');
// Update listing
Route::put('/listing/{listing}', [ListingController::class, 'update'])
    ->middleware('auth');
// Delete listing
Route::delete('/listing/{listing}', [ListingController::class, 'destroy'])
    ->middleware('auth');
// Manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])
    ->middleware('auth');

// Single listing
Route::get('/listing/{listing}', [ListingController::class, 'show']);


// Show register/create form
Route::get('/register', [UserController::class, 'register'])
    ->middleware('guest');
// Submit register
Route::post('/user', [UserController::class, 'store']);
// Log out user
Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth');
// Show login form
Route::get('/login', [UserController::class, 'login'])
    ->name('login')
    ->middleware('guest');
// Log in user
Route::post('/user/authenticate', [UserController::class, 'authenticate']);




