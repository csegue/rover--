<?php

use App\Http\Controllers\ProyectoController;
use Illuminate\Support\Facades\Route;



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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/proyecto', [ProyectoController::class, 'proyecto']);
Route::get('/proyecto/aviso/{param}', [ProyectoController::class, 'aviso'])->name('proyecto.aviso');