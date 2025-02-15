@extends('mail.layout')

@section('title', 'Monitor Caído')

@section('content')
    <h1>¡Alerta: Monitor Caído!</h1>
    <p>
        Se ha detectado que el monitor en la siguiente URL se encuentra <strong>caído</strong>:
    </p>
    <p>
        <a href="{{ $url }}">{{ $url }}</a>
    </p>
    <p>
        Por favor, revisa el servicio lo antes posible para evitar mayores inconvenientes.
    </p>
@endsection
