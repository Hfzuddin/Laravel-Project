@extends('template.main')

@section('content')
<div class="row mt-3 mb-3">
    <div class="col">
        <div class="card p-4 shadow-lg rounded-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-header">
                <div class="row">
                    <div class="col col-auto mb-3">
                        <a href="{{ route('senaraiBuku') }}" class=""><i class="fs-3 bi bi-arrow-left-square"></i></a>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold">
                            <i class="bi bi-bookmark-heart-fill text-warning"></i> MY BOOKMARKS
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(count($bookmarks) > 0)
                    <table class="table align-middle table-responsive table-sm border-secondary table-striped table-hover">
                        <thead>
                            <th>ID</th>
                            <th>BOOK DETAILS</th>
                            <th>SYNOPSIS</th>
                            <th>PRICE</th>
                        </thead>
                        <tbody>
                            @foreach($bookmarks as $id => $details)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $details['image'] }}" alt="" class="rounded shadow-sm me-3" style="width: 60px; height: 80px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-0 fw-bold text-muted">{{ $details['title'] }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="">
                                    <p class="small text-muted text-truncate mb-0" style="max-width: 250px;">
                                        {{ $details['synopsis'] }}
                                    </p>
                                    <a href="{{ route('satu', $id) }}" class="small text-decoration-none">Read More</a>
                                </td>
                                <td class="fw-bold text-success">
                                    RM {{ number_format($details['price'], 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-bookmark-x display-1 text-muted opacity-25"></i>
                        <h4 class="mt-3 text-muted">Nothing in bookmarks</h4>
                        <a href="{{ route('senaraiBuku') }}" class="mt-3 px-4 text-decoration-none">Find now</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* body {
        background: linear-gradient(90deg,rgba(87, 199, 133, 1) 44%, rgba(94, 235, 91, 1) 88%);
        min-height: 100vh;
    } */
</style>
@endsection