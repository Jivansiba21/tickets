@extends('layout.app')

@section('content')

<div class="container mt-4">
    <div class="row">

        <!-- My Tickets -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5>My Tickets</h5>
                    <h2>{{ $myTicketsCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Ongoing -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5>Ongoing Tickets</h5>
                    <h2>{{ $ongoingCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Closed -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5>Closed Tickets</h5>
                    <h2>{{ $closedCount }}</h2>
                </div>
            </div>
        </div>

    </div>

        <div class="card mt-4">
    <div class="card-header">
        <h5>Latest Tickets</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ticket</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestTickets as $ticket)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-ticket-perforated-fill text-primary"></i>
                                    <span>{{ $ticket->id }}</span>
                                </div>
                            </td>

                            <td>
                                <div>
                                    <h6 class="mb-0">{{ $ticket->title }}</h6>
                                </div>
                            </td>

                            <td>
                                @if($ticket->status == 'open')
                                    <span class="badge bg-success">Open</span>
                                @elseif($ticket->status == 'in_progress')
                                    <span class="badge bg-warning text-dark">Processing</span>
                                @else
                                    <span class="badge bg-danger">Closed</span>
                                @endif
                            </td>

                            <td>{{ $ticket->date }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No tickets found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>




@endsection
