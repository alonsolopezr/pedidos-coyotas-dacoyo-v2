<?php

namespace App\Http\Livewire;

use App\Models\Pedido;
use Livewire\Component;
use App\Models\Producto;
use Illuminate\Support\Carbon;
use App\Models\ProductosDePedido;
use LaravelQRCode\Facades\QRCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacionPedidoClienteEmail;

class PedidoCarrito extends Component
{
    //vars
    public $productos;
    public $pedido;
    public $cuantosArticulos;
    public $montoTotal;
    public $paquetesDeCoyotas;
    public $fecha;
    public $hora;
    public $contadorPedidosPorDia;
    //sobre horas y dia entregas
    public $horaEntregas;
    public $apartirHora = '13:55';
    public $lapsoDeMin = '5';
    public $mesesMaxParaApartar = 2;
    //horas disponibles
    public $horasDisponiblesDelDia;
    //sucursal
    public $sucursal = 'VILLA_DE_SERIS';


    public function render()
    {
        //cargar los productos
        $this->productos = Producto::all();
        //actualizar carrito
        $this->contarArticulos();
        $this->calculaMontoTotal();
        //se determina el dia siguiente para el selector de fecha
        $this->diaSiguiente();
        $this->cargarHorasDisponiblesDelDia($this->fecha);
        return view('livewire.pedido-carrito');
    }

    public function diaSiguiente()
    {
        //HACK: se asigna el valor UTC -7 hermosillo, para que dé la hora correcta
        if ($this->fecha == null)
            $this->fecha =  Carbon::now('-7:00')->addDay()->locale('es_MX')->format('Y-m-d');
        //  dd($this->fecha, Carbon::now('-7:00')->locale('es_MX')->format('H:i:s'));
    }

    public function contarArticulos()
    {
        $this->cuantosArticulos = isset($this->pedido) ? count($this->pedido) : 0;
    }


    public function mount()
    {
        //despues render????
        //actualizar carrito
        $this->contarArticulos();
    }

    public function quedanPaquetesDisponiblesParaFecha($fecha)
    {
        return $this->paquetesDisponiblesParaFecha($fecha) < 50 ? true : false;
    }

    public function paquetesDisponiblesParaFecha($fecha)
    {
        $pedidos = Pedido::where('fecha', '=', $fecha)->get()->count();
        $numPaquetes = 0;
        foreach ($pedidos as $key => $pedido)
        {
            # sacar los paquetes pedidos para ese día
            $numPaquetes += $pedido->productosDePedido()->cantidad;
        }
        return $numPaquetes;
    }


    public function agregarACarrito($prodId, $cantidad)
    {
        //parsear prodId
        $prodId = str_replace("coyo", "", $prodId);
        $prod = $this->obtenerProductoDeArray($prodId);

        //dd($this->pedido, $prodId, $cantidad, $prod->precio);
        //si ya está en el carrito, actualiza cantidad
        if ($this->siExisteActualiza($prodId, $cantidad) == null)
        {
            //agregar a carrito por cantidades
            // $this->pedido[$this->cuantosArticulos] = [
            $this->pedido[$prodId] = [
                "id" => $prodId,
                "nombre" => $prod->nombre,
                "descripcion" => $prod['descripcion'],
                "precio" => $prod['precio'],
                "imagen_1" => $prod['imagen_1'],
                "cantidad" => $cantidad,
                //TODO: necesitamos mas??
            ];
        }
        $this->calculaMontoTotal();
        //dd($this->pedido, $prodId, $cantidad, $prod);
    }

    public function obtenerProductoDeArray($prodId)
    {
        foreach ($this->productos as $key => $prod)
        {

            # code...
            // dd($prod->id, $prodId);
            if ($prod->id == $prodId)
            {
                return $prod;
            }
        }
        return null;
    }
    public function siExisteActualiza($prodId, $cantidad)
    {
        if (isset($this->pedido))
            foreach ($this->pedido as $key => $prod)
            {
                // si se encuentra el producto en el carrito
                if ($prod['id'] == $prodId)
                {
                    //si cantidad es 0, quitar del arreglo
                    if ($cantidad == 0)
                        $this->quitarDelCarrito($key);
                    else
                    {
                        //se agrega al array de carrito
                        $this->pedido[$key]['cantidad'] = $cantidad;
                        //se adiciona al total de coytas del pedido
                        $this->paquetesDeCoyotas += $cantidad;
                    }

                    return true;
                    // dd($this->pedido, $prod['id'], $prodId, $this->pedido[$key]['cantidad'], $cantidad);
                }
            }
        return null;
    }
    public function quitarDelCarrito($idx)
    {
        //restar del total de paquetes
        $this->paquetesDeCoyotas -= $this->pedido[$idx]['cantidad'];
        //quitar elemento del carrito por idx
        unset($this->pedido[$idx]);
    }


