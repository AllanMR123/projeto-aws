<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    ProductController,
    HomeController,
    CartController,
    MontePcController,
    OrderController
};

// --- Público ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');

// --- Autenticação ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// --- Carrinho (Operações de Sessão) ---
Route::post('/carrinho/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrinho/add-bulk', [CartController::class, 'addBulk'])->name('cart.addBulk');
Route::patch('/carrinho/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrinho/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/carrinho/limpar', [CartController::class, 'clear'])->name('cart.clear');

// --- ÁREAS PROTEGIDAS (Requer Login) ---
Route::middleware('auth')->group(function () {

    // Visualização do Carrinho e Montador
    Route::get('/carrinho', [CartController::class, 'index'])->name('carrinho');
    Route::get('/monte-seu-pc', [MontePcController::class, 'index'])->name('montepc');

    // Perfil e Histórico Real
    Route::get('/perfil', [OrderController::class, 'perfil'])->name('perfil');

    // Fluxo de Finalização (Checkout)
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/finalizar', [OrderController::class, 'store'])->name('order.store');
    Route::get('/pedido-sucesso/{id}', [OrderController::class, 'success'])->name('sucesso');
});
