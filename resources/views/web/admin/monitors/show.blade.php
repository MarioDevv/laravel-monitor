@extends('web.admin.layouts.master')

@section('title', 'Monitores')

@section('content')

    <div class="mb-6 flex flex-row justify-between gap-2">
        @include('web.admin.monitors.subviews.show.header', ['formattedMonitor' => $formattedMonitor])
        @include('web.admin.monitors.subviews.show.actions', ['formattedMonitor' => $formattedMonitor])
    </div>

    <div class="flex flex-col gap-4">

        {{-- Tarjetas de estado --}}
        @include('web.admin.monitors.subviews.show.status-cards', [
            'formattedMonitor' => $formattedMonitor,
        ])

        {{-- Gráfico de tiempos de respuesta --}}
        @include('web.admin.monitors.subviews.show.response-time-chart', [
            'formattedMonitor' => $formattedMonitor,
        ])

        {{-- Tabla de incidencias --}}
        @include('web.admin.monitors.subviews.show.incidents-table', [
            'formattedMonitor' => $formattedMonitor,
        ])

    </div>

@endsection
