<x-layouts.app :title="__('Dashboard')">
    <div class="space-y-8">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-neutral-800">
                <p class="text-xs uppercase tracking-wide text-neutral-500 dark:text-neutral-400">{{ __('Películas') }}</p>
                <p class="mt-2 text-3xl font-semibold text-neutral-900 dark:text-neutral-100">{{ $totalPeliculas }}</p>
            </div>
            <div class="rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-neutral-800">
                <p class="text-xs uppercase tracking-wide text-neutral-500 dark:text-neutral-400">{{ __('Salas') }}</p>
                <p class="mt-2 text-3xl font-semibold text-neutral-900 dark:text-neutral-100">{{ $totalSalas }}</p>
            </div>
            <div class="rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-neutral-800">
                <p class="text-xs uppercase tracking-wide text-neutral-500 dark:text-neutral-400">{{ __('Sucursales') }}</p>
                <p class="mt-2 text-3xl font-semibold text-neutral-900 dark:text-neutral-100">{{ $totalSucursales }}</p>
            </div>
            <div class="rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-neutral-800">
                <p class="text-xs uppercase tracking-wide text-neutral-500 dark:text-neutral-400">{{ __('Funciones (7 días)') }}</p>
                <p class="mt-2 text-3xl font-semibold text-neutral-900 dark:text-neutral-100">{{ $totalFuncionesUltimos7 }}</p>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-2">
            <div class="rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-neutral-800">
                <h3 class="font-semibold text-neutral-800 dark:text-neutral-100 mb-4">{{ __('Funciones e ingresos últimos 7 días') }}</h3>
                <div class="h-[320px]">
                    <canvas id="chartFunciones" class="h-full w-full"></canvas>
                </div>
            </div>
            <div class="rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-neutral-800">
                <h3 class="font-semibold text-neutral-800 dark:text-neutral-100 mb-4">{{ __('Películas por género') }}</h3>
                <div class="h-[320px]">
                    <canvas id="chartGeneros" class="h-full w-full"></canvas>
                </div>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-2">
            <div class="rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-neutral-800">
                <h3 class="font-semibold text-neutral-800 dark:text-neutral-100 mb-4">{{ __('Top 5 películas por funciones') }}</h3>
                <div class="h-[320px]">
                    <canvas id="chartTopPeliculas" class="h-full w-full"></canvas>
                </div>
            </div>
            <div class="rounded-lg border border-neutral-200 dark:border-neutral-700 p-4 bg-white dark:bg-neutral-800">
                <h3 class="font-semibold text-neutral-800 dark:text-neutral-100 mb-4">{{ __('Reporte rápido por sala') }}</h3>
                <form action="{{ route('admin.reportePeliculasSalas') }}" method="GET" class="space-y-3">
                    <div>
                        <label for="sala_id" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">{{ __('Sala') }}</label>
                        <select name="sala_id" id="sala_id" class="w-full rounded border-neutral-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-neutral-100 text-sm py-2">
                            @foreach($salas as $sala)
                                <option value="{{ $sala->id }}">{{ $sala->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <flux:button type="submit" variant="primary" size="sm">{{ __('Generar Reporte') }}</flux:button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script>
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const neutralGrid = prefersDark ? 'rgba(255,255,255,0.08)' : 'rgba(17,24,39,0.08)';
            const palette = {
                primary: '#2563eb',
                accent: '#e11d48',
                green: '#059669',
                amber: '#d97706',
                violet: '#7c3aed',
            };

            const ctxFunciones = document.getElementById('chartFunciones');
            new Chart(ctxFunciones, {
                type: 'bar',
                data: {
                    labels: @json($labelsDias),
                    datasets: [
                        {
                            type: 'bar',
                            label: '{{ __('Funciones') }}',
                            data: @json($funcionesPorDia),
                            backgroundColor: palette.primary + 'cc',
                            borderRadius: 6,
                            maxBarThickness: 42,
                        },
                        {
                            type: 'line',
                            label: '{{ __('Ingresos') }}',
                            data: @json($ingresosPorDia),
                            tension: .35,
                            borderColor: palette.accent,
                            backgroundColor: palette.accent,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    scales: {
                        y: { beginAtZero: true, grid: { color: neutralGrid } },
                        y1: { beginAtZero: true, position: 'right', grid: { drawOnChartArea: false } },
                        x: { grid: { display: false } }
                    },
                    plugins: { legend: { display: true } }
                }
            });

            const ctxGeneros = document.getElementById('chartGeneros');
            new Chart(ctxGeneros, {
                type: 'doughnut',
                data: {
                    labels: @json($peliculasGeneroLabels),
                    datasets: [{
                        data: @json($peliculasGeneroData),
                        backgroundColor: [palette.primary, palette.accent, palette.green, palette.amber, palette.violet, '#6366f1', '#14b8a6'],
                        borderWidth: 0,
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
            });

            const ctxTop = document.getElementById('chartTopPeliculas');
            new Chart(ctxTop, {
                type: 'bar',
                data: {
                    labels: @json($topPeliculasLabels),
                    datasets: [{
                        label: '{{ __('Funciones') }}',
                        data: @json($topPeliculasData),
                        backgroundColor: palette.green + 'dd',
                        borderRadius: 6,
                        maxBarThickness: 40,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { x: { beginAtZero: true, grid: { color: neutralGrid } }, y: { grid: { display: false } } },
                    plugins: { legend: { display: false } }
                }
            });
        </script>
    @endpush
</x-layouts.app>
