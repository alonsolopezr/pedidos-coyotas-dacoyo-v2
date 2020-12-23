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
                        <div class="flex flex-wrap mt-12 justify-center">
                            <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-4">
                                <div class="col-span-2 sm:col-span-1 xl:col-span-1">
                                    <img
                                        alt="..."
                                        src="https://source.unsplash.com/gUBJ9vSlky0"
                                        class="h-24 w-24 rounded  mx-auto"
                                    />
                                </div>
                                <div class="col-span-2 sm:col-span-4 xl:col-span-4">
                                    <h3 class="font-semibold text-black">Piloncillo</h3>
                                    <p>
                                    Coyotas rellenas de pilocillo, Paquete de 10, 5 e individuales.
                                    </p>
                                </div>
                                <div class="col-span-2 sm:col-span-1 xl:col-span-1 italic ">
                                   <div class="flex"> $80 <input class="px-6 bg-gray-300 rounded mx-4"  type="number" value="1" name="piloncillo10" id="piloncillo10" size="2" min="0" max="18"></div>
                                   <div class="flex"> $40 <input class="px-6 bg-gray-300 rounded mx-4" type="number" value="0" name="piloncillo5" id="piloncillo5" size="2" min="0" max="18"></div>
                                   <div class="flex"> $8 <input class="px-6 bg-gray-300 rounded mx-4" type="number" value="0" name="piloncillo1" id="piloncillo1" size="2" min="0" max="18"></div>
                                </div>

                                <div class="col-span-2 sm:col-span-1 xl:col-span-1">
                                    <img
                                        alt="..."
                                        src="https://source.unsplash.com/UxRhrU8fPHQ"
                                        class="h-24 w-24 rounded  mx-auto"
                                    />
                                </div>
                                <div class="col-span-2 sm:col-span-4 xl:col-span-4">
                                    <h3 class="font-semibold text-black">Jamoncillo</h3>
                                    <p>
                                    Coyotas rellenas de Jamoncillo, Paquete de 10, 5 e individuales.
                                    </p>
                                </div>
                                 <div class="col-span-2 sm:col-span-1 xl:col-span-1 italic ">
                                   <div class="flex"> $90 <input class="px-6 bg-gray-300 rounded mx-4" type="number"value="1" name="jamoncillo10" id="jamoncillo10" size="2" min="0" max="18"></div>
                                    <div class="flex">$45 <input class="px-6 bg-gray-300 rounded mx-4" type="number"value="1" name="jamoncillo5" id="jamoncillo5" size="2" min="0" max="18"></div>
                                   <div class="flex"> $9 <input class="px-6 bg-gray-300 rounded mx-4" type="number"value="0" name="jamoncillo1" id="jamoncillo1" size="2" min="0" max="18"></div>
                                </div>

                                <div class="col-span-2 sm:col-span-1 xl:col-span-1">
                                    <img
                                        alt="..."
                                        src="https://source.unsplash.com/uU0Anw-8Vsg"
                                        class="h-24 w-24 rounded  mx-auto"
                                    />
                                </div>
                                <div class="col-span-2 sm:col-span-4 xl:col-span-4">
                                    <h3 class="font-semibold text-black">Jamoncillo con nuez</h3>
                                    <p>
                                    Coyotas rellenas de Jamoncillo con nuez, Paquete de 10, 5 e individuales.
                                    </p>
                                </div>
                                 <div class="col-span-2 sm:col-span-1 xl:col-span-1 italic ">
                                   <div class="flex"> $100 <input class="px-6 bg-gray-300 rounded mx-4" type="number"value="1" name="jamoncilloNuez10" id="jamoncilloNuez10"  size="2" min="0" max="18"></div>
                                    <div class="flex">$50 <input class="px-6 bg-gray-300 rounded mx-4" type="number"value="0" name="jamoncilloNuez5" id="jamoncilloNuez5" size="2" min="0" max="18"></div>
                                   <div class="flex"> $10 <input class="px-6 bg-gray-300 rounded mx-4" type="number"value="0" name="jamoncilloNuez1" id="jamoncilloNuez1" size="2" min="0" max="18"></div>
                                </div>

                                <div class="col-span-2 sm:col-span-1 xl:col-span-1">
                                    <img
                                        alt="..."
                                        src="https://source.unsplash.com/uU0Anw-8Vsg"
                                        class="h-24 w-24 rounded  mx-auto"
                                    />
                                </div>
                                <div class="col-span-2 sm:col-span-4 xl:col-span-4">
                                    <h3 class="font-semibold text-black">Surtidos que incluyen Piloncillo, Jamoncillo, Jamoncillo con nuez</h3>
                                    <p>
                                    Coyotas Surtidas, Paquete de 10, 5 e individuales.
                                    </p>
                                </div>
                                 <div class="col-span-2 sm:col-span-1 xl:col-span-1 italic ">
                                    <div class="flex">$90 <input class="px-6 bg-gray-300 rounded mx-4" type="number" value="1" name="surtido10" id="surtido10" size="2" min="0" max="18"></div>
                                    <div class="flex"> $45 <input class="px-6 bg-gray-300 rounded mx-4" type="number" value="0" name="surtido5" id="surtido5 size="2" min="0" max="18"></div>
                                   <div class="flex"> $9 <input class="px-6 bg-gray-300 rounded mx-4" type="number" value="0" name="surtido1" id="surtido1" size="2" min="0" max="18"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="bg-red-600 p-3 m-2 rounded text-bold" type="submit">Ordenar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

