@extends('auth.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">LOGIN</h3>
                    </div>

                    <form method="POST" action="{{route('login')}}">
                        @csrf
                    
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif   

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <input type="email" class="form-control bg-light @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email') }}" placeholder="">
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-light @error('password') is-invalid @enderror" 
                                id="password" name="password" placeholder="">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid shadow-sm">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold">Login</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted small">New user? <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Register here</a></p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <a href="{{ route('senaraiBuku') }}" class="text-muted small"><i class="bi bi-arrow-left"></i> Back to Home</a>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(90deg,rgba(87, 199, 133, 1) 44%, rgba(94, 235, 91, 1) 88%);
        min-height: 100vh;
    }
    .card {
        transition: transform 0.3s ease;
    }
    .btn-primary {
        background-color: #4e73df;
        border: none;
    }
    .btn-primary:hover {
        background-color: #2e59d9;
        transform: translateY(-1px);
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #4e73df;
    }
</style>

@endsection