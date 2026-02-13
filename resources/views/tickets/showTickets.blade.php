@extends('layout.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Ticket Details</h4>
    </div>

    <div class="card-body">
        <p><strong>ID:</strong> {{ $ticket->id }}</p>
        <p><strong>Title:</strong> {{ $ticket->title }}</p>
        <p><strong>Description:</strong> {{ $ticket->description }}</p>

    @if(auth()->user()->role->role == 'admin')
        <p><strong>User ID:</strong> {{ $ticket->user_id }}</p>
        <p><strong>Agent ID:</strong> {{ $ticket->agent_id }}</p>
    @endif

        <p><strong>Priority:</strong> {{ $ticket->priority }}</p>
        <p><strong>Date:</strong> {{ $ticket->date }}</p>

        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>
</div>

@endsection
