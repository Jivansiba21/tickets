@extends('layout.app')

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Edit User</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('agents.update', $agent->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" 
                           name="name" 
                           class="form-control"
                           value="{{ old('name', $agent->name) }}" 
                           required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" 
                           name="email" 
                           class="form-control"
                           value="{{ old('email', $agent->email) }}" 
                           required>
                </div>

                <div class="mb-3">
                    <label>Password (leave blank to keep current password)</label>
                    <input type="password" 
                           name="password" 
                           class="form-control">
                </div>

            
                <button type="submit" class="btn btn-primary">
                    Update Agent
                </button>

                <a href="{{ route('agents.index') }}" 
                   class="btn btn-secondary">
                   Back
                </a>

            </form>

        </div>
    </div>
</div>

@endsection
