<div>
    <div class="flex flex-wrap justify-center mx-2 ">
        <div class="max-w-screen-lg py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-xl bg-coyos-lightbrown sm:rounded-lg">
                    <form action="{{route('pedidos.store')}}" method="POST">
                        @csrf
                    <!-- This is an example component -->
                        <div id="menu" class="container px-4 mx-auto lg:pt-24 lg:pb-64">
                            <div class="flex flex-wrap ">
                                <div class="justify-center w-full px-6 text-center">
                                    <h2 class="text-4xl font-semibold text-black">Seleccione sus productos</h2>
                                    <p class="max-w-full mt-4 mb-4 text-lg text-gray-900">
                                        Seleccione los paquetes de Coyotas, de nuestras delicias rellenas de piloncillo, jamoncillo y jamoncillo con nuez.
                                    </p>
                                    <p> Quedan <b>{!!$this->paquetesDisponiblesParaFecha($fecha, $this->sucursal)!!}</b> paquetes disponibles para este día en Sucursal <b>{{$this->sucursal}}</b>.</p>
                                </div>
                            </div>

                            <hr>
                            <div class="flex flex-row justify-center my-2">
                                <div class="flex flex-col justify-center col-span-2 text-center align-middle lg:flex-row max-w-max-content sm:w-full md:col-span-4 xl:col-span-4">
                                    <h3 class="pr-5 overflow-x-auto font-semibold text-black">Usted pasa por su pedido el día:</h3>

                                    <input wire:model.debounce="fecha" min="{{Carbon\Carbon::now('-7:00')->addDay()->locale('es_MX')->format('Y-m-d') }}" max="{{Carbon\Carbon::tomorrow()->addMonths($this->mesesMaxParaApartar)->format('Y-m-d')}}"  type="date" name="fecha" id="fecha"  class="mx-3 rounded bg-coyos-lightblue"/>

                                    <h4 class="pr-5 overflow-x-auto font-semibold text-black">a las</h4>
                                    <select  name="hora" id="hora" wire.change="cargarHorasDisponiblesDelDia(document.getElementById('fecha').value)"  wire:model="hora" required  class="mr-3 rounded bg-coyos-lightblue">
                                        <option>Elija</option>
                                        @foreach($this->horasDisponiblesDelDia as $hora)
                                            <option  value="{{$hora}}" >{{$hora}}</option>
                                        @endforeach
                                    </select>

                                    {{-- sucursal --}}
                                    <h4 class="pr-5 overflow-x-auto font-semibold text-black"> en Sucursal: </h4>
                                    <select name="sucursal" id="sucursal" wire.change="cargarHorasDisponiblesDelDia({{$this->fecha}})" wire:model="sucursal" class="mr-3 rounded bg-coyos-lightblue">
                                        <option value="VILLA_DE_SERIS" selected>Villa de Seris</option>
                                        <option value="OLIVARES">Olivares</option>
                                    </select>
                                </div>

                            </div>
                            <hr>
                                <div class="flex justify-center bg-coyos-darkpink">

                                    @error('fecha') <span class="py-3 text-xl text-white">{{ $message }}</span> @enderror
                                    @if ($this->hora==null||$this->hora==0)
                                        @error('hora') <span class="py-3 text-xl text-white">{{ $message }}</span> @enderror
                                    @endif

                                </div>
                            <hr>
                            {!!'hay chanza? '.$this->errorNoPaquetesDisponibles.' total '.$this->calculaTotalDePaquetes() .$this->paquetesDeCoyotas.'  y   '.$this->paquetesDisponiblesParaFecha($this->fecha, $this->sucursal)!!}
                            <div class="flex flex-col items-center justify-center ">
                            @if ($this->errorNoPaquetesDisponibles)
                                <div class="flex max-w-sm mb-4 bg-coyos-darkpink">
                                    <div class=" bg-coyos-darkblue flex-center">
                                        <div class="p-4">
                                            <svg class="w-8 h-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M437.019 74.981C388.667 26.629 324.38 0 256 0S123.333 26.63 74.981 74.981 0 187.62 0 256s26.629 132.667 74.981 181.019C123.332 485.371 187.62 512 256 512s132.667-26.629 181.019-74.981C485.371 388.667 512 324.38 512 256s-26.629-132.668-74.981-181.019zM256 470.636C137.65 470.636 41.364 374.35 41.364 256S137.65 41.364 256 41.364 470.636 137.65 470.636 256 374.35 470.636 256 470.636z" fill="#FFF"/><path d="M341.22 170.781c-8.077-8.077-21.172-8.077-29.249 0L170.78 311.971c-8.077 8.077-8.077 21.172 0 29.249 4.038 4.039 9.332 6.058 14.625 6.058s10.587-2.019 14.625-6.058l141.19-141.191c8.076-8.076 8.076-21.171 0-29.248z" fill="#FFF"/><path d="M341.22 311.971l-141.191-141.19c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.076-8.077 21.171 0 29.248l141.19 141.191a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058c8.075-8.077 8.075-21.172-.001-29.249z" fill="#FFF"/></svg>
                                        </div>
                                    </div>
                                    <div class="items-center w-auto p-4 text-black opacity-75">
                                        <span class="pb-4 text-lg font-bold text-white ">
                                            ¡Atención! Disminuya cantidades
                                        </span>
                                        <p class="leading-tight text-white ">
                                            Ya no se pueden PEDIR más paquetes en este dia, en esta sucursal.
                                        </p>
                                    </div>
                                </div>
                            @else
                            {{-- QUIEN PASA POR EL PEDIDO  --}}
                            <div class="flex flex-row w-auto bg-coyos-midbrown">
                                <div class="flex flex-row w-auto mb-4 align-self-center bg-coyos-lightblue">
                                    <div class=" bg-coyos-darkblue flex-center">
                                        <div class="mx-4 my-auto align-middle">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-basket" width="24" height="24"
                                                viewBox="0 0 20 20" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h20v20H0z" fill="none" />
                                                <polyline points="7 10 12 4 17 10" />
                                                <path d="M21 10l-2 8a2 2.5 0 0 1 -2 2h-10a2 2.5 0 0 1 -2 -2l-2 -8z" />
                                                <circle cx="12" cy="15" r="2" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center w-full p-4 text-black opacity-75">
                                       <div class="flex-row">
                                           <span class="pb-4 text-lg font-bold text-black ">
                                                ¿Quien pasará por el pedido?
                                            </span>
                                            <hr class="border-4 border-coyos-lightpink">
                                       </div>
                                        <div class="flex flex-row">
                                            <div class="flex flex-col mx-2 my-1">
                                               <div class="flex-row">
                                                   {{-- checkbox que diga: Yo paso por mi pedido --}}
                                                   <input type="checkbox" name="yoPasoPorMiPedido" id="yoPasoPorMiPedido" value="1" class="mx-2 form-checkbox" checked
                                                   wire:model="yoPasoPorPedido">
                                                   <label for="yoPasoPorMiPedido" class="font-bold text-black form-label text-md">Yo paso por mi pedido</label>
                                               </div>
                                            </div>
                                            @if (!$this->yoPasoPorPedido)
                                               <div class="flex flex-col mx-2">
                                                   <div class="flex flex-row my-2">
                                                        <p class="leading-tight text-black text-md-center">
                                                            Alguien más pasará por mi pedido.
                                                        </p>
                                                    </div>
                                                    {{-- inputs para indicar nombre de quien pasa por pedido, telefono --}}
                                                    <label for="nombreQuienPasaPorPedido" class="py-1 form-label">Nombre</label>
                                                    <input type="text" wire:model="txtNombreQuienPasaPorPedido" name="nombreQuienPasaPorPedido" id="nombreQuienPasaPorPedido" class="form-input"
                                                        placeholder="Nombre">
                                                    <label for="telefonoQuienPasaPorPedido" class="form-label">Teléfono</label>
                                                    <input type="text" wire:model="txtCelularQuienPasaPorPedido" name="telefonoQuienPasaPorPedido" id="telefonoQuienPasaPorPedido" class="form-input"
                                                        placeholder="Teléfono">

                                                </div>
                                            @endif


                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            @endif
                            </div>
                            <div class="flex flex-wrap justify-center min-w-full mt-12 ">
                                @if ($this->quedanPaquetesDisponiblesParaFecha($fecha, $this->sucursal))
                                    @foreach ($productos as $idx=>$producto)
                                        <div class="grid grid-cols-3 mx-auto gap-y-4 sm:grid-cols-4 ">
                                            <div class="col-span-1 sm:col-span-1 xl:col-span-1">
                                                <img
                                                    alt="{{$producto->nombre}}"
                                                    src="{{asset('storage/'.$producto->imagen_1)}}"
                                                    class="w-24 h-20 mx-auto my-2 border border-yellow-400 border-double rounded" />
                                            </div>
                                            <div class="flex max-w-full col-span-1 sm:col-span-2 ">
                                                <h3 class="pr-5 overflow-x-auto font-semibold text-black w-80">{{$producto->nombre}}</h3>
                                                <p class="hidden overflow-x-auto md:contents">
                                                {{$producto->descripcion}}
                                                </p>
                                            </div>
                                            <div class="col-span-1 italic sm:col-span-1 md:col-span-1 ">
                                                <div class="flex flex-row min-w-full">
                                                   <p class="ml-2"> ${{$producto->precio}}</p>

                                                   {{--  wire:model="controlNumericPaquetes[{{$idx}}]" --}}
                                                    @if ($producto->nombre=="Paquete de 10 Coyotas - Piloncillo")
                                                        <input class="px-6 mx-4 bg-gray-300 rounded" wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)" wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"  type="number"    wire:model="cuantosPaqPiloncillo10" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}"  size="2" min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 5 Coyotas - Piloncillo")
                                                        <input class="px-6 mx-4 bg-gray-300 rounded" wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)" wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"  type="number"    wire:model="cuantosPaqPiloncillo5" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}"  size="2" min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 10 Coyotas - Jamoncillo")
                                                        <input class="px-6 mx-4 bg-gray-300 rounded"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqJamoncillo10" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 5 Coyotas - Jamoncillo")
                                                        <input class="px-6 mx-4 bg-gray-300 rounded"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqJamoncillo5" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 10 Coyotas - Jamoncillo con Nuéz")
                                                        <input class="px-6 mx-4 bg-gray-300 rounded"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqJamoncilloNuez10" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 5 Coyotas - Jamoncillo con Nuéz")
                                                        <input class="px-6 mx-4 bg-gray-300 rounded"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqJamoncilloNuez5" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 10 Coyotas - Surtido")
                                                        <input class="px-6 mx-4 bg-gray-300 rounded"
                                                            wire:change="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            wire:click="agregarACarrito('coyo{{$producto->id}}',document.getElementById('coyo{{$producto->id}}').value)"
                                                            type="number" wire:model="cuantosPaqSurtido10" name="coyo{{$producto->id}}" id="coyo{{$producto->id}}" size="2"
                                                            min="0" max="20">
                                                    @elseif ($producto->nombre=="Paquete de 5 Coyotas - Surtido")
                                                        <input class="px-6 mx-4 bg-gray-300 rounded"
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
                                        <div class="flex-col text-center align-center">
                                           <h2 class="my-3 text-3xl border-b text-bold text-coyos-lightpink border-coyos-lightyellow">No hay paquetes de coyotas disponibles para este día</h2>
                                           <h2 class="my-3 text-2xl text-bold text-coyos-darkblue">Seleccione otra fecha para hacer su pedido. ;)</h2>
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
            <div class="flex justify-center">
                <div class="rounded bg-coyos-midbrown">
                    <div class="flex flex-row p-2 px-4 truncate rounded cursor-pointer bg-coyos-lightyellow">
                        <div class="text-lg font-bold">Su Pedido:</div>
                        <div class="flex flex-row-reverse w-full ml-2">
                            <div slot="icon" class="relative">
                                <div class="absolute top-0 right-0 px-1 -mt-1 -mr-2 text-xs font-bold text-white bg-red-700 rounded-full">{{$this->cuantosArticulos}}</div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 mt-2 feather feather-shopping-cart">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="z-10 w-full border-t-0 rounded-b ">
                        <div class="w-64 shadow-xl">

                            @if ($pedido!=null && $pedido!=0)
                                {{-- <script>document.getElementById('contenedorCarrito').innerHTML='';</script> --}}
                                <div name="contenedorCarrito" id="contenedorCarrito">
                                    @foreach ($pedido as $index=>$articulo)
                                        <div class="flex p-2 border-b border-gray-100 cursor-pointer bg-coyos-lightbrown hover:bg-coyos-midbrown" style="">
                                        <div class="w-12 p-2"><img src="{{asset('storage/'.$articulo['imagen_1'])}}" alt="img product"></div>
                                        <div class="flex-auto w-32 text-sm">
                                            <div class="font-bold">{{$articulo['nombre']}}</div>
                                            <div class="truncate">{{$articulo['descripcion']}}</div>
                                            <div class="text-coyos-darkblue">Cant: {{$articulo['cantidad']}} <b class="text-coyos-lightpink text-bold"> = </b> ${!!($articulo['cantidad']*$articulo['precio'])!!}</div>
                                        </div>
                                        <div class="flex flex-col items-end font-medium w-18">
                                            <div class="w-4 h-4 mb-6 text-red-700 rounded-full cursor-pointer hover:bg-red-200" wire:click="quitarDelCarrito({{$index}})">
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
                                <div class="flex justify-center p-4">
                                    <button wire:click="registrarPedido()" class="flex justify-center px-4 py-2 text-base font-bold transition duration-200 ease-in-out border rounded cursor-pointer undefined hover:scale-110 focus:outline-none hover:bg-coyos-darkpink hover:text-coyos-lightblue bg-coyos-lightblue text-coyos-lightpink border-coyos-darkblue">Registrar Pedido ${{$this->montoTotal}}
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
