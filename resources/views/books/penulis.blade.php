@extends('template.main')

@section('content')

<div class="row mt-3 mb-3">
    <div class="col">
        <div class="card p-4 shadow-lg rounded-4">
            <div class="card-header">
                <div class="row">
                    <div class="col col-auto">
                        <a href="{{ url()->previous() }}" class=""><i class="fs-3 bi bi-arrow-left-square"></i></a>
                    </div>
                    <div class="col col-auto">
                        Books by <h3>{{ $penulis->name }}</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        @if($penulis->books->count()<1 )
                            <em>No books found for this author.</em>
                        @else
                            <ol>
                                @foreach($penulis->books as $book)
                                    <li><a class="text-dark-emphasis link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('satu', $book->id) }}">{{ $book->title }}</a></li>
                                @endforeach
                            </ol>
                        @endif
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
</style>

@endsection