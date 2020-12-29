<div class="p-6 sm:px-20 bg-coyos-lightbrown border-b border-gray-200">
    <div>
        <x-jet-application-logo class="block h-12 w-auto" />
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
<div style="background-color: #756B5B;" class="mt-8 bg-coyos-darkbrown  dark:bg-coyos-darkblue overflow-hidden shadow-xl sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <div class="flex items-center">
                <svg fill="none" stroke="rgba(255, 239, 15, 1)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-yellow-300 dark:text-yellow-300"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <div class="ml-4 text-lg leading-7 font-semibold">
                    <a href="{{route('pedidos.index')}}" class="underline text-gray-900 dark:text-white">
                    {{ __('Your Orders') }}
                    </a>
                </div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    Visualiza los pedidos que has realizado con nosotros.
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
            <div class="flex items-center">

                <svg fill="none" stroke="rgba(255, 239, 15, 1)"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                    <path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                    <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>

                </svg>
                <div class="ml-4 text-lg leading-7 font-semibold">
                    <a href="{{route('pedidos.create')}}" class="underline text-gray-900 dark:text-white">
                        {{ __('New Order') }}
                    </a>
                </div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    Registra un nuevo pedido, para que pases por el desde el siguiente día, en la sucursal "Doña Coyo" que selecciones.
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <svg fill="none" stroke="rgba(255, 239, 15, 1)"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                <div class="ml-4 text-lg leading-7 font-semibold">
                    <a href="{{route('profile.show')}}" class="underline text-gray-900 dark:text-white">
                            {{ __('Profile') }}
                    </a>
                </div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    Administra la información de tu cuenta.
                </div>
            </div>
        </div>

    </div>
</div>

