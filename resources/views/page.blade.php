@extends('layout.app')

@section('content')

    @if (session('message'))
        <div class="text-success">
            {{ session('message') }} 
        </div>       
    @endif
    
<div class="row">

    <!-- My Tickets -->
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">My Tickets</h5>
                {{-- <h2>{{ $myTicketsCount }}</h2> --}}
            </div>
        </div>
    </div>

    <!-- Ongoing -->
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Ongoing Tickets</h5>
                {{-- <h2>{{ $ongoingCount }}</h2> --}}
            </div>
        </div>
    </div>

    <!-- Closed -->
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Closed Tickets</h5>
                {{-- <h2>{{ $closedCount }}</h2> --}}
            </div>
        </div>
    </div>

</div>

@endsection

@section('title')
    home
@endsection


    