    public function calculaMontoTotal()
    {
        $this->montoTotal = 0;
        if ($this->pedido != null)
            foreach ($this->pedido as $key => $articulo)
            {
                $this->montoTotal += $articulo['cantidad'] * $articulo['precio'];
            }
    }

    public function calculaTotalDePaquetes()
    {
        $this->paquetesDeCoyotas = 0;
        if ($this->pedido != null)
            foreach ($this->pedido as $key => $articulo)
            {
                $this->paquetesDeCoyotas += $articulo['cantidad'];
            }
    }

    public function numSiguientePedido($fecha)
    {
        $contadorPorDia = count(Pedido::where('fecha', '=', $fecha)->latest()->get());
        $contadorCampo = Pedido::where('fecha', '=', $fecha)->count() == 0 ? '0' : Pedido::where('fecha', '=', $fecha)->latest()->first()->num_del_dia;
        // dd('debug pedidos', $contadorPorDia, $contadorCampo, $fecha);
        return $contadorCampo + 1;
    }

    public function estaApartadaLaHora($fecha, $hora)
    {
        //si first() es null, true, sino false
        return Pedido::where('fecha', '=', $fecha)->where('hora', '=', $hora)->first() ? true : false;
    }


    public function cargarHorasDisponiblesDelDia($fecha)
    {
        $this->horasDisponiblesDelDia = [];
        $this->horaEntregas = Carbon::parse($this->apartirHora);
        for ($i = 0; $i <= 50; $i++)
        {
            $hora = $this->horaEntregas->addMinutes(5);
            $hora = $hora->format('H:i');
            if ($this->estaApartadaLaHora($fecha, $hora) == false)
                $this->horasDisponiblesDelDia[] = $hora; //validamos si la hora está apartada
        }
    }


    public function registrarPedido()
    {

        //hacer el store
        // Http::post('ruta_api_guardar');

        $this->calculaTotalDePaquetes();
        //calcular cuantos paquetes puede apartar y si los sobrepasa,
        //ERROR, devolver  e indicarle que no debe pasar de X paquetes...

        DB::transaction(function ()
        {
            $numDelDia = $this->numSiguientePedido($this->fecha);
            //dd($numDelDia);
            //guardar pedido
            $pedido = Pedido::create(
                [
                    "folio" => $numDelDia,
                    "qr" => "000011",
                    "status" => 1,
                    "paga_en_tienda" => 1,
                    "monto_total" => $this->montoTotal,
                    "fecha" => $this->fecha,
                    "hora" => $this->hora,
                    "cancelado" => 0,
                    "cliente_id" => Auth::user()->id,
                    "num_del_dia" => $numDelDia,
                    "paquetes_de_coyotas" => $this->paquetesDeCoyotas,
                ]
            );

            //guardar productos de pedido
            foreach ($this->pedido as $key => $articulo)
            {
                ProductosDePedido::create([
                    "pedido_id" => $pedido->id,
                    "producto_id" => $articulo['id'],
                    "cantidad" => $articulo['cantidad'],
                ]);
            }
            //crer qr
            $qr = QRCode::text('Pedido#0123# Para:Alonso Lopez Romo. Pasará el: 03/01/2021 a las 14:05 en la Sucursal: Villa de Seris.')->setOutFile(public_path('storage/images/qrpedidos/qr_pedido.png'))->svg();
            //  return QRCode::text('Pedido#0123# Para:Alonso Lopez Romo. Pasará el: 03/01/2021 a las 14:05 en la Sucursal: Villa de Seris.')->setSize(4)
            //      ->setMargin(2)
            //     ->svg();
            //notificar al admin
            //notificar al cliente
            Mail::to(auth()->user()->email)->send(new ConfirmacionPedidoClienteEmail());
        });

        return redirect()->route('pedidos.confirmacion_cliente');
    }
}