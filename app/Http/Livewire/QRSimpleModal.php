<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QRSimpleModal extends Modal
{
    public $qr;

    public function mount()
    {
        # init
        //  $this->qr = $qr;
    }
    public function render()
    {
        $codigoqr = $this->qr;
        return view('livewire.q-r-simple-modal', ["qr" => $this->qr]);
    }

    public function show($qr)
    {
        //dd('SI LLEGA HASTA EL MOSTRARQR', asset($qr['qr']));
        $this->qr = $qr; //asset($qr['qr']);
        // $this->show = true;
        parent::show(asset($qr['qr']));
    }
    public function ocultarQR()
    {
        $this->qr = null;
        $toggle = false;
        $this->displayValue = "hidden";
    }
}