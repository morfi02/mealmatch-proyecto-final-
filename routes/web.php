<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeccionEspecialController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\OrderController;




Route::get('/', function (): string {
    return view('welcome'); 
})->name('home');
Route::get('', function (): string {
    return view('welcome'); 
})->name('home');

Route::get('home', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->rol === 'cliente') {
            return redirect()->route('cliente.dashboard');
        } elseif ($user->rol === 'cocinero') {
            return redirect()->route('cocinero.dashboard');
        }
    }
    return view('welcome'); 
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cliente/dashboard', [UsuariosController::class, 'clienteDashboard'])->name('cliente.dashboard');
    Route::get('/cliente/cocinero/{id}', [UsuariosController::class, 'showCocinero'])->name('cliente.cocinero.show');
    Route::get('/cocineros/{id}', [UsuariosController::class, 'show'])->name('cocineros.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cocinero/dashboard', [UsuariosController::class, 'cocineroDashboard'])->name('cocinero.dashboard');
    Route::resource('dishes', DishController::class);
    Route::post('/rate-chef', [RatingController::class, 'store'])->name('rate.chef');
    Route::get('/buscar-cocineros', [UsuariosController::class, 'buscarCocineros'])->name('buscar.cocineros');

});



require __DIR__.'/auth.php';
