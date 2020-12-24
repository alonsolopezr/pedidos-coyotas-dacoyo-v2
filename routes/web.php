<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

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

Route::get('/', function ()
{
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function ()
{
    return view('dashboard');
})->name('dashboard');

//route for redirects multiauth procesing
Route::get('redirects', ['App\Http\Controllers\HomeController', 'index']);

Route::resource('pedidos', 'App\Http\Controllers\PedidoController')->middleware(['auth:sanctum']);