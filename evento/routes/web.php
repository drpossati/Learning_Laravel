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

// Rota para a página de criar eventos permitida somente aos usuários logados
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');

// Rota que recebe um parâmetro de ID
Route::get('/events/{id}', [EventController::class, 'show']);

Route::get('/contact', function () {

    return view('contact');
});

// Rota responsável por direcionar os dados do formulário para o controller via POST
Route::post('/events', [EventController::class, 'store']);

// Rota dashboard que direciona para uma action dashboard no Controller e exige autenticação do usuário 
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

// Rota para deletar um registro no banco de dados
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');

// Rota para buscar os dados de preencher o formulário de edição
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');

// Rota para atualizar os dados do evento
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');

// Criar a relação do usuário participante com o ID do evento
Route::post('/event/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');

// Remover a relação do usuário participante com o ID do evento
Route::delete('/event/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');

// Rota automática criada na instalação do jetstream
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });