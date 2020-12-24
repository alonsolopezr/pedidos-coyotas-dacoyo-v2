<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            PEDIDOS
            {{-- {{ __('Dashboard') }} --}}
        </h2>
    </x-slot>
    <div class=" flex flex-wrap mx-2 justify-center">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form action="{{route('pedidos.store')}}" method="POST">
                        @csrf
                    <!-- This is an example component -->
                        <div id="menu" class="container mx-auto px-4 lg:pt-24 lg:pb-64">
                            <div class="flex flex-wrap text-center justify-center">
                                <div class="w-full lg:w-6/12 px-4">
                                    <h2 class="text-4xl font-semibold text-black">Seleccione sus productos</h2>
                                    <p class="text-lg leading-relaxed mt-4 mb-4 text-gray-500">
                                        Seleccione los paquetes de Coyotas, de nuestras delicias rellenas de piloncillo, jamoncillo y jamoncillo con nuez.
                                    </p>
                                </div>
                            </div>

                            <hr>
                            <div class="flex flex-wrap mt-12 justify-center">
                            @foreach ($productos as $producto)
                                <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-4">
                                    <div class="col-span-2 sm:col-span-1 xl:col-span-1">
                                        <img
                                            alt="{{$producto->nombre}}"
                                            src="{{asset('storage/'.$producto->imagen_1)}}"
                                            class="h-24 w-24 rounded  mx-auto" />
                                    </div>
                                    <div class="col-span-2 sm:col-span-4 xl:col-span-4">
                                        <h3 class="font-semibold text-black">{{$producto->nombre}}</h3>
                                        <p>
                                        {{$producto->descripcion}}
                                        </p>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1 xl:col-span-1 italic ">
                                        <div class="flex"> ${{$producto->precio}} <input class="px-6 bg-gray-300 rounded mx-4"  type="number" value="1" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2" min="0" max="18"></div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            <hr>
                            <button class="bg-red-600 p-3 m-2 rounded text-bold" type="submit">Ordenar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @livewire('carrito')
        {{-- , ['user' => $user], key($user->id)) --}}
    </div>

</x-app-layout>

