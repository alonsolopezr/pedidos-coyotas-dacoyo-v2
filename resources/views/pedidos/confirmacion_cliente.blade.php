<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('New Order') }}
        </h2>
    </x-slot>

    <div>
        <div class="flex flex-wrap justify-center mx-2 ">
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-xl bg-coyos-lightbrown sm:rounded-lg">

                        <!-- This is an example component -->
                            <div id="menu" class="container px-4 mx-auto lg:pt-24 lg:pb-64">
                                <div class="flex flex-wrap justify-center text-center">
                                    <div class="w-full px-6">
                                        <h2 class="text-4xl font-semibold text-black">Pedido #{{auth()->user()->pedidos()->latest()->first()->id}}</h2>
                                        <p class="mt-4 mb-4 text-lg text-gray-900">
                                            Su Pedido ha sido registrado. Al pasar por el muestre este Código QR:
                                        </p>
                                        {{-- <img class="inline-block mb-2 align-middle border-4 border-solid border-coyos-lightyellow rounded-2xl " src="{!! QRCode::size(100)->generate(auth()->user()->pedidos()->latest()->first()->id) !!}" alt=""> --}}
                                        @php
                                            $fechaCreatedAt=\Carbon\Carbon::create(auth()->user()->pedidos()->latest()->first()->created_at->toDateTimeString())->format('Ymd')
                                        @endphp
                                        <img class="inline-block mb-6 align-middle border-4 border-solid border-coyos-lightyellow rounded-2xl " src="{{asset(auth()->user()->pedidos()->latest()->first()->qr)}}" alt="QR del Pedido">
                                    </div>
                                </div>

                                <hr>
                                <div class="flex justify-center my-2 row">
                                    <div class="flex flex-col col-span-2 max-w-max-content md:flex-row md:col-span-4 xl:col-span-4">
                                        <h3 class="pr-5 overflow-x-auto font-semibold text-black">Usted pasa por su pedido el día :</h3>
                                        <h4 class="px-2 mr-3 rounded bg-coyos-lightblue">{{auth()->user()->pedidos()->latest()->first()->fecha}}</h4>
                                        <h3 class="pr-5 overflow-x-auto font-semibold text-black"> a las </h3>
                                        <h4 class="px-2 mr-3 rounded bg-coyos-lightblue">{{auth()->user()->pedidos()->latest()->first()->hora}}</h4>
                                        {{-- sucursal --}}
                                        <h4 class="pr-5 overflow-x-auto font-semibold text-black"> en Sucursal :</h4>
                                        <h4 class="px-2 mr-3 rounded bg-coyos-lightblue">{{ucwords(str_replace("_", " ", auth()->user()->pedidos()->latest()->first()->sucursal))}}</h4>

                                    </div>
                                </div>
                                 <hr>
                                <div class="flex justify-center my-2 row">
                                     <div class="flex flex-col col-span-2 max-w-max-content md:flex-row md:col-span-4 xl:col-span-4">
                                        <h3 class="pr-5 overflow-x-auto font-semibold text-black">Usted paga :</h3>
                                        @php
                                            setlocale(LC_MONETARY,'es_MX.UTF-8');
                                            $totalMXN=auth()->user()->pedidos()->latest()->first()->monto_total;
                                        @endphp
                                        {{-- <h4 class="px-2 mr-3 rounded bg-coyos-lightblue"> ${!! money_format('%n',$totalMXN) !!}</h4> --}}
                                        <h4 class="px-2 mr-3 rounded bg-coyos-lightblue"> ${!! number_format($totalMXN, 2, '.', ''); !!}</h4>
                                        <h3 class="pr-5 overflow-x-auto font-semibold text-black"> por sus </h3>
                                        <h4 class="px-2 mr-3 rounded bg-coyos-lightblue"> {{auth()->user()->pedidos()->latest()->first()->paquetes_de_coyotas}} </h4>
                                        <h3 class="pr-5 overflow-x-auto font-semibold text-black">  paquetes de coyotas. </h3>
                                    </div>
                                </div>

                                <h2 class="py-2 my-4 text-xl font-extrabold text-center border-t border-b text-coyos-darkblue border-coyos-lightpink">¡Gracias por su preferencia!</h2>

                                <div class="flex flex-wrap justify-center min-w-full my-12 w-80">
                                    {{-- {{dd(auth()->user()->pedidos()->latest()->first()->productosDePedido)}} --}}
                                @foreach (auth()->user()->pedidos()->latest()->first()->productosDePedido as $prod)
                                    <div class="grid grid-cols-3 gap-4 sm:grid-cols-3 md:grid-cols-4">
                                        <div class="col-span-1 sm:col-span-1 xl:col-span-1">
                                            <img
                                                alt="{{$prod->producto->nombre}}"
                                                src="{{asset('storage/'.$prod->producto->imagen_1)}}"
                                                class="w-24 h-24 mx-auto rounded" />
                                        </div>
                                        <div class="flex max-w-full col-span-1 md:col-span-2 xl:col-span-2">
                                            <h3 class="pr-5 overflow-x-auto font-semibold text-black w-80">{{$prod->producto->nombre}}</h3>
                                            <p class="hidden overflow-x-auto md:contents">
                                            {{$prod->producto->descripcion}}
                                            </p>
                                        </div>
                                        <div class="col-span-1 italic sm:col-span-1 xl:col-span-1 ">
                                            <div class="flex min-w-full w-80"> ${{$prod->producto->precio}}
                                                <h3><b class="px-6 mx-3 font-bold bg-gray-300 rounded ">{{$prod->cantidad}}</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>

                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



