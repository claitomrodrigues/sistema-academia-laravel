<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\TreinoController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\CobrancaController;
use App\Http\Controllers\AsaasWebhookController;

//login

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

//home

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

});

//instrutor

Route::middleware(['auth', 'role:instrutor'])->group(function () {

    Route::resource('alunos', AlunoController::class);

    Route::resource('planos', PlanoController::class);

    Route::resource('exercicios', ExercicioController::class);

    Route::resource('treinos', TreinoController::class);

    Route::get('/financeiro', [FinanceiroController::class, 'index'])
        ->name('financeiro.index');

    Route::post('/financeiro/pagar/{id}', [FinanceiroController::class, 'pagar'])
        ->name('financeiro.pagar');

    Route::get('/financeiro/filtro', [FinanceiroController::class, 'filtro'])
        ->name('financeiro.filtro');

    //cobranças

    Route::get('/cobrancas/create', [CobrancaController::class, 'create'])
        ->name('cobrancas.create');

    Route::post('/cobrancas', [CobrancaController::class, 'store'])
        ->name('cobrancas.store');

    Route::post('/financeiro/gerar-transacao', [FinanceiroController::class, 'gerarTransacao'])
    ->name('financeiro.transacao');

       

});

//aluno

Route::middleware(['auth', 'role:aluno'])->group(function () {

    Route::get('/meu-treino/{id}', [TreinoController::class, 'show'])
        ->name('meu.treino');

    Route::get('/minhas-faturas', [FinanceiroController::class, 'faturas'])
        ->name('minhas.faturas');

});

//pdf treino

Route::middleware('auth')->group(function () {

    Route::get('/treinos/{id}/pdf', [TreinoController::class, 'pdf'])
        ->name('treinos.pdf');

});

//Webhook Asaas

Route::post('/asaas/webhook', [AsaasWebhookController::class, 'handle']);
