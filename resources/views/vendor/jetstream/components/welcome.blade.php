<div class="p-6 border-b border-gray-200 sm:px-20 bg-coyos-lightbrown">
    <div>
        <x-jet-application-logo class="block w-auto h-12" />
    </div>

    <div class="mt-8 text-2xl">
        Bienvenido a -Coyotas 'Doña Coyo'-
        {{-- Welcome to your Jetstream application! --}}
    </div>

    <div class="mt-6 text-gray-500">
        Este espacio esta dedicado a usted, procurando ser eficientes, diseñamos esta aplicación para que nos pueda registrar su pedido, y hacer mas placentero cuando pase por sus coyotas a nuestro Despacho.
        {{-- Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
        to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe
        you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel
        ecosystem to be a breath of fresh air. We hope you love it. --}}
    </div>
</div>
<div style="background-color: #756B5B;" class="mt-8 overflow-hidden shadow-xl bg-coyos-darkbrown dark:bg-coyos-darkblue sm:rounded-lg">
    <div class="grid grid-cols-1 ">
        <div class="p-6">
            <div class="flex items-center">
                <svg fill="none" stroke="rgba(255, 239, 15, 1)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-yellow-300 dark:text-yellow-300"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <div class="ml-4 text-lg font-semibold leading-7">
                    <a href="{{route('pedidos.index')}}" class="text-gray-900 underline dark:text-white">
                    {{ __('Your Orders') }}
                    </a>
                </div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Visualiza los pedidos que has realizado con nosotros.
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
            <div class="flex items-center">


                <svg fill="none" stroke="rgba(255, 239, 15, 1)"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-gray-500 w-7 h-7"fill-rule="evenodd" clip-rule="evenodd">
                    <path
                        d="M12 0l-2.138 2.63-3.068-1.441-.787 3.297-3.389.032.722 3.312-3.039 1.5 2.088 2.671-2.088 2.67 3.039 1.499-.722 3.312 3.389.033.787 3.296 3.068-1.441 2.138 2.63 2.139-2.63 3.068 1.441.786-3.296 3.39-.033-.722-3.312 3.038-1.499-2.087-2.67 2.087-2.671-3.038-1.5.722-3.312-3.39-.032-.786-3.297-3.068 1.441-2.139-2.63zm0 15.5c.69 0 1.25.56 1.25 1.25s-.56 1.25-1.25 1.25-1.25-.56-1.25-1.25.56-1.25 1.25-1.25zm1-1.038v-7.462h-2v7.462h2z" />
                </svg>
                <div class="ml-4 text-lg font-semibold leading-7">
                    <a href="{{route('pedidos.create')}}" class="text-gray-900 underline dark:text-white">
                        {{ __('New Order') }}
                    </a>
                </div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Registra un nuevo pedido, para que pases por el desde el siguiente día, en la sucursal "Doña Coyo" que selecciones.
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center">

                <svg fill="none" stroke="rgba(255, 239, 15, 1)"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-gray-500 w-7 h-7">
                    <path
                        d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z" />
                </svg>
                <div class="ml-4 text-lg font-semibold leading-7">
                    <a href="{{route('profile.show')}}" class="text-gray-900 underline dark:text-white">
                            {{ __('Profile') }}
                    </a>
                </div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Administra la información de tu cuenta.
                </div>
            </div>
        </div>

    </div>
</div>

