<section>
    <header class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7.5 7.5 0 1118.88 6.196 7.5 7.5 0 015.12 17.804z" />
            </svg>
            Información del Perfil
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Actualiza tu nombre y correo electrónico. Si cambias el correo, deberás verificarlo nuevamente.
        </p>
    </header>

    <!-- Formulario de reenvío de verificación -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Formulario principal -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input 
                id="name" 
                name="name" 
                type="text" 
                class="mt-1 block w-full" 
                :value="old('name', $user->name)" 
                required 
                autofocus 
                autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="mt-1 block w-full" 
                :value="old('email', $user->email)" 
                required 
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <!-- Verificación de correo -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-700 space-y-1">
                    <p>Tu correo electrónico no está verificado.</p>

                    <button form="send-verification" class="text-indigo-600 hover:text-indigo-800 underline focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Haz clic aquí para reenviar el correo de verificación.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-green-600 font-medium">
                            Se ha enviado un nuevo enlace de verificación a tu correo.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Botón de guardar -->
        <div class="flex items-center gap-4">
            <x-primary-button>
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Guardar
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    Cambios guardados.
                </p>
            @endif
        </div>
    </form>
</section>
