@extends('auth.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-5">
                        <h3 class="fw-bold">REGISTER ACCOUNT</h3>
                    </div>

                    <form method="POST" action="{{route('register')}}">
                        @csrf
                    
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Please check your input below.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif   

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control bg-light @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" placeholder="">
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

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

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-light @error('password') is-invalid @enderror" 
                                id="password" name="password" placeholder="">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-light @error('password_confirmation') is-invalid @enderror" 
                                id="password_confirmation" name="password_confirmation" placeholder="">
                            </div>
                        </div>

                        <div class="d-grid shadow-sm">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold">Register Now</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted small">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary">Login here</a></p>
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
        border-radius: 1rem;
    }
    .input-group-text {
        color: #6c757d;
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: none;
        background-color: #fff !important;
    }
    .btn-primary {
        background-color: #4e73df;
        border: none;
        padding: 12px;
    }
    .btn-primary:hover {
        background-color: #2e59d9;
        transform: translateY(-1px);
        transition: 0.2s;
    }
</style>
@endsection