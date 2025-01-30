@php use Carbon\Carbon; @endphp

@extends('layouts.master')

@section('title', 'Monitores')

@section('content')

    <div class="flex w-full gap-4">

        <div class="relative flex h-full w-full flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
            <div class="relative mx-4 mt-4 overflow-hidden rounded-none bg-white bg-clip-border text-gray-700">
                <div class="flex flex-row items-center justify-end p-4">
                    <div class="block w-full md:w-72">
                        <div class="relative h-10 w-full min-w-[200px]">
                            <div
                                class="absolute right-3 top-2/4 grid h-5 w-5 -translate-y-2/4 place-items-center text-blue-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </div>
                            <input
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute -top-1.5 left-0 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mr-1 before:mt-[6.5px] before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-l before:border-t before:border-blue-gray-200 before:transition-all after:pointer-events-none after:ml-1 after:mt-[6.5px] after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-r after:border-t after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-l-2 peer-focus:before:border-t-2 peer-focus:before:!border-gray-900 peer-focus:after:border-r-2 peer-focus:after:border-t-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Search
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-scroll px-0">
                <table class="mt-4 w-full min-w-max table-auto text-left">
                    <thead>

                    </thead>
                    <tbody>
                        @foreach ($monitors as $key => $monitor)
                            @php
                                // Definir colores y etiquetas según el estado
                                $statusConfig = match ($monitor['status']) {
                                    1 => [
                                        'color' => 'bg-green-500',
                                        'text' => 'Online',
                                        'textColor' => 'text-green-900',
                                        'bgOpacity' => 'bg-green-500/20',
                                    ],
                                    2 => [
                                        'color' => 'bg-red-500',
                                        'text' => 'Down',
                                        'textColor' => 'text-red-900',
                                        'bgOpacity' => 'bg-red-500/20',
                                    ],
                                    3 => [
                                        'color' => 'bg-yellow-500',
                                        'text' => 'Stopped',
                                        'textColor' => 'text-yellow-900',
                                        'bgOpacity' => 'bg-yellow-500/20',
                                    ],
                                };
                            @endphp

                            <tr class="border-t border-blue-gray-50">
                                <td class="border-b border-blue-gray-50 p-4">
                                    <div class="relative flex items-center gap-4">

                                        <span
                                            class="{{ $statusConfig['color'] }} absolute h-5 w-5 animate-ping rounded-full opacity-75"></span>
                                        <span class="{{ $statusConfig['color'] }} relative h-5 w-5 rounded-full"></span>



                                        <div class="flex flex-col">
                                            <p
                                                class="block font-sans text-sm font-normal leading-normal text-blue-gray-900 antialiased">
                                                {{ $monitor['friendlyName'] }}
                                            </p>
                                            <p
                                                class="block font-sans text-sm font-normal leading-normal text-blue-gray-900 antialiased opacity-70">
                                                {{ $monitor['url'] }}

                                            </p>
                                        </div>

                                    </div>

                                </td>
                                <td class="border-b border-blue-gray-50 p-4">
                                    <div class="flex items-center gap-3">

                                        <!-- Status escrito -->
                                        <div class="w-max">
                                            <div
                                                class="{{ $statusConfig['bgOpacity'] }} {{ $statusConfig['textColor'] }} relative grid select-none items-center whitespace-nowrap rounded-md px-2 py-1 font-sans text-xs font-bold uppercase">
                                                <span>{{ $statusConfig['text'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-b border-blue-gray-50 p-4">
                                    <p
                                        class="block font-sans text-sm font-normal leading-normal text-blue-gray-900 antialiased">
                                        {{ Carbon::parse($monitor['lastCheck'])->format('d/m/Y H:i') }}
                                    </p>
                                </td>
                                <td class="border-b border-blue-gray-50 p-4">

                                    <button onclick="window.location.href = '{{ route('monitors.show', $monitor['id']) }}'"
                                        class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        <span class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </span>
                                    </button>

                                    <button
                                        class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        <span class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                aria-hidden="true" class="h-4 w-4">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
            <div class="flex items-center justify-between border-t border-blue-gray-50 p-4">
                <p class="block font-sans text-sm font-normal leading-normal text-blue-gray-900 antialiased">
                    Page 1 of 10
                </p>
                <div class="flex gap-2">
                    <button
                        class="select-none rounded-lg border border-gray-900 px-4 py-2 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        Previous
                    </button>
                    <button
                        class="select-none rounded-lg border border-gray-900 px-4 py-2 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <div class="relative flex h-56 w-3/12 flex-col rounded-lg bg-white shadow-md">
            <div class="p-6">
                Current Status

                <div class="mt-8 flex items-center justify-around gap-4">

                    <div class="flex flex-col items-center">
                        <span class="text-2xl">0</span>
                        <span class="text-xs text-gray-600">Down</span>
                    </div>


                    <div class="flex flex-col items-center">
                        <span class="text-2xl">2</span>
                        <span class="text-xs text-gray-600">Up</span>
                    </div>

                    <div class="flex flex-col items-center">
                        <span class="text-2xl">1</span>
                        <span class="text-xs text-gray-600">Stopped</span>
                    </div>
                </div>

                <span class="mt-8 flex justify-center text-xs text-gray-600">
                    Using 9 of 10 monitors
                </span>
            </div>

        </div>

    </div>

@endsection


<script></script>
