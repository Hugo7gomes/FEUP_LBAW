@extends('layouts.app')
@section('Dashboard')
@section('content')

<link href="{{ asset('css/ban.css') }}" rel="stylesheet">

<main>
    <table>
        <h1>Histórico de Comportamento:</h1>
        <thead>
            <tr>
                <th>Data de bloqueio</th>
                <th>Motivo do bloqueio</th>
                <th>Username bloqueado</th>
                <th>Desbloquear</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bans as $ban)
            <tr>
                <td>{{ $ban->date }}</td>
                <td>{{ $ban->reason }}</td>
                <td><a href="../profile/{{$ban->username}}">{{ $ban->username }}</a></td>
                <td><button class="unblock-button">Desbloquear</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection