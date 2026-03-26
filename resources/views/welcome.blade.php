<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-100 text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">
        <div class="relative overflow-hidden">
            <div class="absolute -top-28 -left-28 h-72 w-72 rounded-full bg-amber-500/20 blur-3xl"></div>
            <div class="absolute -bottom-24 right-0 h-72 w-72 rounded-full bg-sky-500/20 blur-3xl"></div>

            <header class="relative z-10 mx-auto flex w-full max-w-6xl items-center justify-between px-6 py-6">
                <a href="{{ route('home') }}" class="flex items-center gap-3" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-md bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900">
                        <x-app-logo-icon class="h-6 w-6 fill-current" />
                    </span>
                    <span class="text-xl font-semibold tracking-tight">Cine</span>
                </a>

                <nav class="flex items-center gap-3 text-sm">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-md bg-zinc-900 px-4 py-2 font-medium text-white dark:bg-zinc-100 dark:text-zinc-900">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md border border-zinc-300 px-4 py-2 font-medium hover:bg-zinc-200 dark:border-zinc-700 dark:hover:bg-zinc-800">
                            Iniciar sesion
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-md bg-zinc-900 px-4 py-2 font-medium text-white dark:bg-zinc-100 dark:text-zinc-900">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                </nav>
            </header>

            <main class="relative z-10 mx-auto grid w-full max-w-6xl gap-8 px-6 pb-16 pt-6 md:grid-cols-2 md:items-center md:pb-24 md:pt-14">
                <section>
                    <p class="mb-3 inline-flex rounded-full border border-zinc-300 px-3 py-1 text-xs font-medium dark:border-zinc-700">
                        Gestion de cine en un solo lugar
                    </p>
                    <h1 class="mb-4 text-4xl font-semibold leading-tight md:text-5xl">
                        Administra sucursales, salas, peliculas y funciones
                    </h1>
                    <p class="mb-8 max-w-xl text-zinc-600 dark:text-zinc-300">
                        Plataforma para operaciones de cine con panel de control, importacion de peliculas y reportes para una gestion rapida.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('login') }}" class="rounded-md bg-zinc-900 px-5 py-2.5 font-medium text-white dark:bg-zinc-100 dark:text-zinc-900">
                            Empezar ahora
                        </a>
                        <a href="{{ route('dashboard') }}" class="rounded-md border border-zinc-300 px-5 py-2.5 font-medium hover:bg-zinc-200 dark:border-zinc-700 dark:hover:bg-zinc-800">
                            Ver dashboard
                        </a>
                    </div>
                </section>

                <section class="rounded-2xl border border-zinc-200 bg-white/70 p-6 backdrop-blur dark:border-zinc-800 dark:bg-zinc-900/60">
                    <h2 class="mb-4 text-lg font-semibold">Resumen rapido</h2>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div class="rounded-lg bg-zinc-100 p-4 dark:bg-zinc-800">
                            <p class="text-zinc-500 dark:text-zinc-400">Modulo</p>
                            <p class="mt-1 font-semibold">Peliculas</p>
                        </div>
                        <div class="rounded-lg bg-zinc-100 p-4 dark:bg-zinc-800">
                            <p class="text-zinc-500 dark:text-zinc-400">Modulo</p>
                            <p class="mt-1 font-semibold">Funciones</p>
                        </div>
                        <div class="rounded-lg bg-zinc-100 p-4 dark:bg-zinc-800">
                            <p class="text-zinc-500 dark:text-zinc-400">Modulo</p>
                            <p class="mt-1 font-semibold">Salas</p>
                        </div>
                        <div class="rounded-lg bg-zinc-100 p-4 dark:bg-zinc-800">
                            <p class="text-zinc-500 dark:text-zinc-400">Modulo</p>
                            <p class="mt-1 font-semibold">Sucursales</p>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
