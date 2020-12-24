<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <div>
                <x-jet-label for="lastname" value="{{ __('Lastname') }}" />
                <x-jet-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="name" />
            </div>
            <div>
                <x-jet-label for="celular" value="{{ __('Celular') }}" />
                <x-jet-input id="celular" class="block mt-1 w-full" type="text" name="celular" :value="old('celular')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

             <div class="mt-4">
                <x-jet-label for="street" value="{{ __('Street') }}" />
                <x-jet-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required />
            </div>

             <div class="mt-4">
                <x-jet-label for="number" value="{{ __('House Number') }}" />
                <x-jet-input id="number" class="block mt-1 w-full" name="number" :value="old('number')"  type="number"  required />
            </div>
             <div class="mt-4">
                <x-jet-label for="residential" value="{{ __('Residential') }}" />
                <x-jet-input id="residential" class="block mt-1 w-full" name="residential" :value="old('residential')"  type="text"  required />
            </div>

             <div class="mt-4">
                <x-jet-label for="postal_code" value="{{ __('Postal Code') }}" />
                <x-jet-input id="postal_code" class="block mt-1 w-full" name="postal_code" :value="old('postal_code')"  type="text"  required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
