<?php

use App\Http\Controllers\CrearCuentoController;
use App\Http\Controllers\ListaEscenariosController;
use App\Http\Controllers\ListaPersonajesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaginaController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::resource('paginas', PaginaController::class)->middleware('auth');
Route::get('crear_cuento',[CrearCuentoController::class,'crearCuento'])->name('crear_cuento');

/*  lista de personajes */
Route::get('lista_personajes',[ListaPersonajesController::class,'listaPersonajes'])->name('lista_personajes');

Route::delete('eliminar_personaje{id}',[ListaPersonajesController::class,'delete'])->name('eliminar_personaje');

Route::delete('editar_personaje{id}',[ListaPersonajesController::class,'update'])->name('editar_personaje');



/*  lista de escenarios */
Route::get('lista_escenarios',[ListaEscenariosController::class,'listaEscenarios'])->name('lista_personajes');

Route::delete('eliminar_escenario{id}',[ListaEscenariosController::class,'delete'])->name('eliminar_escenario');

Route::delete('editar_personaje{id}',[ListaEscenariosController::class,'update'])->name('editar_escenario');



