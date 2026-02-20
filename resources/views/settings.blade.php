@extends('layout.app')

@section('content')


<div class="container mt-4">
    <h4>Settings</h4>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Site Name</label>
            <input type="text" name="site_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Admin Email</label>
            <input type="email" name="admin_email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>

@endsection