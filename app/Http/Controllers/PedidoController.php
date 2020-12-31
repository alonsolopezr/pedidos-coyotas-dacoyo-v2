<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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