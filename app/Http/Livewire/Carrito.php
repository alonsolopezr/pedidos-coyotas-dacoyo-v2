<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Carrito extends Component
{
    //vars
    public $productos;

    public function render()
    {
        return view('livewire.carrito');
    }
}
