<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\DashboardController;

// Rotas de Login
Route::get('/login/administrator', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('admin.login.post');

Route::get('/login/funcionarios', [AuthController::class, 'showLogin'])->name('funcionario.login');
Route::post('/login/funcionario', [AuthController::class, 'funcionarioLogin'])->name('funcionario.login.post');

// Rotas Protegidas (com Middleware 'auth')
Route::middleware(['auth', 'admin'])->group(function () {
    // Painel Principal
    Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::post('/logout/admin', [AuthController::class, 'logout'])->name('logout');

    // Rotas para Produtos
    Route::get('/produto/admin', [ProductController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/admin', [ProductController::class, 'getProducts'])->name('produtos.get');
    Route::post('/produtos/admin/add', [ProductController::class, 'store'])->name('produtos.store');
    Route::post('/produtos/admin/edit/{product}', [ProductController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/admin/{product}', [ProductController::class, 'destroy'])->name('produtos.destroy');

    // Rotas para Fornecedores
    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('fornecedores.index');
    Route::get('/fornecedores', [FornecedorController::class, 'getFornecedores'])->name('fornecedores.get');
    Route::post('/fornecedores/add', [FornecedorController::class, 'store'])->name('fornecedores.store');
    Route::post('/fornecedores/edit/{fornecedor}', [FornecedorController::class, 'update'])->name('fornecedores.update');
    Route::delete('/fornecedores/{fornecedor}', [FornecedorController::class, 'destroy'])->name('fornecedores.destroy');

    // Rotas para Vendas
    Route::get('/venda/admin', [VendaController::class, 'index'])->name('vendas.index');
    Route::post('/vendas/admin', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/vendas/admin/get', [VendaController::class, 'getVendas'])->name('vendas.get');
});

Route::middleware(['auth', 'funcionario'])->group(function() {
    // Painel Principal
    Route::get('/dashboard/funcionario', [DashboardController::class, 'index'])->name('dashboard');
    // Logout
    Route::post('/logout/funcionario', [AuthController::class, 'logout'])->name('logout');

    // Rotas para Produtos
    Route::get('/produto/funcionario', [ProductController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/funcionario', [ProductController::class, 'getProducts'])->name('produtos.get');
    Route::post('/produtos/funcionario/add', [ProductController::class, 'store'])->name('produtos.store');
    Route::post('/produtos/funcionario/edit/{product}', [ProductController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/funcionario/{product}', [ProductController::class, 'destroy'])->name('produtos.destroy');

    // Rotas para Vendas
    Route::get('/venda/funcionario', [VendaController::class, 'index'])->name('vendas.index');
    Route::post('/vendas/funcionario', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/vendas/funcionario/get', [VendaController::class, 'getVendas'])->name('vendas.get');
});

