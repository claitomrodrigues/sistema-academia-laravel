<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\TreinoController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\AuthController;

// inicial
Route::get('/', function () {
    return redirect()->route('login');
});

// login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// register
//Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
//Route::post('/register', [AuthController::class, 'register']);

// home
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

// instrutor
Route::middleware(['auth', 'role:instrutor'])->group(function () {
    Route::resource('alunos', AlunoController::class);
    Route::resource('planos', PlanoController::class);
    Route::resource('exercicios', ExercicioController::class);
    Route::resource('treinos', TreinoController::class);

    Route::get('/financeiro', [FinanceiroController::class, 'index'])->name('financeiro.index');
    Route::post('/financeiro/pagar/{id}', [FinanceiroController::class, 'pagar'])->name('financeiro.pagar');
    Route::post('/financeiro/transacao', [FinanceiroController::class, 'gerarTransacao'])->name('financeiro.transacao');
});

//aluno
Route::middleware(['auth', 'role:aluno'])->group(function () {
    Route::get('/meu-treino/{id}', [TreinoController::class, 'show'])->name('meu.treino');
    Route::get('/minhas-faturas', [FinanceiroController::class, 'faturas'])->name('minhas.faturas');
});

//pdf treino
Route::get('/treinos/{id}/pdf', [TreinoController::class, 'pdf'])
    ->middleware(['auth'])
    ->name('treinos.pdf');