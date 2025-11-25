<x-layouts.app :title="__('Modificar función')">
    <div>
        <flux:heading size="lg">{{ __('Modificar función') }}</flux:heading>
        <flux:text class="mt-2">{{ __('Actualiza los datos de la función') }}</flux:text>
    </div>
    <form method="POST" action="{{ route('funciones.update', $funcion->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')
        <div>
            <flux:label for="fecha" value="{{ __('Fecha y hora') }}" />
            <flux:input id="fecha" name="fecha" type="datetime-local" class="mt-1 block w-full" :value="$funcion->fecha?->format('Y-m-d\\TH:i')" required />
            @foreach ($errors->get('fecha') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div>
            <flux:label for="sala_id" value="{{ __('Sala') }}" />
            <flux:select id="sala_id" name="sala_id" class="mt-1 block w-full" required>
                @foreach ($salas as $sala)
                    <flux:select.option :value="$sala->id" :selected="$funcion->sala_id === $sala->id">
                        {{ $sala->name }} — {{ $sala->sucursal->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
            @foreach ($errors->get('sala_id') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div>
            <flux:label for="pelicula_id" value="{{ __('Película') }}" />
            <flux:select id="pelicula_id" name="pelicula_id" class="mt-1 block w-full" required>
                @foreach ($peliculas as $pelicula)
                    <flux:select.option :value="$pelicula->id" :selected="$funcion->pelicula_id === $pelicula->id">
                        {{ $pelicula->title }}
                    </flux:select.option>
                @endforeach
            </flux:select>
            @foreach ($errors->get('pelicula_id') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div>
            <flux:label for="tipo" value="{{ __('Tipo') }}" />
            <flux:input id="tipo" name="tipo" type="text" class="mt-1 block w-full" :value="$funcion->tipo" required />
            @foreach ($errors->get('tipo') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div>
            <flux:label for="costo" value="{{ __('Costo') }}" />
            <flux:input id="costo" name="costo" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="number_format($funcion->costo, 2, '.', '')" required />
            @foreach ($errors->get('costo') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div class="flex items-center gap-4">
            <flux:button type="submit">{{ __('Guardar cambios') }}</flux:button>
            <flux:button as="a" href="{{ route('funciones.index') }}" class="text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200">{{ __('Cancelar') }}</flux:button>
        </div>
    </form>
</x-layouts.app>
