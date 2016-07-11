@extends('tq::layouts.app')

@section('content')
    <h2>{{ trans('tq::messages.tickets') }}:</h2>

    @if ( !$tickets->count() )
        У вас нет обращений
    @else
    <ul>
        @foreach( $tickets as $ticket )
            <li><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->name }}</a></li>
        @endforeach
    </ul>
    @endif
@endsection
