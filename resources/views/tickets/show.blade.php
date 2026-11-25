<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div>
@extends('layouts.app')
@section('title', $ticket->name)
@section('content')
<article class="ticket">
<h1>{{ $ticket->name }}</h1>
<p><strong>Topic:</strong> {{ $ticket->topic }}</p>
<p><strong>Description:</strong> {{ $ticket->description }}</p>
<p><strong>Submitted:</strong> {{ $ticket->created_at->diffForHumans() }}</p>
</article>
<a href="{{ route('tickets.index') }}">Back to queue</a>
@endsection
