<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de Pedido - Coyotas Doña Coyo</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

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
                                        {{-- <img class="inline-block align-middle mb-2 border-solid border-coyos-lightyellow border-4 rounded-2xl " src="{!!$message->embedData(QRCode::format('svg')->generate(auth()->user()->pedidos()->latest()->first()->id), 'QrCode.png', 'storage/image/qrpedidos')!!}"> --}}
                                        <img class="inline-block align-middle mb-2 border-solid border-coyos-lightyellow border-4 rounded-2xl " src="storage/images/qrpedidos/qr_pedido{{auth()->user()->pedidos()->latest()->first()->id}}.svg" alt="">


                                    </div>
                                </div>

                                <hr>
                                <div class="row flex justify-center my-2">
                                    <div class="flex max-w-max-content col-span-2 md:col-span-4 xl:col-span-4">
                                        <h3 class="overflow-x-auto pr-5 font-semibold text-black">Usted pasa por su pedido el día :</h3>
                                        <h4 class="rounded bg-coyos-lightblue mr-3 px-2">{{auth()->user()->pedidos()->latest()->first()->fecha}}</h4>
                                        <h3 class="overflow-x-auto pr-5 font-semibold text-black"> a las </h3>
                                        <h4 class="rounded bg-coyos-lightblue mr-3 px-2">{{auth()->user()->pedidos()->latest()->first()->hora}}</h4>
                                        {{-- sucursal --}}
                                        <h4 class="overflow-x-auto pr-5 font-semibold text-black"> en Sucursal :</h4>
                                        <h4 class="rounded bg-coyos-lightblue mr-3 px-2">{{ucwords(str_replace("_", " ", auth()->user()->pedidos()->latest()->first()->sucursal))}}</h4>
                                        <hr>
                                        <hr>


                                    </div>

                                </div>
                                <h2 class="text-center text-xl py-2 my-4 text-coyos-darkblue font-extrabold border-t border-b border-coyos-lightpink">¡Gracias por su preferencia!</h2>

                                <div class="flex flex-wrap w-80  min-w-full mt-12 justify-center">
                                    {{-- {{dd(auth()->user()->pedidos()->latest()->first()->productosDePedido)}} --}}
                                @foreach (auth()->user()->pedidos()->latest()->first()->productosDePedido as $prod)
                                    <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-4">
                                        <div class="col-span-2 sm:col-span-1 xl:col-span-1">
                                            <img
                                                alt="{{$prod->producto->nombre}}"
                                                src="{{asset('storage/'.$prod->producto->imagen_1)}}"
                                                class="h-24 w-24 rounded  mx-auto" />
                                        </div>
                                        <div class="flex max-w-full  col-span-2 md:col-span-4 xl:col-span-4">
                                            <h3 class="w-80 overflow-x-auto pr-5 font-semibold text-black">{{$prod->producto->nombre}}</h3>
                                            <p class="overflow-x-auto sm:hidden md:contents">
                                            {{$prod->producto->descripcion}}
                                            </p>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1 xl:col-span-1 italic ">
                                            <div class="flex w-80 min-w-full"> ${{$prod->producto->precio}}
                                                <h3 class="px-6 bg-blue-300 rounded mx-4" >"{{$prod->cantidad}}"</h3>
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
</body>
</html>


