@extends('layout.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Edit Ticket</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control"
                    value="{{ $ticket->title }}">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">
                    {{ $ticket->description }}
                </textarea>
            </div>

            <div class="mb-3">
                <label>Priority</label>
                <select name="priority" class="form-control">
                    <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control"
                    value="{{ $ticket->date }}">
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </form>
    </div>
</div>

@endsection
