<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            PEDIDOS
            {{-- {{ __('Dashboard') }} --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table>
                    <thead>
                        <tr>
                            <td>Folio</td>
                            <td>Registrado</td>
                            <td>Entrega para</td>
                            <td>Productos</td>
                            <td>Cliente</td>
                            <td>Status</td>
                            <td>Cancelar</td>
                            <td>Notificar</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->folio}}</td>
                                <td>{{$pedido->created_at}}</td>
                                <td>{{$pedido->fecha.'@'.$pedido->hora}}</td>
                                <td>{{$pedido->productos}}</td>
                                <td>{{$pedido->cliente->name}}</td>
                                <td>{{$pedido->status}}<</td>
                                <td>
                                    <form action="">
                                        <button>¿Cancelar?</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="">
                                        <textarea name="msg" id="msg" cols="30" rows="10">
                                            Escribir comentario a enviar a cliente
                                        </textarea>
                                        <button>Enviar</button>
                                    </form></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
