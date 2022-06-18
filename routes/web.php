<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\UserController;
use App\Models\Curso;
use App\Models\Plantilla;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        //return view('dashboard');
        return redirect()->route('users.index');
    })->name('dashboard');

    Route::resource('users', UserController::class)->names('users');
    Route::get('user/{user}/suspender',[UserController::class,'suspender'])->name('user.suspender');

    Route::resource('periodos', PeriodoController::class)->names('periodos');
    Route::resource('plantillas', PlantillaController::class)->names('plantillas');
    //Cursos
    Route::resource('cursos', CursoController::class)->names('cursos');
    Route::get('curso/{plantilla}/crearcurso',[CursoController::class,'crearcurso'])->name('curso.crearcurso');
    Route::post('curso/{plantilla}/store2',[CursoController::class,'store2'])->name('curso.store2');
    Route::delete('curso/{curso}/{plantilla}/destroy2',[CursoController::class,'destroy2'])->name('curso.destroy2');
    //Grados
    Route::resource('grados', GradoController::class)->names('grados');
    //areas
    Route::resource('areas', AreaController::class)->names('areas');
    Route::get('area/{grado}/{user}/consultar',[AreaController::class,'consultar'])->name('area.consultar');
    Route::get('area/{area}/reiniciar',[AreaController::class,'reiniciar'])->name('area.reiniciar');
    Route::get('area/{area}/{user}/consultarnota',[AreaController::class,'consultarnota'])->name('area.consultarnota');
    Route::get('area/{area}/{user}/consultarnotapdf',[AreaController::class,'consultarnotapdf'])->name('area.consultarnotapdf');
    //grado
    Route::get('grado/{periodo}/creargrado',[GradoController::class,'creargrado'])->name('grado.creargrado');
    Route::post('grado/{plantilla}/store2',[GradoController::class,'store2'])->name('grado.store2');
    Route::delete('grado/{curso}/{plantilla}/destroy2',[GradoController::class,'destroy2'])->name('grado.destroy2');
    Route::get('grado/{grado}/consultar',[GradoController::class,'consultar'])->name('grado.consultar');
    Route::post('grado/{grado}/matricular',[GradoController::class,'matricular'])->name('grado.matricular');
    Route::get('grado/{grado}/{user}/desmatricular',[GradoController::class,'desmatricular'])->name('grado.desmatricular');

});
