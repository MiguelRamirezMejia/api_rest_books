<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/books', [BookController::class,'index']); //muestra todos los registros
Route::post('/books', [BookController::class,'store']); // crea un registro
Route::put('/books/{id}', [BookController::class,'update']); // actualiza un registro
Route::delete('/books/{id}', [BookController::class,'destroy']); //elimina un registro
