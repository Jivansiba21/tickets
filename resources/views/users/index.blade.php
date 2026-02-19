@extends('layout.app')

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>All Users</h4>
        

            @if(Auth::user() && Auth::user()->role->role == 'admin')
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-end">
                    Create User
                </a>
            @endif
        </div>


    
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    
                    </tr>
                </thead>

                <tbody>
@foreach($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>

    <td>
        @if(auth()->user()->role->role == 'admin')

            
            <a href="{{ route('users.show', $user->id) }}" 
               class="btn btn-info btn-sm">
               View
            </a>

            
            <a href="{{ route('users.edit', $user->id) }}" 
               class="btn btn-warning btn-sm">
               Edit
            </a>

            
            <form action="{{ route('users.destroy', $user->id) }}" 
                  method="POST" 
                  style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="btn btn-danger btn-sm">
                        {{-- onclick="return confirm('Are you sure?')"> --}}
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

@endsection 
