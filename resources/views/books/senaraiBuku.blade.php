@extends('template.main')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card p-4 shadow-lg rounded-4">
                <!-- untuk papar jika berjaya -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card-header">
                    <div class="row mt-1 justify-content-between">
                        <div class="col-6 mt-2">
                            <h4>BOOKS LISTING</h4>
                        </div>
                        <div class="col-6 d-flex justify-content-end align-items-center gap-3">
                            <a href="{{ route('showBookmarks') }}" class="position-relative bookmark-container">
                                <i class="bi bi-bookmark-heart-fill text-warning fs-2 icon-hover"></i>
                                <i class="bi bi-bookmark-heart text-warning fs-2 icon-default"></i>
                                @if(session('bookmarks') && count(session('bookmarks')) > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                        {{ count(session('bookmarks')) }}
                                    </span>
                                @endif
                            </a>
                            <a href="{{ route('penulis') }}" class="btn btn-outline-primary"><i class="bi bi-eye-fill"></i> Authors</a>
                            @auth()
                            <a href="{{ route('addBuku') }}" class="btn btn-outline-success"><i class="fa-solid fa-circle-plus"></i> Book</a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-sm border-secondary table-striped table-hover">
                        <thead class="">
                            <th>ID</th>
                            <th>TITLE</th>
                            <th>AUTHOR</th>
                            <th>PRICE</th>
                            @auth()
                            <th>EDIT</th>
                            <th>DELETE</th>
                            @endauth
                        </thead>
                        <tbody class="table-group-divider">
                            @forelse($search as $book)
                            <tr>
                                <td>{{ ($search->currentPage() - 1) * $search->perPage() + $loop->iteration }}</td>
                                <!-- untuk tekan link -->
                                <td><a class="text-dark-emphasis link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('satu', $book->id) }}" >{{$book->title}}</a></td>
                                <td>
                                    <ol>
                                        @foreach($book->authors as $author)
                                        <li><a class="text-dark-emphasis link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('satuPenulis', $author->id) }}">{{ $author->name }}</a></li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td class="fw-bold text-success">RM {{ number_format($book->price, 2) }}</td>
                                @auth()
                                <td><a class="btn btn-sm btn-outline-primary" href="{{route('editBuku', $book->id)}}"><i class="bi bi-pencil-square"></i></a></td>
                                <td>
                                    <form action="{{ route('deleteBuku', $book->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this {{$book->title}}?')"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                                @endauth 
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Tiada buku dijumpai untuk carian "{{ request('search') }}"
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row mt-2">
                        <div class="col d-flex justify-content-center">
                            {{ $search->links() }}
                            <!-- untuk pagination page -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <style>
        /* body {
            background: linear-gradient(90deg,rgba(87, 199, 133, 1) 44%, rgba(94, 235, 91, 1) 88%);
            min-height: 100vh;
        } */
        .bookmark-container {
            display: inline-block;
            text-decoration: none;
            transition: transform 0.2s ease;
        }

        .icon-hover {
            display: none;
        }

        .bookmark-container:hover .icon-default {
            display: none; 
        }

        .bookmark-container:hover .icon-hover {
            display: inline-block; 
            transform: scale(1.1); 
        }

        .bookmark-container:hover {
            transform: translateY(-2px);
        }
    </style>
@endsection