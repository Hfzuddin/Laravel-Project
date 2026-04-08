@extends('template.main')

@section('content')
<div class="container mt-3 mb-3">
    <div class="row mt-1 mb-2 justify-content-between">
        <div class="col-6 mt-2">
            <h2 class="fw-bold">
                <i class="bi bi-people-fill text-warning fs-1 me-3"></i> AUTHORS LISTING
            </h2>
        </div>
        <div class="col-6 d-flex justify-content-end align-items-center gap-3">
            <a href="{{ route('senaraiBuku') }}" class=""><i class="fs-3 bi bi-arrow-left-square"></i></a>
        </div>
    </div>
    
    <!-- <div class="d-flex justify-content-between align-items-center mb-4">
        @auth
            <a href="#" class="btn btn-warning shadow-sm">
                <i class="bi bi-person-plus-fill"></i> Tambah Penulis
            </a>
        @endauth
    </div> -->

    <div class="row g-4">
        @forelse($penulis as $author)
            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm h-100">
                    <div class="author-info p-4 text-center">
                        <div class="avatar-circle mb-3 mx-auto">
                            <span class="fs-2 fw-bold text-success">
                                {{ strtoupper(substr($author->name, 0, 1)) }}
                            </span>
                        </div>
                        
                        <h5 class="fw-bold mb-1">{{ $author->name }}</h5>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-book me-1"></i> {{ $author->books->count() }} Books
                        </p>
                        
                        <hr class="opacity-10">
                        
                        <a href="{{ route('satuPenulis', $author->id) }}" class="btn btn-yik-outline w-100 rounded-pill">
                            See More <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-white">
                <i class="bi bi-person-x display-1 opacity-25"></i>
                <p class="mt-3">Tiada penulis dijumpai dalam sistem.</p>
            </div>
        @endforelse
        <div class="mt-5 d-flex justify-content-center">
            {{ $penulis->links() }}
        </div>
    </div>
</div>
<style>
    /* body {
        background: linear-gradient(90deg,rgba(87, 199, 133, 1) 44%, rgba(94, 235, 91, 1) 88%);
        min-height: 100vh;
    } */

    .card {
        border-radius: 20px;
        border: 2px solid #717573;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.3) !important;
    }

    .avatar-circle {
        width: 70px;
        height: 70px;
        background-color: #f1f8f4;
        border: 2px solid #004d26;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .card:hover .avatar-circle {
        background-color: #2ca368;
    }

    .card:hover .avatar-circle span {
        color: #131002 !important; 
    }

    .btn-yik-outline {
        border: 1px solid #717573;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-yik-outline:hover {
        background-color: #2ca368;
    }
</style>

@endsection