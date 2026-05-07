<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\TreinoController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AsaasWebhookController;
use App\Http\Controllers\CobrancaController;

// inicial
Route::get('/', function () {
    return redirect()->route('login');
});

// login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
    Route::get('/financeiro/cobrancas/create', [CobrancaController::class, 'create'])
    ->name('cobrancas.create');

Route::post('/financeiro/cobrancas', [CobrancaController::class, 'store'])
    ->name('cobrancas.store');

    // financeiro
    Route::get('/financeiro', [FinanceiroController::class, 'index'])
        ->name('financeiro.index');

    Route::post('/financeiro/pagar/{id}', [FinanceiroController::class, 'pagar'])
        ->name('financeiro.pagar');

    Route::post('/financeiro/transacao', [FinanceiroController::class, 'gerarTransacao'])
        ->name('financeiro.transacao');

    // cobranças
    Route::get('/cobrancas/create', [FinanceiroController::class, 'createCobranca'])
        ->name('cobrancas.create');

    Route::post('/cobrancas', [FinanceiroController::class, 'storeCobranca'])
        ->name('cobrancas.store');
});

// aluno
Route::middleware(['auth', 'role:aluno'])->group(function () {
    Route::get('/meu-treino/{id}', [TreinoController::class, 'show'])
        ->name('meu.treino');

    Route::get('/minhas-faturas', [FinanceiroController::class, 'faturas'])
        ->name('minhas.faturas');
});

// pdf treino
Route::get('/treinos/{id}/pdf', [TreinoController::class, 'pdf'])
    ->middleware('auth')
    ->name('treinos.pdf');

// rota Asaas webhook
Route::post('/asaas/webhook', [AsaasWebhookController::class, 'handle'])
    ->name('asaas.webhook');
