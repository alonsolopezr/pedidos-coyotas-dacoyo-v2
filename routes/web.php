<?php

use LaravelQRCode\Facades\QRCode;
use Illuminate\Support\Facades\Auth;
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
Route::get('mispedidos', ['App\Http\Controllers\PedidoController', 'index_cliente'])->middleware(['auth:sanctum'])->name('pedidos_cliente.index');

Route::get('pedidos_confirmacion_cliente', function ()
{
    return view('pedidos.confirmacion_cliente');
})->middleware(['auth:sanctum'])->name('pedidos.confirmacion_cliente');

Route::get('admin_index_pedidos', [PedidoController::class, 'indexPedidosPendientes'])->middleware(['auth:sanctum'])->name('pedidos.admin-index-pendientes');

Route::get('admin_confirmar_pedidos', [PedidoController::class, 'confirmarPedidosDeClientes'])->middleware(['auth:sanctum'])->name('pedidos.admin-confirmar-pedidos');

Route::put('admin_confirmar_pedido', [PedidoController::class, 'confirmaPedidoUpdate'])->middleware(['auth:sanctum'])->name('pedidos.admin-confirma-pedido-update');

Route::put('admin_cancela_pedidos', [PedidoController::class, 'cancelaPedidoUpdate'])->middleware(['auth:sanctum'])->name('pedidos.admin-cancela-pedido-update');

Route::get('admin_entrega_por_qr', [PedidoController::class, 'entregaPorQR'])->middleware(['auth:sanctum'])->name('pedidos.entrega-por-qr');

//////////////////////////////////////////////////////////////////////
///////////PRUEBAS DE QR CODE!!!!!///////////////////////////////

Route::view('read_QRCode', 'pedidos.leer-qr-pedido');
Route::view('WIP_read_QRCode', 'pedidos.leer_qr_pedido_wip');