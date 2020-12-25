<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use Illuminate\Support\Facades\Http;

class PedidoCarrito extends Component
{
    //vars
    public $productos;
    public $pedido;
    public $cuantosArticulos;
    public $montoTotal;

    public function render()
    {
        //cargar los productos
        $this->productos = Producto::all();
        //actualizar carrito
        $this->contarArticulos();
        $this->calculaMontoTotal();
        return view('livewire.pedido-carrito');
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
                        $this->pedido[$key]['cantidad'] = $cantidad;
                    }

                    return true;
                    // dd($this->pedido, $prod['id'], $prodId, $this->pedido[$key]['cantidad'], $cantidad);
                }
            }
        return null;
    }
    public function quitarDelCarrito($idx)
    {
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

    public function registrarPedido()
    {
        //hacer el store
        Http::post('ruta_api_guardar');
    }
}