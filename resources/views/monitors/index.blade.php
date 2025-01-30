@extends('layouts.master')

@section('title', 'Monitores')

@section('content')

    <div class="mb-3 mt-1 flex w-full items-center justify-between pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800">
                Monitors
            </h3>
            <p class="text-slate-500">
                List of all monitors
            </p>
        </div>
        <div class="ml-3">
            <div class="relative w-full min-w-[200px] max-w-sm">
                <div class="relative">
                    <input
                        class="ease h-10 w-full rounded border border-slate-200 bg-transparent bg-white py-2 pl-3 pr-11 text-sm text-slate-700 shadow-sm transition duration-200 placeholder:text-slate-400 hover:border-slate-400 focus:border-slate-400 focus:shadow-md focus:outline-none"
                        placeholder="Search..." />
                    <button class="absolute right-1 top-1 my-auto flex h-8 w-8 items-center rounded bg-white px-2"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="currentColor" class="h-8 w-8 text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de monitores -->
    <div class="relative flex w-full flex-col rounded-lg bg-white bg-clip-border text-gray-700 shadow-md">
        <table class="w-full min-w-max table-auto text-left">
            <thead>
                <tr>
                    <!-- Columna para el dot de estado -->
                    <th class="border-b border-slate-200 bg-slate-50 p-4">
                    </th>
                    <!-- Columna URL -->
                    <th class="border-b border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-normal leading-none text-slate-500">
                            Url
                        </p>
                    </th>
                    <!-- Columna Last Checked -->
                    <th class="border-b border-slate-200 bg-slate-50 p-4">
                        <p class="text-sm font-normal leading-none text-slate-500">
                            Last Checked
                        </p>
                    </th>

                    <!-- Columna Actions -->
                    <th class="border-b border-slate-200 bg-slate-50 p-4">
                    </th>

                </tr>
            </thead>
            <tbody>
                @if (count($mappedMonitors) > 0)
                    @foreach ($mappedMonitors as $monitor)
                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                            <!-- Dot de estado -->
                            <td class="p-4 py-5">
                                <div class="flex items-center">
                                    <span
                                        class="@if ($monitor['status'] === 1) bg-green-500
                                        @elseif($monitor['status'] === 2) bg-red-500
                                        @elseif($monitor['status'] === 3) bg-yellow-500
                                        @else bg-gray-400 @endif mr-2 inline-block h-4 w-4 animate-pulse rounded-full"></span>
                                </div>
                            </td>

                            <!-- URL -->
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-500">
                                    {{ $monitor['url'] }}
                                </p>
                            </td>

                            <!-- Última revisión -->
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-500">
                                    {{ $monitor['lastCheck'] }}
                                </p>
                            </td>

                            <td class="relative p-4 py-5">
                                <div class="flex gap-1">


                                    <a href="{{ route('monitors.show', $monitor['id']) }}"
                                        class="rounded-md border border-transparent p-2.5 text-center text-sm text-slate-600 transition-all hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>

                                    <button
                                        class="rounded-md border border-transparent p-2.5 text-center text-sm text-slate-600 transition-all hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </button>



                                </div>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <!-- Mensaje si no se encuentran monitores -->
                    <tr>
                        <td class="p-4 py-5" colspan="4">
                            <p class="text-sm text-slate-500">
                                No monitors found.
                            </p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Paginación o footer de la tabla -->
        <div class="flex justify-end px-3 py-3">
            <div class="flex items-center gap-8">
                <button disabled
                    class="rounded-md border border-slate-300 p-2.5 text-center text-sm text-slate-600 shadow-sm transition-all hover:border-slate-800 hover:bg-slate-800 hover:text-white hover:shadow-lg focus:border-slate-800 focus:bg-slate-800 focus:text-white active:border-slate-800 active:bg-slate-800 active:text-white disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path fill-rule="evenodd"
                            d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <p class="text-slate-600">
                    Page <strong class="text-slate-800">1</strong> of&nbsp;<strong class="text-slate-800">10</strong>
                </p>

                <button
                    class="rounded-md border border-slate-300 p-2.5 text-center text-sm text-slate-600 shadow-sm transition-all hover:border-slate-800 hover:bg-slate-800 hover:text-white hover:shadow-lg focus:border-slate-800 focus:bg-slate-800 focus:text-white active:border-slate-800 active:bg-slate-800 active:text-white disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path fill-rule="evenodd"
                            d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
@endsection


<script></script>
