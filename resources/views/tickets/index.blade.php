@extends('layouts.app')
@section('title', 'Queue')
@section('content')
<h1>Help queue</h1>
<nav aria-label="Filter tickets by topic">
@foreach ($topics as $topic)
<a href="{{ route('tickets.index', ['topic' => $topic->name]) }}">{{ $topic->name }}</a>
@endforeach
</nav>
<h2>Being helped</h2>
@forelse ($helping as $ticket)
@include('tickets._card', ['ticket' => $ticket])
@empty
<p>Nobody right now.</p>
@endforelse
<h2>Waiting ({{ $waiting->count() }})</h2>
@forelse ($waiting as $ticket)
@include('tickets._card', ['ticket' => $ticket, 'position' => $loop->iteration])
@empty
<p>Nobody is waiting.</p>
@endforelse
<p>{{ $doneCount }} solved so far.</p>
@endsection