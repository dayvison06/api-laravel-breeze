<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

// Testando JWT
Route::post('auth/login', [AuthController::class, 'login']);

//First endpoint

// API ROTAS
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete o ID informado
Route::patch('/users/{id}', [UserController::class, 'update']); // Atualiza o ID informado com os dados informados
Route::get('/users/{id}', [UserController::class, 'show']); // Buscar o usuário por ID
Route::get('/users', [UserController::class, 'index']); // Mostrar todos os usuários
ROute::post('/users', [UserController::class, 'store']); // Criar um novo usuário


Route::get('/', function(){
    return response()->json([
        'sucess' => true
    ]);
});
