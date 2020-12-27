<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Order') }}
        </h2>
    </x-slot>

        @livewire('pedido-carrito')
        {{-- , ['user' => $user], key($user->id)) --}}
</x-app-layout>

