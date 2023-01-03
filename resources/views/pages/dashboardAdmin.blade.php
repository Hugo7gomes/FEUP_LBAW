@extends('layouts.app')
@section('Dashboard')
@section('content')

<link href="{{ asset('css/ban.css') }}" rel="stylesheet">

<main>
<h1>Histórico de Comportamento:</h1>
    <table>
        <thead>
            <tr>
                <th>Data de bloqueio</th>
                <th>Motivo do bloqueio</th>
                <th>Username bloqueado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bans as $ban)
            <tr>
                <td>{{ $ban->date }}</td>
                <td>{{ $ban->reason }}</td>
                <td><a href="../profile/{{$ban->username}}">{{ $ban->username }}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection