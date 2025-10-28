<x-layouts.app :title="__('Películas')">
    <div class="flex items-center justify-between gap-4">
        <div>
            <flux:heading size="lg">{{ __('Películas') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Administra las películas disponibles.') }}</flux:text>
        </div>
        <flux:modal.trigger name="pelicula-create">
            <flux:button variant="primary">{{ __('Agregar Película') }}</flux:button>
        </flux:modal.trigger>
    </div>

    <flux:modal name="pelicula-create" class="md:w-[480px]">
        <div>
            <flux:heading size="lg">{{ __('Agregar película') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Agrega todos los detalles de la película') }}</flux:text>
        </div>
        <form method="POST" action="{{ route('peliculas.save') }}" class="mt-6 space-y-5">
            @csrf
            <div>
                <flux:label for="title" value="{{ __('Título de la Película') }}" />
                <flux:input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="{{ __('Ej. Inception') }}" required autofocus autocomplete="title" />
                @foreach ($errors->get('title') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="genre" value="{{ __('Género') }}" />
                <flux:input id="genre" name="genre" type="text" class="mt-1 block w-full" placeholder="{{ __('Ej. Ciencia ficción') }}" required autocomplete="genre" />
                @foreach ($errors->get('genre') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="duration" value="{{ __('Duración (min)') }}" />
                <flux:input id="duration" name="duration" type="number" min="1" class="mt-1 block w-full" placeholder="{{ __('Ej. 148') }}" required autocomplete="duration" />
                @foreach ($errors->get('duration') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="director" value="{{ __('Director') }}" />
                <flux:input id="director" name="director" type="text" class="mt-1 block w-full" placeholder="{{ __('Ej. Christopher Nolan') }}" required autocomplete="director" />
                @foreach ($errors->get('director') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div class="flex items-center gap-4 pt-2">
                <flux:button type="submit">{{ __('Guardar Película') }}</flux:button>
                <flux:button type="button" class="text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200" x-on:click="$dispatch('close')">{{ __('Cancelar') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    <div class="mt-6 overflow-hidden bg-white dark:bg-neutral-800 shadow-sm ring-1 ring-black ring-opacity-5 rounded-lg">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-neutral-50 dark:bg-neutral-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Título') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Género') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Duración (min)') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Director') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse ($peliculas as $pelicula)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $pelicula->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $pelicula->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $pelicula->genre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $pelicula->duration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $pelicula->director }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <form method="POST" action="{{ route('peliculas.delete', $pelicula->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button size="sm" class="text-red-600 hover:text-red-900" onclick="this.closest('form').submit();">{{ __('Eliminar') }}</flux:button>
                                </form>
                                <flux:brand href="{{ route('peliculas.show', $pelicula->id) }}" size="sm" class="text-blue-600 hover:text-blue-900">{{ __('Modificar') }}</flux:brand>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-sm text-neutral-500 dark:text-neutral-400">{{ __('No hay películas registradas todavía.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.app>