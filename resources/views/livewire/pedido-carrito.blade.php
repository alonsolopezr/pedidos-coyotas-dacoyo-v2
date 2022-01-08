<div>
    <div class=" flex flex-wrap mx-2 justify-center">
        <div class="py-12 max-w-screen-lg">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-coyos-lightbrown overflow-hidden shadow-xl sm:rounded-lg">
                    <form action="{{route('pedidos.store')}}" method="POST">
                        @csrf
                    <!-- This is an example component -->
                        <div id="menu" class="container mx-auto px-4 lg:pt-24 lg:pb-64">
                            <div class="flex flex-wrap ">
                                <div class="w-full text-center justify-center px-6">
                                    <h2 class="text-4xl font-semibold text-black">Seleccione sus productos</h2>
                                    <p class="text-lg mt-4 mb-4 text-gray-900 max-w-full">
                                        Seleccione los paquetes de Coyotas, de nuestras delicias rellenas de piloncillo, jamoncillo y jamoncillo con nuez.
                                    </p>
                                    <p> Quedan <b>{!!$this->paquetesDisponiblesParaFecha($fecha, $this->sucursal)!!}</b> paquetes disponibles para este día en Sucursal <b>{{$this->sucursal}}</b>.</p>
                                </div>
                            </div>

                            <hr>
                            <div class="flex flex-row justify-center my-2">
                                <div class="flex lg:flex-row flex-col max-w-max-content col-span-2 sm:w-full text-center align-middle justify-center md:col-span-4 xl:col-span-4">
                                    <h3 class="overflow-x-auto pr-5 font-semibold text-black">Usted pasa por su pedido el día:</h3>

                                    <input wire:model.debounce="fecha" min="{{Carbon\Carbon::now('-7:00')->addDay()->locale('es_MX')->format('Y-m-d') }}" max="{{Carbon\Carbon::tomorrow()->addMonths($this->mesesMaxParaApartar)->format('Y-m-d')}}"  type="date" name="fecha" id="fecha"  class="rounded bg-coyos-lightblue mx-3"/>

                                    <h4 class="overflow-x-auto pr-5 font-semibold text-black">a las</h4>
                                    <select  name="hora" id="hora" wire.change="cargarHorasDisponiblesDelDia(document.getElementById('fecha').value)"  wire:model="hora" required  class="rounded bg-coyos-lightblue mr-3">
                                        <option>Elija</option>
                                        @foreach($this->horasDisponiblesDelDia as $hora)
                                            <option  value="{{$hora}}" >{{$hora}}</option>
                                        @endforeach
                                    </select>

                                    {{-- sucursal --}}
                                    <h4 class="overflow-x-auto pr-5 font-semibold text-black"> en Sucursal: </h4>
                                    <select name="sucursal" id="sucursal" wire.change="cargarHorasDisponiblesDelDia({{$this->fecha}})" wire:model="sucursal" class="rounded bg-coyos-lightblue mr-3">
                                        <option value="VILLA_DE_SERIS" selected>Villa de Seris</option>
                                        <option value="OLIVARES">Olivares</option>
                                    </select>
                                </div>

                            </div>
                            <hr>
                                <div class="flex justify-center bg-coyos-darkpink">

                                    @error('fecha') <span class="text-xl text-white py-3">{{ $message }}</span> @enderror
                                    @if ($this->hora==null||$this->hora==0)
                                        @error('hora') <span class="text-xl  text-white py-3">{{ $message }}</span> @enderror
                                    @endif

                                </div>
                            <hr>
                            {!!'hay chanza? '.$this->errorNoPaquetesDisponibles.' total '.$this->calculaTotalDePaquetes() .$this->paquetesDeCoyotas.'  y   '.$this->paquetesDisponiblesParaFecha($this->fecha, $this->sucursal)!!}
                            <div class="flex flex-col items-center justify-center ">
                            @if ($this->errorNoPaquetesDisponibles)
                                <div class="flex  bg-coyos-darkpink max-w-sm mb-4">
                                    <div class=" bg-coyos-darkblue flex-center ">
                                        <div class="p-4">
                                            <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M437.019 74.981C388.667 26.629 324.38 0 256 0S123.333 26.63 74.981 74.981 0 187.62 0 256s26.629 132.667 74.981 181.019C123.332 485.371 187.62 512 256 512s132.667-26.629 181.019-74.981C485.371 388.667 512 324.38 512 256s-26.629-132.668-74.981-181.019zM256 470.636C137.65 470.636 41.364 374.35 41.364 256S137.65 41.364 256 41.364 470.636 137.65 470.636 256 374.35 470.636 256 470.636z" fill="#FFF"/><path d="M341.22 170.781c-8.077-8.077-21.172-8.077-29.249 0L170.78 311.971c-8.077 8.077-8.077 21.172 0 29.249 4.038 4.039 9.332 6.058 14.625 6.058s10.587-2.019 14.625-6.058l141.19-141.191c8.076-8.076 8.076-21.171 0-29.248z" fill="#FFF"/><path d="M341.22 311.971l-141.191-141.19c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.076-8.077 21.171 0 29.248l141.19 141.191a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058c8.075-8.077 8.075-21.172-.001-29.249z" fill="#FFF"/></svg>
                                        </div>
                                    </div>
                                    <div class="w-auto text-black opacity-75 items-center p-4">
                                        <span class="text-lg font-bold pb-4 text-white ">
                                            ¡Atención! Disminuya cantidades
                                        </span>
                                        <p class="leading-tight text-white ">
                                            Ya no se pueden PEDIR más paquetes en este dia, en esta sucursal.
                                        </p>
                                    </div>
                                </div>
                            @else

                            @endif
                            </div>
                            <div class="flex flex-wrap justify-center  min-w-full mt-12  ">
                                @if ($this->quedanPaquetesDisponiblesParaFecha($fecha, $this->sucursal))
                                    @foreach ($productos as $idx=>$producto)
                                        <div class="grid mx-auto grid-cols-3 gap-y-4 sm:grid-cols-4 ">
                                            <div class="col-span-1 sm:col-span-1 xl:col-span-1">
                                                <img
                                                    alt="{{$producto->nombre}}"
                                                    src="{{asset('storage/'.$producto->imagen_1)}}"
                                                    class="h-20 w-24 rounded  mx-auto my-2 border border-yellow-400 border-double" />
                                            </div>
                                            <div class="flex max-w-full  col-span-1 sm:col-span-2 ">
                                                <h3 class="w-80 overflow-x-auto pr-5 font-semibold text-black">{{$producto->nombre}}</h3>
                                                <p class="overflow-x-auto hidden md:contents">
                                                {{$producto->descripcion}}
                                                </p>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1 md:col-span-1 italic ">
                                                <div class="flex flex-row  min-w-full">
                                                   <p class="ml-2"> ${{$producto->precio}}</p>

                                                   {{--  wire:model="controlNumericPaquetes[{{$idx}}]" --}}
                                                    @if ($producto->nombre=="Paquete de 10 Coyotas - Piloncillo")
                                                        <input class="px-6 bg-gray-300 rounded mx-4" wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)" wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"  type="number"    wire:model="cuantosPaqPiloncillo10" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}"  size="2" min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 5 Coyotas - Piloncillo")
                                                        <input class="px-6 bg-gray-300 rounded mx-4" wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)" wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"  type="number"    wire:model="cuantosPaqPiloncillo5" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}"  size="2" min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 10 Coyotas - Jamoncillo")
                                                        <input class="px-6 bg-gray-300 rounded mx-4"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqJamoncillo10" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 5 Coyotas - Jamoncillo")
                                                        <input class="px-6 bg-gray-300 rounded mx-4"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqJamoncillo5" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 10 Coyotas - Jamoncillo con Nuéz")
                                                        <input class="px-6 bg-gray-300 rounded mx-4"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqJamoncilloNuez10" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 5 Coyotas - Jamoncillo con Nuéz")
                                                        <input class="px-6 bg-gray-300 rounded mx-4"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqJamoncilloNuez5" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 10 Coyotas - Surtido")
                                                        <input class="px-6 bg-gray-300 rounded mx-4"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqSurtido10" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 5 Coyotas - Surtido")
                                                        <input class="px-6 bg-gray-300 rounded mx-4"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqSurtido5" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">

                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                        <div class="flex-col align-center text-center">
                                           <h2 class="text-3xl text-bold text-coyos-lightpink border-b border-coyos-lightyellow my-3">No hay paquetes de coyotas disponibles para este día</h2>
                                           <h2 class="text-2xl text-bold text-coyos-darkblue  my-3">Seleccione otra fecha para hacer su pedido. ;)</h2>
                                        </div>
                                @endif
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- carrito --}}
         <div class="p-5 mt-0 lg:mt-7">
            <div class="flex  justify-center">
                <div class="bg-coyos-midbrown rounded">
                    <div class="flex flex-row bg-coyos-lightyellow cursor-pointer truncate p-2 px-4  rounded">
                        <div class="font-bold text-lg">Su Pedido:</div>
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
                    <div class=" w-full  rounded-b border-t-0 z-10">
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

                            @if ($this->cuantosArticulos>0 && $this->errorNoPaquetesDisponibles==false)
                                <div class="p-4 justify-center flex">
                                    <button wire:click="registrarPedido()" class="text-base  undefined  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                                        hover:bg-coyos-darkpink hover:text-coyos-lightblue
                                        bg-coyos-lightblue
                                        text-coyos-lightpink
                                        border duration-200 ease-in-out
                                        border-coyos-darkblue transition">Registrar Pedido ${{$this->montoTotal}}
                                    </button>
                                </div>
                            @endif

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
