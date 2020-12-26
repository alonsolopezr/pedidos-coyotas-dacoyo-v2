<div>
    <div class=" flex flex-wrap mx-2 justify-center">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-coyos-lightbrown overflow-hidden shadow-xl sm:rounded-lg">
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
                            <div class="flex flex-wrap w-80  min-w-full mt-12 justify-center">
                            @foreach ($productos as $producto)
                                <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-4">
                                    <div class="col-span-2 sm:col-span-1 xl:col-span-1">
                                        <img
                                            alt="{{$producto->nombre}}"
                                            src="{{asset('storage/'.$producto->imagen_1)}}"
                                            class="h-24 w-24 rounded  mx-auto" />
                                    </div>
                                    <div class="flex max-w-full  col-span-2 md:col-span-4 xl:col-span-4">
                                        <h3 class="w-80 overflow-x-auto pr-5 font-semibold text-black">{{$producto->nombre}}</h3>
                                        <p class="overflow-x-auto sm:hidden md:contents">
                                        {{$producto->descripcion}}
                                        </p>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1 xl:col-span-1 italic ">
                                        <div class="flex w-80 min-w-full"> ${{$producto->precio}}
                                            <input class="px-6 bg-gray-300 rounded mx-4" wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"   type="number" value="0" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2" min="0" max="18">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- carrito --}}
         <div class="p-5">
            <div class="flex h-64 justify-center">
                <div class="relative ">
                    <div class="flex flex-row cursor-pointer truncate p-2 px-4  rounded">
                        <div></div>
                        <div class="flex flex-row-reverse ml-2 w-full">
                            <div slot="icon" class="relative">
                                <div class="absolute text-xs rounded-full -mt-1 -mr-2 px-1 font-bold top-0 right-0 bg-red-700 text-white">{{$this->cuantosArticulos}}</div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart w-6 h-6 mt-2">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="absolute w-full  rounded-b border-t-0 z-10">
                        <div class="shadow-xl w-64">

                            @if ($pedido!=null && $pedido!=0)
                                {{-- <script>document.getElementById('contenedorCarrito').innerHTML='';</script> --}}
                                <div name="contenedorCarrito" id="contenedorCarrito">
                                    @foreach ($pedido as $index=>$articulo)
                                        <div class="p-2 flex bg-coyos-lightbrown hover:bg-coyos-midbrown cursor-pointer border-b border-gray-100" style="">
                                        <div class="p-2 w-12"><img src="{{asset('storage/'.$articulo['imagen_1'])}}" alt="img product"></div>
                                        <div class="flex-auto text-sm w-32">
                                            <div class="font-bold">{{$articulo['nombre']}}</div>
                                            <div class="truncate">{{$articulo['descripcion']}}</div>
                                            <div class="text-coyos-darkblue">Cant: {{$articulo['cantidad']}} <b class="text-coyos-lightpink text-bold"> = </b> ${!!($articulo['cantidad']*$articulo['precio'])!!}</div>
                                        </div>
                                        <div class="flex flex-col w-18 font-medium items-end">
                                            <div class="w-4 h-4 mb-6 hover:bg-red-200 rounded-full cursor-pointer text-red-700" wire:click="quitarDelCarrito({{$index}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 ">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                            </div>
                                            ${{$articulo['precio']}}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="p-4 justify-center flex">
                                <button wire:click="registrarPedido()" class="text-base  undefined  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                hover:bg-coyos-darkpink hover:text-coyos-lightblue
                bg-coyos-lightblue
                text-coyos-lightpink
                border duration-200 ease-in-out
                border-coyos-darkblue transition">Registrar Pedido ${{$this->montoTotal}}</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="h-32"></div>
        </div>
        {{-- , ['user' => $user], key($user->id)) --}}
    </div>

</div>
