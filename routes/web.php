<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

// Rotas de Login
Route::get('/login/admin', [AuthController::class, 'showLogin'])->name('admin.login');
Route::get('/login/funcionario', [AuthController::class, 'showLogin'])->name('funcionario.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Rotas Protegidas (com Middleware 'auth')
Route::middleware(['auth'])->group(function () {

    // Painel Principal
    Route::get('/painel', [AuthController::class, 'painel'])->name('painel');

    // Rotas para Funcionários
    Route::get('/funcionario', [AuthController::class, 'funcionario'])->name('funcionario');
    Route::get('/funcionarios', [AuthController::class, 'getFuncionarios'])->name('getFuncionarios');
    Route::get('/funcionario/add', [AuthController::class, 'showFuncionario'])->name('show.register');
    Route::post('/funcionario/add/add', [AuthController::class, 'addFuncionario'])->name('funcionario.register');
    Route::delete('/funcionario/{id}', [AuthController::class, 'deleteFuncionario'])->name('delete.funcionario');
    Route::get('/funcionario/edit/{id}', [AuthController::class, 'editFuncionario'])->name('funcionario.edit');
    Route::put('/funcionario/{id}', [AuthController::class, 'updateFuncionario'])->name('update.funcionario');

    // Perfil
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rotas para Produtos
    Route::get('/produto', [ProductController::class, 'index'])->name('produtos.index');
    Route::get('/produtos', [ProductController::class, 'getProducts'])->name('produtos.get');
    Route::post('/produtos/add', [ProductController::class, 'store'])->name('produtos.store');
    Route::post('/produtos/edit/{product}', [ProductController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{product}', [ProductController::class, 'destroy'])->name('produtos.destroy');
});

