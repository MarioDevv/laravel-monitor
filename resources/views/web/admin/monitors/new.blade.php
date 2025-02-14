@extends('web.admin.layouts.master')

@section('title', 'Nuevo monitor')

@section('content')

    <form method="POST" action="{{ route('monitors.store') }}">
        @csrf

        {{-- Encabezado con título y botón de volver --}}
        @include('web.admin.monitors.subviews.new.form-header')

        {{-- Primer bloque: Datos generales --}}
        @include('web.admin.monitors.subviews.new.form-general')

        {{-- Sección de notificaciones --}}
        @include('web.admin.monitors.subviews.new.form-notifications')

        {{-- Segundo bloque: Configuración de intervalos --}}
        @include('web.admin.monitors.subviews.new.form-intervals')

        {{-- Botón de envío --}}
        @include('web.admin.monitors.subviews.new.form-submit')

    </form>

@endsection


