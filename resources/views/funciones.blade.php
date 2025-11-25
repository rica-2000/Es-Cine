<x-layouts.app :title="__('Funciones')">
    <div class="flex items-center justify-between gap-4">
        <div>
            <flux:heading size="lg">{{ __('Funciones') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Administra las funciones (horarios) de las películas.') }}</flux:text>
        </div>
        <flux:modal.trigger name="funcion-create">
            <flux:button variant="primary">{{ __('Agregar Función') }}</flux:button>
        </flux:modal.trigger>
    </div>

    <flux:modal name="funcion-create" class="md:w-[520px]">
        <div>
            <flux:heading size="lg">{{ __('Agregar función') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Agrega los detalles de la función') }}</flux:text>
        </div>
        <form method="POST" action="{{ route('funciones.save') }}" class="mt-6 space-y-5">
            @csrf
            <div>
                <flux:label for="fecha" value="{{ __('Fecha y hora') }}" />
                <flux:input id="fecha" name="fecha" type="datetime-local" class="mt-1 block w-full" required />
                @foreach ($errors->get('fecha') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="sala_id" value="{{ __('Sala') }}" />
                <flux:select id="sala_id" name="sala_id" class="mt-1 block w-full" required>
                    <flux:select.option :value="''" disabled selected>{{ __('Selecciona una sala') }}</flux:select.option>
                    @foreach ($salas as $sala)
                        <flux:select.option :value="$sala->id">{{ $sala->name }} — {{ $sala->sucursal->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                @foreach ($errors->get('sala_id') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="pelicula_id" value="{{ __('Película') }}" />
                <flux:select id="pelicula_id" name="pelicula_id" class="mt-1 block w-full" required>
                    <flux:select.option :value="''" disabled selected>{{ __('Selecciona una película') }}</flux:select.option>
                    @foreach ($peliculas as $pelicula)
                        <flux:select.option :value="$pelicula->id">{{ $pelicula->title }}</flux:select.option>
                    @endforeach
                </flux:select>
                @foreach ($errors->get('pelicula_id') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="tipo" value="{{ __('Tipo') }}" />
                <flux:input id="tipo" name="tipo" type="text" class="mt-1 block w-full" placeholder="{{ __('Ej. 2D, 3D, IMAX') }}" required />
                @foreach ($errors->get('tipo') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="costo" value="{{ __('Costo') }}" />
                <flux:input id="costo" name="costo" type="number" step="0.01" min="0" class="mt-1 block w-full" placeholder="{{ __('Ej. 85.00') }}" required />
                @foreach ($errors->get('costo') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div class="flex items-center gap-4 pt-2">
                <flux:button type="submit">{{ __('Guardar Función') }}</flux:button>
                <flux:button type="button" class="text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200" x-on:click="$dispatch('close')">{{ __('Cancelar') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    <div class="mt-6 overflow-hidden bg-white dark:bg-neutral-800 shadow-sm ring-1 ring-black ring-opacity-5 rounded-lg">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-neutral-50 dark:bg-neutral-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Fecha y hora') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Sala') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Sucursal') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Película') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Tipo') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Costo') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse ($funciones as $funcion)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->fecha?->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->sala->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->sala->sucursal->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->pelicula->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->tipo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">${{ number_format($funcion->costo, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <form method="POST" action="{{ route('funciones.delete', $funcion->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button size="sm" class="text-red-600 hover:text-red-900" onclick="this.closest('form').submit();">{{ __('Eliminar') }}</flux:button>
                                </form>
                                <flux:brand href="{{ route('funciones.show', $funcion->id) }}" size="sm" class="text-blue-600 hover:text-blue-900">{{ __('Modificar') }}</flux:brand>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-sm text-neutral-500 dark:text-neutral-400">{{ __('No hay funciones registradas todavía.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
