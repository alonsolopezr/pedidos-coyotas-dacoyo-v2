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
        //return view('pedidos.index', compact('pedidos'));
        return response()->json($pedidos, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index_cliente()
    {
        //muestra todos los pedidos
        $pedidos = auth()->user()->pedidos; //Pedido::all();
        //dd($pedidos);
        return view('pedidos.index_cliente', compact('pedidos'));
        //return response()->json($pedidos, 200);
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
        // //almacena pedido

        // //validar pedido
        // $validated = $this->validate($request, [
        //     "campo" => 'required'

        // ]);
        // //almacenar pedido
        // $pedido = Pedido::create($validated);
        // //almacenar productos de pedido
        // foreach ($request->productos as $key => $value)
        // {
        //     # code...

        // }

        // //redirect
        // return redirect()->route('pedidos.confirmacion', compact('pedido'));

        //------------------------------------------------------------------//

        //hacer el store
        // Http::post('ruta_api_guardar');

        //validar
        $this->validate($request, [
            "fecha" => "required",
            "hora" => "required",
        ], [
            "fecha.required" => "* Debe seleccionar una fecha válida",
            "hora.required" => "* Por favor, seleccione una hora disponible, a partir de las 2pm.",
        ]);

        //se calcula el total de paquetes
        $this->calculaTotalDePaquetes();
        //calcular cuantos paquetes puede apartar y si los sobrepasa,
        //ERROR, devolver  e indicarle que no debe pasar de X paquetes...

        DB::transaction(function ()
        {
            $numDelDia = $this->numSiguientePedido($this->fecha);
            $stringQr = Carbon::create($this->fecha)->format('Ymd') . '*' . Carbon::create($this->hora)->format('Hi') . '*' . $this->sucursal . '*' . $numDelDia;
            //dd($numDelDia);
            //guardar pedido
            // dd([
            //     "folio" => $stringQr,
            //     "qr" => "000011",
            //     "status" => 1,
            //     "paga_en_tienda" => 1,
            //     "monto_total" => $this->montoTotal,
            //     "fecha" => $this->fecha,
            //     "hora" => $this->hora,
            //     "cancelado" => 0,
            //     "cliente_id" => Auth::user()->id,
            //     "sucursal" => $this->sucursal,
            //     "num_del_dia" => $numDelDia,
            //     "paquetes_de_coyotas" => $this->paquetesDeCoyotas,
            // ]);
            $pedido = Pedido::create(
                [
                    "folio" => $stringQr,
                    "qr" => "000011",
                    "status" => 1,
                    "paga_en_tienda" => 1,
                    "monto_total" => $this->montoTotal,
                    "fecha" => $this->fecha,
                    "hora" => $this->hora,
                    "cancelado" => 0,
                    "cliente_id" => Auth::user()->id,
                    "sucursal" => $this->sucursal,
                    "num_del_dia" => $numDelDia,
                    "paquetes_de_coyotas" => $this->paquetesDeCoyotas,
                ]
            );

            //guardar productos de pedido
            foreach ($this->pedido as $key => $articulo)
            {
                // dd([
                //     "pedido_id" => $pedido->id,
                //     "producto_id" => $articulo['id'],
                //     "cantidad" => $articulo['cantidad'],
                // ]);
                ProductosDePedido::create([
                    "pedido_id" => $pedido->id,
                    "producto_id" => $articulo['id'],
                    "cantidad" => $articulo['cantidad'],
                ]);
            }
            //crer qr
            $qr = QRCode::text($stringQr)->setOutFile(public_path('storage/images/qrpedidos/qr_pedido' . $pedido->id . '.svg'))->setSize(6)->svg();
            //  return QRCode::text('Pedido#0123# Para:Alonso Lopez Romo. Pasará el: 03/01/2021 a las 14:05 en la Sucursal: Villa de Seris.')->setSize(4)
            //      ->setMargin(2)
            //     ->svg();
            //notificar al admin
            //notificar al cliente
            Mail::to(auth()->user()->email)->send(new ConfirmacionPedidoClienteEmail());
        });

        return redirect()->route('pedidos.confirmacion_cliente');
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
        // return redirect()->route('pedidos.admin-index-pendientes', compact('pedidos'));
        return response('Pedido creado', 200);
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

        // dd($request);
        //almacenar pedido
        // $pedido = Pedido::create($validated);
        //almacenar productos de pedido
        // foreach ($request->productos as $key => $value)
        // {
        //     # code...

        // }

        //redirect
        // return redirect()->route('pedidos.confirmacion', compact('pedido'));
        return view('pedidos.leer-qr-pedido', compact('request'));
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