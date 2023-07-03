<?php

use App\Http\Controllers\CrearCuentoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaginaController;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Http\Controllers\CuentoController;
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

//Route::resource('paginas', PaginaController::class)->middleware('auth');
Route::get('paginas/{id}', [PaginaController::class,'index'])->name('paginas.index');
Route::get('pagina/{id}/create', [PaginaController::class, 'create'])->name('paginas.create');
Route::post('pagina/{id}/store', [PaginaController::class, 'store'])->name('paginas.store');
Route::get('pagina/{id}/show', [PaginaController::class, 'show'])->name('paginas.show');
Route::get('paginas/{id}/edit', [PaginaController::class, 'edit'])->name('paginas.edit');
Route::patch('/paginas/{id}/{cuento_id}/update',  [PaginaController::class, 'update'])->name('paginas.update');
Route::delete('paginas/{id}/destroy', [PaginaController::class, 'destroy'])->name('paginas.destroy');

Route::get('crear_cuento',[CrearCuentoController::class,'crearCuento'])->name('crear_cuento');



Route::resource('cuentos', CuentoController::class);

