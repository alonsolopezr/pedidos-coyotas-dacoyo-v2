<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Your Orders') }}
        </h2>
    </x-slot>

    <div class="min-w-full py-12">
        <div class="mx-auto max-w-max-content sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl bg-coyos-lightbrown sm:rounded-lg">
                <table class="max-w-full border-4 border-solid border-coyos-lightpink">
                    <thead>
                        <tr class="border-4 border-solid border-coyos-lightyellow">
                            {{-- <td class="p-3 font-bold text-center text-gray-600 uppercase border-r-4 bg-coyos-lightblue border-coyos-darkblue lg:table-cell">Folio</td> --}}
                            <td class="p-3 font-bold text-center text-gray-600 uppercase border-r-4 bg-coyos-lightblue border-coyos-darkblue lg:table-cell">Registrado el</td>
                            <td class="p-3 font-bold text-center text-gray-600 uppercase border-r-4 bg-coyos-lightblue border-coyos-darkblue lg:table-cell">Entrega para</td>
                            <td class="p-3 font-bold text-center text-gray-600 uppercase border-r-4 bg-coyos-lightblue border-coyos-darkblue lg:table-cell">¿Qué ordenaste?</td>
                            <td class="p-3 font-bold text-center text-gray-600 uppercase border-r-4 bg-coyos-lightblue border-coyos-darkblue lg:table-cell">Sucursal</td>
                            <td class="p-3 font-bold text-center text-gray-600 uppercase border-r-4 bg-coyos-lightblue border-coyos-darkblue lg:table-cell">Status</td>
                            <td class="p-3 font-bold text-center text-gray-600 uppercase border-r-4 bg-coyos-lightblue border-coyos-darkblue lg:table-cell">Cancelar</td>
                            <td class="p-3 font-bold text-center text-gray-600 uppercase border-r-4 rounded bg-coyos-lightblue border-coyos-lightyellow lg:table-cell">QR y Detalles</td>
                            {{-- <td class="p-3 font-bold text-center text-gray-600 uppercase border-r-4 rounded bg-coyos-lightblue border-coyos-lightyellow lg:table-cell">Notificar</td> --}}
                        </tr>
                    </thead>
                    <tbody class="border-4 border-solid border-coyos-lightpink">
                        @foreach ($pedidos as $pedido)
                            <tr class="px-2 border-4 border-solid border-coyos-lightpink">
                                {{-- <td class="px-2 text-center border-r-4 border-solid border-coyos-darkblue">{{$pedido->folio}}</td> --}}
                                <td class="px-2 text-center border-r-4 border-solid border-coyos-darkblue">{{$pedido->created_at}}</td>
                                <td class="px-2 text-center border-r-4 border-solid border-coyos-darkblue w-max-content ">{{$pedido->fecha.'@'.$pedido->hora}}</td>
                                <td class="px-2 text-center border-r-4 border-solid border-coyos-darkblue">{{$pedido->paquetes_de_coyotas}} Paquetes</td>
                                <td class="px-2 text-center border-r-4 border-solid border-coyos-darkblue">{{$pedido->sucursal}}</td>
                                @php
                                    $clases="";
                                    if ($pedido->status=='REGISTRADO')
                                    {
                                        $clases="px-2 text-center bg-orange-400 text-coyos-darkblue rounded text-xl  text-bold ";
                                    }else if($pedido->status=='CONFIRMADO')
                                    $clases="px-2 text-center bg-blue-400 text-coyos-darkblue rounded text-xl  text-bold  ";
                                    else if($pedido->status=='EN_PROCESO')
                                    $clases="px-2 text-center bg-yellow-600 text-coyos-darkblue rounded text-xl  text-bold  ";
                                    else if($pedido->status=='PREPARADO')
                                    $clases="px-2 text-center bg-teal-600 text-coyos-lightyellow rounded text-xl  text-bold  ";
                                    else if($pedido->status=='EMPAQUETADO')
                                    $clases="px-2 text-center bg-coyos-midbrown text-coyos-darkblue rounded text-xl  text-bold  ";
                                    else if($pedido->status=='EMPAQUETADO')
                                    $clases="px-2 text-center bg-coyos-midbrown text-coyos-darkblue rounded text-xl  text-bold  ";
                                    else if($pedido->status=='ESPERANDO_CLIENTE')
                                    $clases="px-2 text-center bg-coyos-lightyellow text-coyos-darkblue rounded text-xl  text-bold  ";
                                    else if($pedido->status=='ENTREGADO')
                                    $clases="px-2 text-center bg-green-500 text-coyos-darkblue rounded text-xl  text-bold  ";
                                @endphp
                                <td class="px-2 border-r-4 border-solid border-coyos-darkblue" ><p class="{{$clases}}">{{$pedido->status}}</p></td>

                                @if ($pedido->status=='ENTREGADO')
                                    <td colspan="2" class="px-2 py-4 text-center border-r-4 border-solid border-coyos-darkpink">
                                        <p class="px-2 py-2 mx-2 text-2xl text-center text-green-700 align-middle text-xl-center text-bold ">Pedido entregado y disfrutado.</p>
                                    </td>
                                @else
                                    <td class="px-2 text-center border-r-4 border-solid border-coyos-darkblue">
                                        <form action="">
                                            <button class="px-2 py-2 mx-2 text-xl text-center align-middle rounded shadow-outline-indigo hover:bg-coyos-lightblue hover:text-coyos-darkpink bg-coyos-darkpink text-coyos-lightblue text-bold">¿Cancelar?</button>
                                        </form>
                                    </td>
                                    <td class="flex flex-row border-r-4 border-solid border-coyos-darkpink">
                                        {{-- mostrar el qr en etiqueta img con el src --}}
                                        <img src="{{asset($pedido->qr)}}" alt="" class="w-full h-full">
                                        {{-- <form action="" class="flex flex-row max-h-full">
                                            <textarea class="rounded bg-cool-gray-300 " name="msg" id="msg" cols="30" rows="5" placeholder="¿quieres comentar algo sobre tu pedido?">

                                            </textarea>
                                            <button class="min-h-full text-xl text-center rounded hover:bg-coyos-darkblue -pt-10 hover:text-coyos-lightyellow bg-coyos-lightyellow text-coyos-darkblue text-bold">Enviar</button>
                                        </form> --}}

                                    </td>
                                    <!-- API Token Permissions Modal -->
                                    {{-- TODO: hacer un modal para mostrar el QRz --}}
                                    <x-jet-dialog-modal wire:model="">
                                        <x-slot name="title">
                                            {{ __('API Token Permissions') }}
                                        </x-slot>

                                        <x-slot name="content">
                                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                                            </div>
                                        </x-slot>

                                        <x-slot name="footer">
                                            <x-jet-secondary-button wire:click="" wire:loading.attr="disabled">
                                                {{ __('Nevermind') }}
                                            </x-jet-secondary-button>

                                            <x-jet-button class="ml-2" wire:click="" wire:loading.attr="disabled">
                                                {{ __('Save') }}
                                            </x-jet-button>
                                        </x-slot>
                                    </x-jet-dialog-modal>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>


