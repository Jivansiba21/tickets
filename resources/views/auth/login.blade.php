@extends('layout.app')

@section('content')

<div class="container">
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Login</title>
            <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        </head>
        <body class="bg-light">

        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-md-4">

                    <div class="card shadow">
                        <div class="card-header text-center">
                            <h4>Login</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('login.post')  }}" method="POST">
                                @csrf

                                
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                                </div><br>

                                
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                                </div><br>

                            
                                <div class="d-grid">
                                    <button class="btn btn-primary">Login</button>
                                </div>
                                @if (session('error'))
    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
@endif
                                
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html> 
</div>

@endsection

