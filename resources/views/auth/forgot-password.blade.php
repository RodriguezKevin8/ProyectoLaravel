<x-guest-layout>
    <div class="bg-white shadow-xl rounded-3xl overflow-hidden flex w-full max-w-4xl mx-auto">
        <!-- Lado izquierdo con ilustración -->
        <div class="hidden md:flex w-2/5 bg-gradient-to-br from-indigo-600 to-purple-600 items-center justify-center p-10">
            <div class="text-center text-white">
                <h2 class="text-3xl font-bold mb-4">¿Olvidaste tu contraseña?</h2>
                <p class="text-base">No te preocupes, te ayudamos a recuperarla</p>
                <img src="https://cdn-icons-png.flaticon.com/512/10357/10357289.png" class="w-32 mx-auto mt-6" alt="Recuperar contraseña">
            </div>
        </div>

        <!-- Formulario -->
        <div class="w-full md:w-3/5 p-8 sm:p-12">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Restablece tu contraseña</h2>
            <p class="text-sm text-gray-600 text-center mb-6">
                Ingresa tu correo electrónico y te enviaremos un enlace para que puedas crear una nueva contraseña.
            </p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Correo electrónico')" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        placeholder="tucorreo@ejemplo.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Botón -->
                <div class="flex items-center justify-end">
                    <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 transition-colors">
                        {{ __('Enviar enlace de restablecimiento') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
