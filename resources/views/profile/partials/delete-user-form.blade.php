<section class="space-y-6">
    <header class="mb-4">
        <h2 class="text-xl font-semibold text-red-600 flex items-center gap-2">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Eliminar cuenta
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Esta acción es permanente. Una vez que elimines tu cuenta, todos tus datos serán eliminados. Por favor, asegúrate de guardar cualquier información importante antes de continuar.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        Eliminar cuenta
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900">
                ¿Estás completamente seguro?
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Esta acción eliminará tu cuenta y todos tus datos de forma permanente. Para confirmar, por favor ingresa tu contraseña.
            </p>

            <div class="mt-4">
                <x-input-label for="password" value="{{ __('Contraseña') }}" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="••••••••"
                    autocomplete="current-password"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button>
                    Confirmar eliminación
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
