@extends('layout.app')

@section('content')
    <div class="container mt-4">

        <div class="row">

            <!-- Total Users -->
            <div class="col-md-4">
                <div class="card bg-primary mb-3">
                    <div class="card-body">
                        <h5 style="color:white;">Total Users</h5>
                        <h2 style="color:white;">{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>

            <!-- Total Agents -->
            <div class="col-md-4">
                <div class="card bg-success mb-3">
                    <div class="card-body">
                        <h5 style="color:white;">Total Agents</h5>
                        <h2 style="color:white;">{{ $totalAgents }}</h2>
                    </div>
                </div>
            </div>

            <!-- Total Tickets -->
            <div class="col-md-4">
                <div class="card bg-warning mb-3">
                    <div class="card-body">
                        <h5 style="color:white;">Total Tickets</h5>
                        <h2 style="color:white;">{{ $totalTickets }}</h2>
                    </div>
                </div>
            </div>

        </div>

        <!-- Graph -->
        <div class="card mt-4">
            <div class="card-header">
                <h5>Monthly Tickets Graph</h5>
            </div>
            <div class="card-body">
                <canvas id="ticketChart"></canvas>
            </div>
        </div>

    </div>
@endsection


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const ctx = document.getElementById('ticketChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                        label: 'Resolved Tickets',
                        data: @json($closedData),
                        backgroundColor: '#6f42c1'
                    },
                    {
                        label: 'Open/Ongoing Tickets',
                        data: @json($openedData),
                        backgroundColor: '#ff6384'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

    });
</script>
