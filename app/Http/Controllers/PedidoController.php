<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancelacionAdminDePedidoEmail;
use App\Mail\ConfirmacionAdminDePedidoEmail;
use App\Mail\ConfirmacionPedidoClienteEmail;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //muestra todos los pedidos
        $pedidos = Pedido::all();
        //dd($pedidos);
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Admin confirma los pedidos registrados de clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPedidosPendientes()
    {

        //muestra todos los pedidos
        $pedidos = Pedido::all();
        //dd($pedidos);
        if (Auth::user()->is_admin)
            return view('pedidos.admin-index-pedidos', compact('pedidos'));
        else
            return view('dashboard');
    }
    /**
     * Admin confirma los pedidos registrados de clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmarPedidosDeClientes()
    {

        //muestra todos los pedidos
        $pedidos = Pedido::all();
        //dd($pedidos);
        if (Auth::user()->is_admin)
            return view('pedidos.admin-confirmar-pedido', compact('pedidos'));
        else
            return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //nuevo pedido por cliente

        $productos = Producto::all();
        return view('pedidos.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //almacena pedido

        //validar pedido
        $validated = $this->validate($request, [
            "campo" => 'required'

        ]);
        //almacenar pedido
        $pedido = Pedido::create($validated);
        //almacenar productos de pedido
        foreach ($request->productos as $key => $value)
        {
            # code...

        }

        //redirect
        return redirect()->route('pedidos.confirmacion', compact('pedido'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmaPedidoUpdate(Request $request)
    {
        //modif pedido status a confirmado
        $pedido = Pedido::find($request->confirma);
        //almacenar productos de pedido
        $pedido->status = 'CONFIRMADO';
        $pedido->save();

        //notifica al cliente
        Mail::to($pedido->cliente->email)->send(new ConfirmacionAdminDePedidoEmail());
        //consulta todos de nuevo
        $pedidos = Pedido::all();
        //redirect a index
        return redirect()->route('pedidos.admin-index-pendientes', compact('pedidos'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancelaPedidoUpdate(Request $request)
    {
        //modif pedido status a confirmado
        $pedido = Pedido::find($request->confirma);
        //almacenar productos de pedido
        $pedido->status = 'CANCELADO';
        $pedido->save();

        //notifica al cliente
        Mail::to($pedido->cliente->email)->send(new CancelacionAdminDePedidoEmail());
        //consulta todos de nuevo
        $pedidos = Pedido::all();
        //redirect a index
        return redirect()->route('pedidos.admin-index-pendientes', compact('pedidos'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function entregaPorQR(Request $request)
    {
        //almacena pedido

        dd($request);
        //almacenar pedido
        // $pedido = Pedido::create($validated);
        //almacenar productos de pedido
        foreach ($request->productos as $key => $value)
        {
            # code...

        }

        //redirect
        return redirect()->route('pedidos.confirmacion', compact('pedido'));
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //muestra detalle de pedido
        return view('pedidos.show', $pedido);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //modifica pedido?? se necesita??
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //almacena modif
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //borra pedido... necesario????
    }
}