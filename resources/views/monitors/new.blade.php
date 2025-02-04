@extends('layouts.master')

@section('title', 'Nuevo monitor')

@section('content')

    <div class="flex justify-between">

        <h2 class="text-2xl font-semibold text-slate-800">
            New Monitor
        </h2>

        <a
            href="{{ route('monitors.index') }}"
            class="rounded-md border border-transparent bg-slate-800 px-4 py-2 text-center text-sm text-white shadow-md transition-all hover:bg-slate-700 hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            data-ripple-light="true"
            type="button"
        >
            Volver
        </a>
    </div>

    <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-full p-6">

        <div>

            <label class="block mb-2 text-sm text-slate-800">
                <b>Monitor type</b>
            </label>

            <div class="relative">
                <select
                    disabled
                    class="pointer-events-none opacity-50 w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                    <option value="curl">Curl</option>
                    <option value="ping">Ping</option>
                    <option value="port">Port</option>
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                     stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                </svg>
            </div>
        </div>

        <hr class="my-5">

        <div class="w-full">

            <div>
                <label class="block mb-2 text-sm text-slate-800">
                    <b>URL to monitor</b>
                </label>
                <input
                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                    placeholder="http(s)://"/>
            </div>

        </div>

        <hr class="my-5">

        <div>



        </div>

    </div>

@endsection
