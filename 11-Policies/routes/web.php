<?php

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

Route::get('/dashboard', function () {
    return view('templates.middleware')->with('titulo', "");
 })->middleware(['auth'])->name('dashboard');
  
Route::resource('/cursos', '\App\Http\Controllers\CursoController')
    ->middleware(['auth']);

Route::resource('/eixos', '\App\Http\Controllers\EixoController')
    ->middleware(['auth']);

Route::resource('/professores', '\App\Http\Controllers\ProfessoresController')
    ->middleware(['auth']);

Route::resource('/alunos', '\App\Http\Controllers\AlunoController')
    ->middleware(['auth']);

Route::resource('/disciplinas', '\App\Http\Controllers\DisciplinasController')
    ->middleware(['auth']);

Route::resource('/matriculas', '\App\Http\Controllers\MatriculaController')
    ->middleware(['auth']);

Route::get('/testfacade', function () {
    return UserPermissions::test();
}); 

require __DIR__.'/auth.php';
