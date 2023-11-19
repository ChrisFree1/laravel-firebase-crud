<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PanaderiaAPIController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/registrar-pan', [PanaderiaAPIController::class, 'registrarPan']); 

Route::get('/listar-pan', [PanaderiaAPIController::class, 'listarPanes']); 

Route::put('/actualizar-pan/{clave}', [PanaderiaAPIController::class, 'actualizarPanes']); 


Route::delete('/eliminar-pan/{clave}', [PanaderiaAPIController::class , 'eliminarPanes']);


