<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LeituraController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('base.dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('usuario', UsuarioController::class);
    Route::resource('produto', ProdutoController::class);
    Route::resource('fornecedor', FornecedorController::class);
    Route::resource('leitura', LeituraController::class);

    Route::post('usuario/search', [UsuarioController::class, 'search'])->name(
            'usuario.search'
    );

    Route::post('produto/search', [ProdutoController::class, 'search'])->name(
        'produto.search'
    );
    Route::post('fornecedor/search', [FornecedorController::class, 'search'])->name(
        'fornecedor.search'
    );
    Route::post('leitura/search', [LeituraController::class, 'search'])->name(
        'leitura.search'
    );

    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );
});

require __DIR__ . '/auth.php';
