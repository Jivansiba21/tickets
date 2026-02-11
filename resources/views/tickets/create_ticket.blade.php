@extends('layout.app')

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Create Ticket</h4>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Priority</label>
                    <select name="priority" class="form-control">
                        <option value="">Select Priority</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">
                    Create Ticket
                </button>

            </form>
        </div>
    </div>
</div>

@endsection
