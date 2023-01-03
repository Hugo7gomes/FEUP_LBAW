@extends('layouts.app')
@section('Dashboard')
@section('content')

<link href="{{ asset('css/ban.css') }}" rel="stylesheet">

<main>
<h1>Behavior History:</h1>
    <table>
        <thead>
            <tr>
                <th>Block Date</th>
                <th>Block Reason</th>
                <th>Username Blocked</th>
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