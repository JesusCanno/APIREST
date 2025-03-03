<?php

use App\Http\Controllers\ControladorObjeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

//vamos a poner las rutas de lo que queremos hacer con sus funciones etc

Route::get('/objeto', [ControladorObjeto::class, 'index']);

Route::get('/objeto/{id}', [ControladorObjeto::class,'show']);

Route::post('/objeto',[ControladorObjeto::class,'store']);

Route::put('/objeto/{id}', [ ControladorObjeto::class,'update']); //actualizar todo un objeto para actualizar parcialmente usaremos patch

Route::patch('/objeto/{id}', [ ControladorObjeto::class,'updatePartial']);

Route::delete('/objeto/{id}', [ ControladorObjeto::class,'destroy']);