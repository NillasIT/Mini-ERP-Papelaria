<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\DashboardController;

// Rotas de Login

Route::get('/', function () {
    return redirect('/login/administrator');
});

Route::get('/login/administrator', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('admin.login.post');

Route::get('/login/funcionarios', [AuthController::class, 'showLogin'])->name('funcionario.login');
Route::post('/login/funcionario', [AuthController::class, 'funcionarioLogin'])->name('funcionario.login.post');

// Rotas Protegidas para Administradores

Route::middleware(['auth'])->group(function() {
    // Painel Principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas para Produtos
    Route::get('/produto', [ProductController::class, 'index'])->name('produtos.index');
    Route::get('/produtos', [ProductController::class, 'getProducts'])->name('produtos.get');
    Route::post('/produtos/add', [ProductController::class, 'store'])->name('produtos.store');
    Route::post('/produtos/edit/{product}', [ProductController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{product}', [ProductController::class, 'destroy'])->name('produtos.destroy');

    // Rotas para Vendas
    Route::get('/venda', [VendaController::class, 'index'])->name('vendas.index');
    Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/vendas/get', [VendaController::class, 'getVendas'])->name('vendas.get');

    // Perfil
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Rotas para Funcionários
    Route::get('/funcionario', [AuthController::class, 'funcionario'])->name('funcionario');
    Route::get('/funcionarios', [AuthController::class, 'getFuncionarios'])->name('getFuncionarios');
    Route::get('/funcionario/add', [AuthController::class, 'showFuncionario'])->name('show.register');
    Route::post('/funcionario/add/add', [AuthController::class, 'addFuncionario'])->name('funcionario.register');
    Route::delete('/funcionario/{id}', [AuthController::class, 'deleteFuncionario'])->name('delete.funcionario');
    Route::get('/funcionario/edit/{id}', [AuthController::class, 'editFuncionario'])->name('funcionario.edit');
    Route::put('/funcionario/{id}', [AuthController::class, 'updateFuncionario'])->name('update.funcionario');

    // Rotas para Fornecedores
    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('fornecedores.index');
    Route::get('/fornecedores', [FornecedorController::class, 'getFornecedores'])->name('fornecedores.get');
    Route::post('/fornecedores/add', [FornecedorController::class, 'store'])->name('fornecedores.store');
    Route::post('/fornecedores/edit/{fornecedor}', [FornecedorController::class, 'update'])->name('fornecedores.update');
    Route::delete('/fornecedores/{fornecedor}', [FornecedorController::class, 'destroy'])->name('fornecedores.destroy');   
});
