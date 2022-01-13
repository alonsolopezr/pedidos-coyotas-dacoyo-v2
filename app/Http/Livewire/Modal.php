<?php

namespace App\Http\Livewire;

use Livewire\Component;
// HACK: componente base para mostrar un modal
class Modal extends Component
{
    public $show = false;
    public $pedidoQR;

    protected $listeners = [
        'show' => 'show'
    ];

    public function show($par)
    {
        $this->show = true;
    }
}