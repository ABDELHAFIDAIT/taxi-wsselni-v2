<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisponibilityController;
use App\Models\DriverDisponibility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SocialiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Home Page
Route::get('/', function () { return view('index');})->name('homepage');



// Services Page
Route::get('/services', function () {
    return view('pages.services');
})->name('services');



Route::get('/chauffeurs', [UserController::class,'drivers'])->name('chauffeurs');



// Chauffeur Details Page
Route::get('/chauffeur/{id}', function () {
    return view('pages.chaffeur');
})->name('details');



// Login & Register
Route::middleware(['guest'])->group(function(){
    Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');
    Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');

    Route::post('/login',[AuthController::class, 'login'])->name('connect');
    Route::post('/register',[AuthController::class, 'register'])->name('register');
});



// Logout
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');



// Profile
Route::middleware(['auth'])->group(function(){
    Route::get('/passenger/profile',function(){ return view('passenger.profile'); })->name('passenger.profile');
    Route::get('/driver/profile',function(){ return view('driver.profile'); })->name('driver.profile');
    Route::get('/driver/dashboard',function(){ return view('driver.dashboard'); })->name('driver.dashboard');
    Route::get('/driver/trajets',[ReservationController::class, 'trajets'])->name('driver.trajets');
    Route::get('/driver/reservations',[ReservationController::class, 'index'])->name('driver.reservations');
    Route::get('/driver/disponibility',function(){ return view('driver.disponibility'); })->name('driver.disponibility');
    Route::post('/reservation/create', [ReservationController::class, 'store'])->name('reservation.create');
    Route::post('/disponibility/create', [DisponibilityController::class, 'store'])->name('disponibility.create');
    Route::get('/reservation/{id}/accept', [ReservationController::class, 'accept'])->name('reservation.accept');
    Route::get('/reservation/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');
    Route::get('/driver/disponibility', [DisponibilityController::class, 'show'])->name('driver.disponibility');
    
    Route::get('/disponibilites', function () {

        $driver_id = Auth::user()->id;

        $disponibilites = DriverDisponibility::where('id_driver', $driver_id)
            ->with('disponibility')
            ->get();

        $events = $disponibilites->map(function ($driverDisponibility) {
            $dispo = $driverDisponibility->disponibility;
            return [
                'title' => 'Disponible',
                'start' => Carbon::parse($dispo->debut_disponibility)->toISOString(),
                'end' => Carbon::parse($dispo->fin_disponibility)->toISOString(),
                'backgroundColor' => '#28a745',
                'borderColor' => '#28a745',
                'textColor' => '#fff'
            ];
        });

        return response()->json($events);
    });

    Route::get('/calender', function () {
        return view('driver.calender');
    });
});



// Socialite
Route::controller(SocialiteController::class)->group(function(){
    Route::get('auth/google','googleLogin')->name('auth.google');
    Route::get('auth/google-callback','googleAuthentication')->name('auth.google-callback');
    Route::get('auth/confirm', 'showConfirm')->name('auth.confirm');
    Route::post('auth/confirm', 'confirm')->name('auth.confirm');
});



