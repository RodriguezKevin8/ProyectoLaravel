<x-guest-layout>
    <!-- Contenedor principal centrado -->
    <div class="flex items-center justify-center p-6">
        <!-- Fondo morado: contenedor más ancho y con menor altura -->
        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 w-full max-w-xl py-6 px-4 rounded-lg">
            <!-- Contenedor del formulario -->
            <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-2xl mx-auto">
                <h2 class="text-center text-3xl font-bold text-gray-900">
                    {{ __('Crea tu cuenta') }}
                </h2>
                <p class="text-center text-base text-gray-600">
                    {{ __('Ya tienes una cuenta?') }}
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                        {{ __('Inicia sesión') }}
                    </a>
                </p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Apellido -->
                    <div class="mt-4">
                        <x-input-label for="apellido" :value="__('Apellido')" />
                        <x-text-input id="apellido" class="block w-full mt-1" type="text" name="apellido" :value="old('apellido')" required autocomplete="apellido" />
                        <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Botón de registro y enlace a login -->
                    <div class="flex items-center justify-end mt-4">
                        <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        <x-primary-button class="ml-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
