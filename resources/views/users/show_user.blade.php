@extends('layout.app')

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Agent Details</h4>
        </div>

        <div class="card-body">

            <div class="mb-3">
                <strong>ID:</strong>
                <p>{{ $agent->id }}</p>
            </div>

            <div class="mb-3">
                <strong>Name:</strong>
                <p>{{ $agent->name }}</p>
            </div>

            <div class="mb-3">
                <strong>Email:</strong>
                <p>{{ $agent->email }}</p>
            </div>

            
            <a href="{{ route('agents.index') }}" 
               class="btn btn-secondary">
               Back
            </a>

        </div>
    </div>
</div>

@endsection
