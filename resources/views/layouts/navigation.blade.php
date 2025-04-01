<nav x-data="{ open: false }" class="bg-white shadow border-b border-gray-200">
    <!-- Contenedor principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo y navegación izquierda -->
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <x-application-logo class="w-8 h-8 text-indigo-600" />
                    <span class="text-lg font-bold text-indigo-600 hidden sm:inline">Eventify</span>
                </a>

                <!-- Navegación desktop -->
                <div class="hidden sm:flex gap-4 ml-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('evento.index')" :active="request()->routeIs('evento.index')">
                        {{ __('Eventos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('participante.index')" :active="request()->routeIs('participante.index')">
                        {{ __('Participaciones') }}
                    </x-nav-link>
                </div>
            </div>

            
            <!-- Dropdown de usuario -->
<div class="hidden sm:flex items-center gap-4">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-indigo-600 focus:outline-none bg-gray-50 px-3 py-1.5 rounded-md shadow-sm border border-gray-200">
                <div class="bg-indigo-100 p-1.5 rounded-full">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A7.5 7.5 0 1118.88 6.196 7.5 7.5 0 015.12 17.804z" />
                    </svg>
                </div>
                <span>{{ Auth::user()->name }}</span>
                <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414l-4.707-4.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Perfil') }}
            </x-dropdown-link>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Cerrar sesión') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>


            <!-- Botón hamburguesa -->
            <div class="sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-500 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{ 'hidden': open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden px-4 pb-4">
        <div class="pt-4 border-t border-gray-200 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('evento.index')" :active="request()->routeIs('evento.index')">
                {{ __('Eventos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('participante.index')" :active="request()->routeIs('participante.index')">
                {{ __('Participaciones') }}
            </x-responsive-nav-link>
        </div>

        <!-- Info usuario y logout -->
        <div class="pt-4 border-t border-gray-200">
            <div class="px-4 text-sm">
                <div class="font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
