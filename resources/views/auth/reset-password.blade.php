<x-guest-layout>
    <div class="bg-white shadow-xl rounded-3xl overflow-hidden flex w-full max-w-4xl mx-auto">
        <!-- Lado izquierdo con imagen -->
        <div class="hidden md:flex w-2/5 bg-gradient-to-br from-indigo-600 to-purple-600 items-center justify-center p-10">
            <div class="text-center text-white">
                <h2 class="text-3xl font-bold mb-4">Restablece tu contraseña</h2>
                <p class="text-base">Recupera el acceso a tu cuenta en segundos</p>
                <img src="https://cdn-icons-png.flaticon.com/512/10357/10357341.png" class="w-32 mx-auto mt-6" alt="Reset Password">
            </div>
        </div>

        <!-- Formulario -->
        <div class="w-full md:w-3/5 p-8 sm:p-12">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Ingresa tu nueva contraseña</h2>
            <p class="text-sm text-gray-600 text-center mb-6">Coloca tu correo y la nueva contraseña para actualizar tu acceso</p>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Correo electrónico')" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full" 
                        type="email" 
                        name="email" 
                        :value="old('email', $request->email)" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="tucorreo@ejemplo.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Nueva contraseña -->
                <div>
                    <x-input-label for="password" :value="__('Nueva contraseña')" />
                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="new-password"
                        placeholder="********" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirmar contraseña -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
                    <x-text-input 
                        id="password_confirmation" 
                        class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="********" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Botón -->
                <div class="flex justify-end">
                    <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 transition-colors">
                        {{ __('Restablecer contraseña') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
