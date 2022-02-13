<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MPeliculaController;
use Illuminate\Routing\RouteGroup;

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
    return view('auth.login');
});


/*Route::get('/pelicula', function () {
    return view('pelicula.index');
});

route::get('pelicula/create',[MPeliculaController::class,'create']);*/

route::resource('pelicula',MPeliculaController::class)->middleware('auth');

Auth::routes(['register'=>false, 'reset'=>false]);


Route::get('/home', [MPeliculaController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function() {

    Route::get('/', [MPeliculaController::class, 'index'])->name('home');
});
