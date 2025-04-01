<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-12">
        <div class="bg-white shadow-xl rounded-3xl overflow-hidden flex w-full max-w-4xl">
            <!-- Lado izquierdo con imagen/ilustración -->
            <div class="hidden md:flex w-1/2 bg-gradient-to-br from-indigo-500 to-purple-600 items-center justify-center p-10">
                <div class="text-center text-white">
                    <h2 class="text-4xl font-bold mb-4">Bienvenido de nuevo</h2>
                    <p class="text-lg">Accede y únete a los eventos más increíbles</p>
                    <img src="https://cdn-icons-png.flaticon.com/512/3043/3043883.png" class="w-40 mx-auto mt-6" alt="Eventos">
                </div>
            </div>

            <!-- Lado derecho con formulario -->
            <div class="w-full md:w-1/2 p-8 sm:p-12">
                <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">Inicia sesión</h2>
                <p class="text-center text-gray-500 mb-6">Organiza o confirma tu asistencia a eventos</p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Correo electrónico')" />
                        <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="tucorreo@ejemplo.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Contraseña')" />
                        <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" placeholder="********" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Recordarme -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Botón -->
                    <div>
                        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 transition-colors flex items-center py-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                            </svg>
                            {{ __('Iniciar sesión') }}
                        </x-primary-button>
                    </div>
                </form>

                <p class="mt-6 text-sm text-center text-gray-600">
                    ¿No tienes una cuenta?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Crea una gratis</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
