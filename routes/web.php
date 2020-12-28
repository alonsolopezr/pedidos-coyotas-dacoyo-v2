<?php

use LaravelQRCode\Facades\QRCode;
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
Route::get('pedidos_confirmacion_cliente', function ()
{
    return view('pedidos.confirmacion_cliente');
})->middleware(['auth:sanctum'])->name('pedidos.confirmacion_cliente');


//////////////////////////////////////////////////////////////////////
///////////PRUEBAS DE QR CODE!!!!!///////////////////////////////
//TODO: quitar todos los ejemplos/////////////////////////////////////

Route::get('qr-code/examples/phone', function ()
{
    return '<img src="' . QRCode::phone('+55 31 1234-5678')
        ->setSize(4)
        ->setMargin(2)
        ->png() . '" >';
});

Route::get('qr-code', function ()
{
    QRCode::text('Pedido#0123# Para:Alonso Lopez Romo. Pasará el: 03/01/2021 a las 14:05 en la Sucursal: Villa de Seris.')->setOutFile(public_path('storage/images/qrpedidos/qr_pedido.png'))->svg();
    QRCode::text('Pedido#0123# Para:Alonso Lopez Romo. Pasará el: 03/01/2021 a las 14:05 en la Sucursal: Villa de Seris.')->setOutFile(public_path('storage/images/qrpedidos/qr_pedido.png'))->svg();
    return QRCode::text('Pedido#0123# Para:Alonso Lopez Romo. Pasará el: 03/01/2021 a las 14:05 en la Sucursal: Villa de Seris.')->setSize(4)
        ->setMargin(2)
        ->svg();
});
Route::get('qr-code-vcard', function ()
{ // Personal Information
    $firstName = 'John';
    $lastName = 'Doe';
    $title = 'Mr.';
    $email = 'john.doe@example.com';

    // Addresses
    $homeAddress = [
        'type' => 'home',
        'pref' => true,
        'street' => '123 my street st',
        'city' => 'My Beautiful Town',
        'state' => 'LV',
        'country' => 'Neverland',
        'zip' => '12345-678',
    ];
    $wordAddress = [
        'type' => 'work',
        'pref' => false,
        'street' => '123 my work street st',
        'city' => 'My Dreadful Town',
        'state' => 'LV',
        'country' => 'Hell',
        'zip' => '12345-678',
    ];

    $addresses = [$homeAddress, $wordAddress];

    // Phones
    $workPhone = [
        'type' => 'work',
        'number' => '001 555-1234',
        'cellPhone' => false,
    ];
    $homePhone = [
        'type' => 'home',
        'number' => '001 555-4321',
        'cellPhone' => false,
    ];
    $cellPhone = [
        'type' => 'work',
        'number' => '001 9999-8888',
        'cellPhone' => true,
    ];

    $phones = [$workPhone, $homePhone, $cellPhone];

    return QRCode::vCard($firstName, $lastName, $title, $email, $addresses, $phones)
        ->setErrorCorrectionLevel('H')
        ->setSize(4)
        ->setMargin(2)
        ->svg();
});

Route::get('qr-code-calendar', function ()
{
    // Required params
    $start = new \DateTime('05/01/2001 7pm');
    $end = new \DateTime('05/01/2021 11pm');
    $summary = 'Interview with Neil DeGrasse Tyson';

    // Optional params
    $description = 'Meet Mr. Tyson at Per Se and interview him about the asteroid Apophis';
    $location = 'Time Warner Center, 10 Columbus Cir, New York, NY 10023, USA';

    return QRCode::calendar($start, $end, $summary, $description, $location)->setErrorCorrectionLevel('H')
        ->setSize(4)
        ->setMargin(2)
        ->svg();
});
