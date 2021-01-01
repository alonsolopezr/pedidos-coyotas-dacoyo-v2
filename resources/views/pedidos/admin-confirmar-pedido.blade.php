
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirm Client\'s Orders') }}
        </h2>
    </x-slot>

    <div class="py-12 min-w-full">
        <div class="max-w-max-content mx-auto sm:px-6 lg:px-8">
            <div class="bg-coyos-lightbrown overflow-hidden shadow-xl sm:rounded-lg">
                <table class="border-solid border-4 border-coyos-lightpink  max-w-full">
                    <thead>
                        <tr class="border-solid border-4 border-coyos-lightyellow">
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-darkblue text-center lg:table-cell">Folio</td>
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-darkblue text-center lg:table-cell">Registrado el</td>
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-darkblue text-center lg:table-cell">Cliente</td>
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-darkblue text-center lg:table-cell">Contacto</td>
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-darkblue text-center lg:table-cell">Entrega para</td>
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-darkblue text-center lg:table-cell">¿Qué ordenó?</td>
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-darkblue text-center lg:table-cell">Sucursal</td>
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-darkblue text-center lg:table-cell">Status</td>
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-darkblue text-center lg:table-cell">Confirmar</td>
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-darkblue text-center lg:table-cell">Cancelar</td>
                            <td class="p-3 font-bold uppercase bg-coyos-lightblue text-gray-600 border-r-4 border-coyos-lightyellow text-center rounded lg:table-cell">Notificar</td>
                        </tr>
                    </thead>
                    <tbody class="border-solid border-4 border-coyos-lightpink">
                        @foreach ($pedidos as $pedido)
                            @if ($pedido->status=='REGISTRADO')
                                <tr class="border-solid border-4 border-coyos-lightpink px-2">
                                <td class="px-2 text-center border-solid border-r-4 border-coyos-darkblue">{{$pedido->folio}}</td>
                                <td class="px-2 text-center border-solid border-r-4 border-coyos-darkblue">{{$pedido->created_at}}</td>
                                <td class="px-2 text-center border-solid border-r-4 border-coyos-darkblue w-max-content ">{{$pedido->cliente->name.' '.$pedido->cliente->lastname}}</td>
                                <td class="px-2 text-center border-solid border-r-4 border-coyos-darkblue w-max-content "><a href="">{{$pedido->cliente->email}}</a>{{' '.$pedido->cliente->celular}}</td>
                                <td class="px-2 text-center border-solid border-r-4 border-coyos-darkblue w-max-content ">{{$pedido->fecha.'@'.$pedido->hora}}</td>
                                <td class="px-2 text-center border-solid border-r-4 border-coyos-darkblue">{{$pedido->paquetes_de_coyotas}}</td>
                                <td class="px-2 text-center border-solid border-r-4 border-coyos-darkblue">{{$pedido->sucursal}}</td>
                                @php
                                    $clases="";
                                    if ($pedido->status=='REGISTRADO')
                                    {
                                        $clases="px-2 text-center bg-orange-400 text-coyos-darkblue rounded text-xl  text-bold ";
                                    }
                                @endphp
                                <td class="px-2 border-solid border-r-4 border-coyos-darkblue" ><p class="{{$clases}}">{{$pedido->status}}</p></td>


                                    <td class="px-2 text-center border-solid border-r-4 border-coyos-darkblue">
                                        <form action="{{ route('pedidos.admin-confirma-pedido-update', $pedido->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button value="{{$pedido->id}}" type="submit" name="confirma" id="confirma{{$pedido->id}}" class="text-center align-middle shadow-outline-indigo  hover:bg-green-400 mx-2 hover:text-coyos-lightblue bg-coyos-darkblue text-green-400 rounded text-xl px-2 py-2 text-bold">¿Confirmar?</button>
                                        </form>
                                    </td>
                                    <td class="px-2 text-center border-solid border-r-4 border-coyos-darkblue">
                                        <form action="{{route('pedidos.admin-cancela-pedido-update',$pedido->id)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button value="{{$pedido->id}}" name="{{$pedido->id}}" id="cancela{{$pedido->id}}"  class="text-center align-middle shadow-outline-indigo  hover:bg-coyos-lightblue mx-2 hover:text-coyos-darkpink bg-coyos-darkpink text-coyos-lightblue rounded text-xl px-2 py-2 text-bold">¿Cancelar?</button>
                                        </form>
                                    </td>

                                    <td class="flex flex-row border-solid border-r-4 border-coyos-darkpink">
                                        <form action="" class="flex flex-row max-h-full">
                                            <textarea class="bg-cool-gray-300 rounded " name="msg" id="msg" cols="30" rows="5" placeholder="¿quieres comentar algo sobre tu pedido?">

                                            </textarea>
                                            <button class="min-h-full text-center hover:bg-coyos-darkblue -pt-10  hover:text-coyos-lightyellow bg-coyos-lightyellow text-coyos-darkblue rounded text-xl  text-bold">Enviar</button>
                                        </form>
                                    </td>
                                </td>
                            </tr>
                            @else

                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>


