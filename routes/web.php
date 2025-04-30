<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login/admin', [AuthController::class, 'showLogin'])->name('admin.login');
Route::get('/login/funcionario', [AuthController::class, 'showLogin'])->name('funcionario.login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function (){
    Route::get('/painel', [AuthController::class,'painel'])->name('painel');
    Route::get('/painel/funcionario', [AuthController::class,'funcionario'])->name('funcionario');
    Route::get('/inventario', [AuthController::class,''])->name('inventario');
    Route::get('/profile', [AuthController::class,''])->name('profile');
});

