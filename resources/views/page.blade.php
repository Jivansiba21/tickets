@extends('layout.app')

@section('content')

<div class="container mt-4">
    {{-- <h3 class="mb-4">Admin Dashboard</h3> --}}

    <div class="row">

        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h2>{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Agents -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5>Total Agents</h5>
                    {{-- <h2>{{ $totalAgents }}</h2> --}}
                </div>
            </div>
        </div>

        <!-- Total Tickets -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5>Total Tickets</h5>
                    <h2>{{ $totalTickets }}</h2>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
