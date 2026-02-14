@extends('layout.app')

@section('content')

<div class="container mt-4">

    <div class="card-header">
            <h4>All Agents</h4>
            

            @if(Auth::user() && Auth::user()->role->role == 'admin')
                <a href="{{ route('agents.create') }}" class="btn btn-primary btn-sm float-end">
                    Create Agent
                </a>
            @endif
        </div>


    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            
            </tr>
            @endforeach
        </tbody>
    </table>


    <a href="{{ route('agents.create') }}" class="btn btn-secondary mb-3">
            Back
        </a>

</div>

@endsection
