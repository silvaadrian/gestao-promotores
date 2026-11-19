<?php

use App\Http\Controllers\AcessoController;
use App\Http\Controllers\PromotorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\RelatorioPromotorController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/entrar', [AcessoController::class, 'mostrarLogin'])
        ->name('login');

    Route::post('/entrar', [AcessoController::class, 'autenticar'])
        ->middleware('throttle:5,1')
        ->name('login.autenticar');

    Route::get('/cadastro', [AcessoController::class, 'mostrarCadastro'])
        ->name('cadastro');

    Route::post('/cadastro', [AcessoController::class, 'cadastrar'])
        ->name('cadastro.salvar');
});

Route::middleware('auth')->group(function () {
    Route::post('/sair', [AcessoController::class, 'sair'])
        ->name('logout');

    Route::get('/', [PainelController::class, 'index'])->name('painel');

    Route::get('/relatorios/promotores', [RelatorioPromotorController::class, 'index'])
        ->name('relatorios.promotores');

    Route::get(
        '/relatorios/promotores/exportar',
        [RelatorioPromotorController::class, 'exportarCsv']
    )->name('relatorios.promotores.exportar');

    Route::resource('promotores', PromotorController::class)
        ->parameters(['promotores' => 'promotor'])
        ->only(['index', 'create', 'store', 'edit', 'update']);

    Route::resource('clientes', ClienteController::class)
        ->parameters(['clientes' => 'cliente'])
        ->only(['index', 'create', 'store', 'edit', 'update']);

    Route::resource('visitas', VisitaController::class)
        ->parameters(['visitas' => 'visita'])
        ->only(['index', 'create', 'store', 'edit', 'update']);
});
