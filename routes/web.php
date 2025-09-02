<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ==========================
// Home - Página inicial
// ==========================
Route::get('/', function () {
    return view('home');
})->name('home');

// ==========================
// Rotas de autenticação
// ==========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================
// Registro de usuário
// ==========================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ==========================
// Páginas futuras (protegidas por autenticação)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/monte-seu-pc', function () {
        return 'Aqui será a página de montar PC!';
    });

    Route::get('/produtos', function () {
        return 'Aqui será a página de produtos!';
    });

    Route::get('/carrinho', function () {
        return 'Aqui será a página do carrinho!';
    });
});
