@extends('layout.app')

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>All Tickets</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Date</th>
                    @if(auth()->user()->role == 'admin')
                        <th>User ID</th>
                        <th>Agent ID</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td>{{ $ticket->description }}</td>
                            <td>{{ $ticket->priority }}</td>
                            <td>{{ $ticket->date }}</td>

                        @if(auth()->user()->role == 'admin')
                            <td>{{ $ticket->user_id }}</td>
                            <td>{{ $ticket->agent_id }}</td>
                        @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
