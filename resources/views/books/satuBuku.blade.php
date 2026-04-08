@extends('template.main')

@section('content')

<div class="row mt-3 mb-3">
    <div class="col">
        <div class="card p-4 shadow-lg rounded-4">
            <div class="card-header">
                <div class="row">
                    <div class="col col-auto">
                        <a href="{{ route('senaraiBuku') }}" class=""><i class="fs-3 bi bi-arrow-left-square"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <h3 class="mb-4">{{ $buku->title }}</h3>
                    <div class="col-4">
                        <div class="image-container">
                            <img src="https://placehold.co/400x470" alt="" class="img-fluid">
                            <div class="overlay-button">
                                @php
                                    $isBookmarked = isset(session('bookmarks')[$buku->id]);
                                @endphp
                                <a href="{{ route('saveBookmarks', $buku->id) }}" class="">
                                    <i class="bi {{ $isBookmarked ? 'bi bi-bookmark-dash-fill text-warning' : 'bi bi-bookmark-plus text-warning' }} fs-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <p><strong>Price</strong></p>
                        RM {{ $buku->price }}
                        <p>&nbsp;</p>

                        <p><strong>Synopsis</strong></p>
                        {{ nl2br($buku->synopsis) }}
                        <p>&nbsp;</p>    

                        <p><strong>Authors</strong></p>
                        <ol>
                            @foreach($buku->authors as $author)
                                <li><a class="text-dark-emphasis link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('satuPenulis', $author->id) }}">{{ $author->name }}</a></li>
                            @endforeach
                        </ol>
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
    .image-container {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .image-container img {
        transition: transform 0.4s ease, filter 0.4s ease;
    }

    .image-container:hover img {
        filter: brightness(70%);
        transform: scale(1.05);
    }

    .overlay-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -20%); 
        opacity: 0;
        transition: all 0.4s ease;
        pointer-events: none; 
    }

    .image-container:hover .overlay-button {
        opacity: 1;
        transform: translate(-50%, -50%); 
        pointer-events: auto;
    }

    .overlay-button .btn {
        padding: 10px 20px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>
@endsection