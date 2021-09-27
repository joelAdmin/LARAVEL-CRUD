<?php

use Illuminate\Support\Facades\Route;
use App\Role;
use App\Area;
use App\Empleado;

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
    $areas = Area::all()->pluck('nombre', 'id');
    $roles = Role::all()->pluck('nombre', 'id');
    return view('welcome', ['areas'=>$areas, 'roles'=>$roles]);
});

Route::post('/new', 'EmpleadoController@store');

Route::get('/viewTableEmpleado', 'EmpleadoController@viewTableEmpleado');

Route::get('/getDatos', 'EmpleadoController@getDatos');

Route::get('/destroy/{id}', 'EmpleadoController@destroy');

Route::get('/edit/{id}', 'EmpleadoController@edit');
Route::get('/newModal', 'EmpleadoController@newModal');
Route::put('/update', ['as' => 'empleado.update', 'uses' => 'EmpleadoController@update']);
