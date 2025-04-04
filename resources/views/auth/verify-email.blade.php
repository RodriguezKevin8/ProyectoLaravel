<x-guest-layout>
    <div class="flex items-center justify-center p-6">
        <!-- Fondo morado: contenedor más ancho y con menor altura -->
        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 w-full max-w-xl py-6 px-4 rounded-lg">
            <!-- Contenedor del contenido -->
            <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-2xl mx-auto">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div>
                            <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 transition-colors">
                                {{ __('Resend Verification Email') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
