@extends('layout.app')

@section('content')

<div class="container mt-4">

    <h4>Create User</h4>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

    
        <button type="submit" class="btn btn-primary mb-3">
            Save User
        </button>

        
    </form>

</div>

@endsection
