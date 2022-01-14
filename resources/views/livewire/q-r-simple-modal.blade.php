<div>
    <x-modal wire:model="show">
        <div class="p-6 justify-items-stretch">
            Mostrar este QR al pasar por su pedido: <button class="px-2  hover:text-coyos-darkpink" wire:click="ocultarQR">X</button>
        </div>


            <div class="w-full p-6">
                <img class="w-full" src="{{ $qr['qr'] ?? 'NO HAY QR CREADO'}}" alt="IMAGEN DE QR">
            </div>


    </x-modal>
</div>
