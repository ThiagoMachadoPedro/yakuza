<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Rota para exibir o formulário de login
Route::get('/login', [LoginController::class, 'index'])->name('login-index');

// Rota para processar o formulário de login
Route::post('/login', [LoginController::class, 'store'])->name('login-store');

// Rota para fazer logout
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// Rota para exibir o formulário de cadastro de usuário
Route::get('/user-created', [UserController::class, 'create'])->name('user-created');

// Rota para processar o cadastro de usuário
Route::post('/user-store', [UserController::class, 'store'])->name('user-store');


// Rotas que exigem autenticação
Route::middleware(['auth', 'verified'])->group(function () {
          // Outras rotas protegidas...

          // users
          Route::get('/user-index', [UserController::class, 'index'])->name('user-index');
          Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('user-edit');
          Route::put('/user-update/{id}', [UserController::class, 'update'])->name('user-update');
          Route::delete('/user-delete/{id}', [UserController::class, 'destroy'])->name('user-delete');
          Route::get('/user-view/{id}', [UserController::class, 'show'])->name('user-show');


          // dashboard
          Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


          // post
          Route::get('/post-index', [PostController::class, 'index'])->name('post-index');
          Route::get('/post-created', [PostController::class, 'create'])->name('post-created');
          Route::post('/post-store', [PostController::class, 'store'])->name('post-store');
          Route::get('/post-edit/{id}', [PostController::class, 'edit'])->name('post-edit');
          Route::put('/post-update/{id}', [PostController::class, 'update'])->name('post-update');
          Route::delete('/post-delete/{id}', [PostController::class, 'destroy'])->name('post-delete');
          Route::get('/post-view/{id}', [PostController::class, 'show'])->name('post-show');
});
