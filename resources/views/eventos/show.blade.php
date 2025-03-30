<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __($evento->titulo) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                 @if(auth()->user()->isAdmin)
                 <div class="flex items-center justify-end gap-2">
                    <a href="{{route('evento.edit', $evento)}}" class="p-2 text-sm font-bold transition-colors rounded bg-sky-300 hover:bg-sky-400 text-slate-700">
                        Editar
                    </a>
                    <div x-data="{ showModal: false }">
                        <!-- Botón que abre el modal (reemplaza tu submit actual) -->
                        <button
                            @click="showModal = true"
                            type="button"
                            class="p-2 text-sm font-bold text-white transition-colors bg-red-500 rounded hover:bg-red-600"
                        >
                            Eliminar
                        </button>

                        <!-- Modal -->
                        <div
                            x-show="showModal"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                            x-transition:enter="ease-out duration-300"
                            x-transition:leave="ease-in duration-200"
                        >
                            <div
                                @click.away="showModal = false"
                                class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl"
                            >
                                <h3 class="text-lg font-medium">Confirmar Eliminacion</h3>
                                <p class="mt-2 text-gray-600">¿Estás seguro de eliminar este evento?</p>

                                <div class="flex justify-end mt-4 space-x-3">
                                    <button
                                        @click="showModal = false"
                                        type="button"
                                        class="p-2 text-sm font-bold text-white transition-colors bg-red-500 rounded hover:bg-red-600"
                                    >
                                        Cancelar
                                    </button>

                                    <!-- Formulario real (se activa al confirmar) -->
                                    <form
                                        id="updateForm"
                                        action="{{ route('evento.destroy', $evento) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="p-2 text-sm font-bold text-white transition-colors rounded bg-sky-500 hover:bg-sky-600"
                                        >
                                            Sí, Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
                @endif

                 @if(session()->has('message'))
                    <p class="my-4 font-bold text-center text-green-500">
                        {{session('message')}}
                    </p>
                @endif

                   <div class="mt-4">
                    <p>{{$evento->descripcion}}</p>
                    <div class="mt-4">
                        <p class="text-sm font-bold"><span class="font-normal">Inicio: </span>{{$evento->fecha_inicio}}</p>
                        <p class="text-sm font-bold"><span class="font-normal">Finalización: </span>{{$evento->fecha_fin}}</p></div>
                    </div>

                   @if (auth()->user()->id != $evento->user_id)
                   @if($participante != null)
                   <div class="mt-4">
                    <p class="font-bold text-slate-700">Eliminar mi Participacion</p>
                        <form action="{{route('participante.destroy', $evento)}}" class="mt-2" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="p-2 text-sm font-bold text-white transition-colors bg-red-500 rounded hover:bg-red-600">Elminar Participacion</button>
                        </form>
                    </div>
                   @else
                   <div class="mt-4">
                    <p class="font-bold text-slate-700">Participar en este evento</p>
                        <form action="{{route('participante.store', $evento)}}" class="mt-2" method="POST">
                            @csrf
                            <button class="p-2 text-sm font-bold text-white transition-colors bg-green-500 rounded hover:bg-green-600">Confirmar Asistencia</button>
                        </form>
                    </div>
                   @endif
                   @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
