@extends('web.admin.layouts.master')

@section('title', 'Monitores')

@section('content')
    <div class="flex w-full gap-4">

        {{-- Contenedor principal de la tabla --}}
        <div class="relative flex h-full w-full flex-col rounded-xl bg-white text-slate-700 shadow-md">

            {{-- Barra de búsqueda --}}
            @include('web.admin.monitors.subviews.index.search')

            {{-- Tabla de monitores --}}
            @include('web.admin.monitors.subviews.index.table')

            {{-- Paginación --}}
            @include('web.admin.monitors.subviews.index.pagination')

        </div>

        {{-- Resumen de estado (sidebar) --}}
        @include('web.admin.monitors.subviews.index.status-summary')

    </div>
@endsection
