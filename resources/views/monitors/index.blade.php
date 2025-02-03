@php use Carbon\Carbon; @endphp

@extends('layouts.master')

@section('title', 'Monitores')

@section('content')

    <div class="flex w-full gap-4">

        {{-- Contenedor principal de la tabla --}}
        <div class="relative flex h-full w-full flex-col rounded-xl bg-white text-slate-700 shadow-md">

            {{-- Barra de búsqueda --}}
            <div class="relative mx-4 mt-4">
                <div class="flex flex-row items-center justify-end p-4">
                    <div class="block w-full md:w-72">
                        <div class="relative h-10 w-full min-w-[200px]">
                            <div
                                class="pointer-events-none absolute right-3 top-1/2 grid h-5 w-5 -translate-y-1/2 place-items-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0
                                                          105.196 5.196a7.5 7.5 0
                                                          0010.607 10.607z" />
                                </svg>
                            </div>
                            <input
                                class="peer h-full w-full rounded-md border border-slate-200 bg-transparent px-3 py-2.5 pr-9 text-sm font-normal text-slate-800 placeholder-slate-400 outline-none focus:border-slate-800 focus:ring-0 disabled:cursor-not-allowed"
                                placeholder="Buscar monitoreos..." />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabla de monitores --}}
            <div class="overflow-auto px-4">
                <table class="mt-4 w-full min-w-max table-auto text-left">
                    <thead class="border-b border-slate-200 text-sm font-semibold text-slate-600">
                        <tr>
                            <th class="py-3">Monitor</th>
                            <th class="py-3">Estado</th>
                            <th class="py-3">Último check</th>
                            <th class="py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700">
                        @foreach ($monitors as $key => $monitor)
                            @php
                                // Definir colores y etiquetas según el estado
                                $statusConfig = match ($monitor['status']) {
                                    1 => [
                                        'color' => 'bg-green-500',
                                        'text' => 'Online',
                                        'textColor' => 'text-green-700',
                                        'bgOpacity' => 'bg-green-500/10',
                                    ],
                                    2 => [
                                        'color' => 'bg-red-500',
                                        'text' => 'Down',
                                        'textColor' => 'text-red-700',
                                        'bgOpacity' => 'bg-red-500/10',
                                    ],
                                    3 => [
                                        'color' => 'bg-yellow-400',
                                        'text' => 'Stopped',
                                        'textColor' => 'text-yellow-700',
                                        'bgOpacity' => 'bg-yellow-400/10',
                                    ],
                                    default => [
                                        'color' => 'bg-slate-400',
                                        'text' => 'Desconocido',
                                        'textColor' => 'text-slate-700',
                                        'bgOpacity' => 'bg-slate-400/10',
                                    ],
                                };
                            @endphp

                            <tr class="border-b border-slate-100 hover:bg-slate-50">
                                <td class="py-3 align-middle">
                                    <div class="flex items-center gap-3">
                                        {{-- Ping animation círculo --}}
                                        <div class="relative">
                                            <span
                                                class="{{ $statusConfig['color'] }} absolute h-4 w-4 animate-ping rounded-full opacity-75"></span>
                                            <span
                                                class="{{ $statusConfig['color'] }} relative inline-block h-4 w-4 rounded-full"></span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-medium text-slate-800">
                                                {{ $monitor['friendlyName'] }}
                                            </span>
                                            <span class="text-xs text-slate-500">
                                                {{ $monitor['url'] }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-3 align-middle">
                                    <div class="inline-flex items-center gap-2">
                                        <span
                                            class="{{ $statusConfig['bgOpacity'] }} {{ $statusConfig['textColor'] }} rounded-md px-2 py-1 text-xs font-bold uppercase">
                                            {{ $statusConfig['text'] }}
                                        </span>
                                    </div>
                                </td>

                                <td class="py-3 align-middle">
                                    <span class="text-sm text-slate-700">
                                        {{ Carbon::parse($monitor['lastCheck'])->format('d/m/Y H:i') }}
                                    </span>
                                </td>

                                <td class="py-3 align-middle">
                                    <div class="flex items-center gap-2">
                                        {{-- Botón ver detalle --}}
                                        <button
                                            onclick="window.location.href='{{ route('monitors.show', $monitor['id']) }}'"
                                            class="relative inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-600 transition-colors hover:bg-slate-100 focus:outline-none active:bg-slate-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="icon icon-tabler icon-tabler-eye">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6
                                                                         c-3.6 0 -6.6 -2 -9 -6
                                                                         c2.4 -4 5.4 -6 9 -6
                                                                         c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </button>

                                        {{-- Botón editar (ejemplo) --}}
                                        <button
                                            class="relative inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-600 transition-colors hover:bg-slate-100 focus:outline-none active:bg-slate-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157
                                                                       3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513
                                                                       8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0
                                                                       00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25
                                                                       5.25 0 002.214-1.32l12.15-12.15z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="flex items-center justify-between border-t border-slate-100 p-4">
                <p class="text-sm text-slate-500">
                    Página 1 de 10
                </p>
                <div class="flex gap-2">
                    <button
                        class="inline-flex items-center justify-center rounded-md border border-slate-300 px-4 py-2 text-xs font-semibold text-slate-700 transition-colors hover:bg-slate-100 focus:outline-none active:bg-slate-200">
                        Anterior
                    </button>
                    <button
                        class="inline-flex items-center justify-center rounded-md border border-slate-300 px-4 py-2 text-xs font-semibold text-slate-700 transition-colors hover:bg-slate-100 focus:outline-none active:bg-slate-200">
                        Siguiente
                    </button>
                </div>
            </div>
        </div>

        {{-- Resumen de estado (sidebar) --}}
        <div class="relative flex h-56 w-3/12 flex-col rounded-lg bg-white p-6 text-slate-700 shadow-md">
            <h3 class="font-semibold">Current Status</h3>
            <div class="mt-6 flex items-center justify-around gap-4">
                <div class="flex flex-col items-center">
                    <span class="text-2xl font-semibold">0</span>
                    <span class="text-xs text-slate-500">Down</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-2xl font-semibold">2</span>
                    <span class="text-xs text-slate-500">Up</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-2xl font-semibold">1</span>
                    <span class="text-xs text-slate-500">Stopped</span>
                </div>
            </div>

            <p class="mt-6 text-center text-xs text-slate-500">
                Using 9 of 10 monitors
            </p>
        </div>

    </div>

@endsection
