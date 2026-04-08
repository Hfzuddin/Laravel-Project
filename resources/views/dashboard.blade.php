<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <p class="fs-3">Dashboard, <strong>{{ auth()->user()->name }}</strong>!</p>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger shadow-sm">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
        </form>
    </div>
    <hr class="mb-3">
    <div class="row g-4 mb-3">
        <div class="col-md-4">
            <div class="card bg-primary text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Total Books</h6>
                        <h2 class="mb-0">{{ $totalBooks }}</h2>
                    </div>
                    <i class="fas fa-users stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Total Users</h6>
                        <h2 class="mb-0">{{ $totalUsers }}</h2>
                    </div>
                    <i class="fas fa-dollar-sign stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Total Authors</h6>
                        <h2 class="mb-0">{{ $totalAuthors }}</h2>
                    </div>
                    <i class="fas fa-tasks stat-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col">
            <div class="card p-4">
                <a href="{{ route('senaraiBuku') }}" class="fw-bold mb-4">List Books</a>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Authors</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($senaraiBuku as $book)
                            <tr>
                                <td>{{ ($senaraiBuku->currentPage() - 1) * $senaraiBuku->perPage() + $loop->iteration }}</td>
                                <!-- untuk tekan link -->
                                <td><p>{{$book->title}}</p></td>
                                <td>
                                    <ol class="mb-0">
                                        @foreach($book->authors as $author)
                                            <li class="mb-0"><p >{{ $author->name }}</p></li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>RM {{$book->price}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- untuk pagination page -->
                <div class="d-flex mt-3">
                    {{ $senaraiBuku->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body { background-color: #f8f9fa; }
    .card { border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    .stat-icon { font-size: 2rem; opacity: 0.3; }
</style>
</body>
</html>