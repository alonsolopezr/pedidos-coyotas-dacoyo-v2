<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Order') }}
        </h2>
    </x-slot>

    <div>
        <div class=" flex flex-wrap mx-2 justify-center">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-coyos-lightbrown overflow-hidden shadow-xl sm:rounded-lg">

                        <!-- This is an example component -->
                            <div id="menu" class="container mx-auto px-4 lg:pt-24 lg:pb-64">
                                <div class="flex flex-wrap text-center justify-center">
                                    <div class="w-full  px-6">
                                        <h2 class="text-4xl font-semibold text-black">Pedido #{{auth()->user()->pedidos()->latest()->first()->id}}</h2>
                                        <p class="text-lg mt-4 mb-4 text-gray-900">
                                            Su Pedido ha sido registrado. Al pasar por el muestre este Código QR:
                                        </p>
                                        {{-- <img class="inline-block align-middle mb-2 border-solid border-coyos-lightyellow border-4 rounded-2xl " src="{!! QRCode::size(100)->generate(auth()->user()->pedidos()->latest()->first()->id) !!}" alt=""> --}}
                                        <img class="inline-block align-middle mb-6 border-solid border-coyos-lightyellow border-4 rounded-2xl " src="storage/images/qrpedidos/qr_pedido{{auth()->user()->pedidos()->latest()->first()->id}}.svg" alt="">
                                    </div>
                                </div>

                                <hr>
                                <div class="row flex justify-center my-2">
                                    <div class="flex max-w-max-content flex-col md:flex-row col-span-2 md:col-span-4 xl:col-span-4">
                                        <h3 class="overflow-x-auto pr-5 font-semibold text-black">Usted pasa por su pedido el día :</h3>
                                        <h4 class="rounded bg-coyos-lightblue mr-3 px-2">{{auth()->user()->pedidos()->latest()->first()->fecha}}</h4>
                                        <h3 class="overflow-x-auto pr-5 font-semibold text-black"> a las </h3>
                                        <h4 class="rounded bg-coyos-lightblue mr-3 px-2">{{auth()->user()->pedidos()->latest()->first()->hora}}</h4>
                                        {{-- sucursal --}}
                                        <h4 class="overflow-x-auto pr-5 font-semibold text-black"> en Sucursal :</h4>
                                        <h4 class="rounded bg-coyos-lightblue mr-3 px-2">{{ucwords(str_replace("_", " ", auth()->user()->pedidos()->latest()->first()->sucursal))}}</h4>

                                    </div>
                                </div>
                                 <hr>
                                <div class="row flex justify-center my-2">
                                     <div class="flex max-w-max-content flex-col md:flex-row  col-span-2 md:col-span-4 xl:col-span-4">
                                        <h3 class="overflow-x-auto pr-5 font-semibold text-black">Usted paga :</h3>
                                        @php
                                            setlocale(LC_MONETARY,'es_MX.UTF-8');
                                            $totalMXN=auth()->user()->pedidos()->latest()->first()->monto_total;
                                        @endphp
                                        {{-- <h4 class="rounded bg-coyos-lightblue mr-3 px-2"> ${!! money_format('%n',$totalMXN) !!}</h4> --}}
                                        <h4 class="rounded bg-coyos-lightblue mr-3 px-2"> ${!! number_format($totalMXN, 2, '.', ''); !!}</h4>
                                        <h3 class="overflow-x-auto pr-5 font-semibold text-black"> por sus </h3>
                                        <h4 class="rounded bg-coyos-lightblue mr-3 px-2"> {{auth()->user()->pedidos()->latest()->first()->paquetes_de_coyotas}} </h4>
                                        <h3 class="overflow-x-auto pr-5 font-semibold text-black">  paquetes de coyotas. </h3>
                                    </div>
                                </div>

                                <h2 class="text-center text-xl py-2 my-4 text-coyos-darkblue font-extrabold border-t border-b border-coyos-lightpink">¡Gracias por su preferencia!</h2>

                                <div class="flex flex-wrap w-80  min-w-full my-12 justify-center">
                                    {{-- {{dd(auth()->user()->pedidos()->latest()->first()->productosDePedido)}} --}}
                                @foreach (auth()->user()->pedidos()->latest()->first()->productosDePedido as $prod)
                                    <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4  gap-4">
                                        <div class="col-span-1 sm:col-span-1 xl:col-span-1">
                                            <img
                                                alt="{{$prod->producto->nombre}}"
                                                src="{{asset('storage/'.$prod->producto->imagen_1)}}"
                                                class="h-24 w-24 rounded  mx-auto" />
                                        </div>
                                        <div class="flex max-w-full  col-span-1 md:col-span-2 xl:col-span-2">
                                            <h3 class="w-80 overflow-x-auto pr-5 font-semibold text-black">{{$prod->producto->nombre}}</h3>
                                            <p class="overflow-x-auto hidden md:contents">
                                            {{$prod->producto->descripcion}}
                                            </p>
                                        </div>
                                        <div class="col-span-1 sm:col-span-1 xl:col-span-1 italic ">
                                            <div class="flex w-80 min-w-full"> ${{$prod->producto->precio}}
                                                <h3><b class=" font-bold px-6 mx-3 bg-gray-300 rounded">{{$prod->cantidad}}</b></h3>
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
        </div>
    </div>
</x-app-layout>



