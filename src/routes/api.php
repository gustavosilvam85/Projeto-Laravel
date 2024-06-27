<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploradorController;
use App\Http\Controllers\ItensController;
use App\Models\Explorador;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/exploradores', [ExploradorController::class,'index']);
Route::post('/explorador',[ExploradorController::class,'create']);
Route::put('/explorador/{id}',[ExploradorController::class,'update']);
Route::delete('/explorador/{id}',[ExploradorController::class,'delete']);

Route::get('/exploradores/{id}', [ExploradorController::class, 'showInventario']); 

Route::post('/exploradores/{id}/inventario',[ItensController::class,'create']);

Route::put('/inventario/{id}',[ItensController::class,'update']);