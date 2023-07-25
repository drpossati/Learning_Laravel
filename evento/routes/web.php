<?php

use Illuminate\Support\Facades\Route;

// Controller criado
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Rota que responde as chamadas a página 'home' definido por '/' instanciando o método index no EventController
Route::get('/', [EventController::class, 'index']);

Route::get('/events/create', [EventController::class, 'create']);

// Rota que recebe um parâmetro de ID
Route::get('/events/{id}', [EventController::class, 'show']);

Route::get('/contact', function () {

    return view('contact');
});

// Rota responsável por direcionar os dados do formulário para o controller via POST
Route::post('/events', [EventController::class, 'store']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
