@extends('layout.app')

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>All Tickets</h4>
            

            @if(Auth::user() && Auth::user()->role->role == 'admin')
                <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm float-end">
                    Create Ticket
                </a>
            @endif
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Date</th>
                        

                        @if(Auth::user() && Auth::user()->role->role == 'admin')
                            <th>User ID</th>
                            <th>Agent ID</th>
                        @endif

                        <th>Actions</th> 
                    </tr>
                </thead>

                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td>{{ $ticket->description }}</td>
                            <td>{{ $ticket->priority }}</td>

                            <td>

                                @if(Auth::user()->role->role == 'admin')
                                <form action="{{ route('tickets.status',$ticket->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="form-control">
                                        <option value="open" {{ $ticket->status=='open'?'selected':'' }}>Open</option>
                                        <option value="in_progress" {{ $ticket->status=='in_progress'?'selected':'' }}>Processing</option>
                                        <option value="closed" {{ $ticket->status=='closed'?'selected':'' }}>Closed</option>
                                    </select>
                                </form>
                                @else

                                    @if($ticket->status == 'open')
                                        <span class="badge bg-success">Open</span>
                                    @elseif($ticket->status == 'in_progress')
                                        <span class="badge bg-warning">Processing</span>
                                    @else
                                        <span class="badge bg-danger">Closed</span>
                                    @endif
                                @endif
                            </td>


                            <td>{{ $ticket->date }}</td>

                            <td>{{ $ticket->date }}</td>

                            @if(Auth::user() && Auth::user()->role->role == 'admin')
                        
                                <td>{{ $ticket->user_id }}</td>
                                <td>{{ $ticket->agent_id }}</td>
                            @endif

                            <td>

                            
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info">
                                    View
                                </a>

                                
                                <a href="{{ route('tickets.chat', $ticket->id) }}" class="btn btn-secondary">Message</a>


                                
                                @if(Auth::user() && Auth::user()->role->role == 'admin')
                                

                                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>

                                @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
