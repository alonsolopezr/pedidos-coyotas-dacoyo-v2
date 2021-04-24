
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Read QR Client\'s Orders') }}
        </h2>
    </x-slot>

    <div class="py-12 min-w-full">
        <decode-all @decode="onDecode"></decode-all>


    </div>
</x-app-layout>


