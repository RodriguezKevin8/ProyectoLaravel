<x-guest-layout>
    <div class="bg-white shadow-xl rounded-3xl overflow-hidden flex w-full max-w-4xl mx-auto">
        <!-- Lado izquierdo con imagen/seguridad -->
        <div class="hidden md:flex w-2/5 bg-gradient-to-br from-indigo-600 to-purple-600 items-center justify-center p-10">
            <div class="text-center text-white">
                <h2 class="text-3xl font-bold mb-4">Verificación requerida</h2>
                <p class="text-lg">Por tu seguridad, confirma tu contraseña</p>
                <img src="https://cdn-icons-png.flaticon.com/512/2913/2913461.png" class="w-28 mx-auto mt-6" alt="Seguridad">
            </div>
        </div>

        <!-- Lado derecho con formulario -->
        <div class="w-full md:w-3/5 p-8 sm:p-12">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Confirma tu contraseña</h2>
            <p class="text-center text-gray-500 mb-6">
                Esta es un área segura de la aplicación. Por favor, confirma tu contraseña para continuar.
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <!-- Campo contraseña -->
                <div>
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" placeholder="********" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Botón -->
                <div class="flex justify-end">
                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 transition-colors">
                        {{ __('Confirmar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
