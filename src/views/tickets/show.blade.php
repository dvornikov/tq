@extends('tq::layouts.app')

@section('content')
    <h2>{{ $ticket->name }}</h2>
    <h3>{{ $ticket->email }}</h3>
    <div class="">
        {{ $ticket->description }}
    </div>

    <ul>
        @foreach( $ticket->files as $file )
            <li><a href="{{ route('files.get', ['filename' => $file->filename]) }}">{{ $file->filename }}</a></li>
        @endforeach
    </ul>
@endsection
