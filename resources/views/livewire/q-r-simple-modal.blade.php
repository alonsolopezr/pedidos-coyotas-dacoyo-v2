<div>
    <x-modal wire:model="show">
        <div class="p-6">
            Mostrar este QR al pasar por su pedido:
        </div>

            
            <div class="w-full p-6">
                <img class="w-full" src="{{ $qr['qr'] ?? 'NO HAY QR CREADO'}}" alt="IMAGEN DE QR">
            </div>


    </x-modal>
</div>
