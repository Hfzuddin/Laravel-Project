@extends('template.main')

@section('content')
    <div class="row mt-3 mb-3">
        <div class="col">
            <div class="card p-4 shadow-lg rounded-4">
                <div class="card-header">
                    <div class="row mt-3 mb-2">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                
                        <!-- check sebarang error pada input -->
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            Please check your input again
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="col col-auto">
                            <a href="{{ route('senaraiBuku') }}" class=""><i class="fs-3 bi bi-arrow-left-square"></i></a>
                        </div>
                        <div class="col col-auto">
                            <h3 class="">Update Book Form</h3>
                        </div>
                    </div>
                </div>
                <form action="{{ route('updateBuku', $buku->id) }}" method="POST">
                    <!-- @csrf avoid hijack from outsider -->
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $buku->title }}">
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                        
                                        <!-- untuk display error jika required -->
                                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $buku->price }}">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="synopsis" class="form-label">Synopsis</label>
                                        <textarea class="form-control @error('synopsis') is-invalid @enderror" id="synopsis" name="synopsis">{{ $buku->synopsis }}</textarea>
                                        @error('synopsis')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <label class="form-label d-block fw-bold">Authors :</label>
                                        <div class="card p-2" style="max-height: 200px; overflow-y: auto;">
                                            @foreach($author as $author)
                                                <div class="form-check">
                                                    <input class="form-check-input" 
                                                        type="checkbox" 
                                                        name="author_id[]" 
                                                        value="{{ $author->id }}" 
                                                        id="author_{{ $author->id }}"
                                                        {{ $buku->authors->contains($author->id) ? 'checked' : '' }}>
                                                    
                                                    <label class="form-check-label" for="author_{{ $author->id }}">
                                                        {{ $author->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mt-3">
                                            <label for="new_author" class="form-label fw-bold">New Author :</label>
                                            <input type="text" name="new_author" class="form-control @error('new_author') is-invalid @enderror" placeholder="Enter author name....">
                                            <small class="text-muted">*Leave blank if there is no new author to add.</small>
                                            @error('new_author')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success mb-2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <style>
        /* body {
            background: linear-gradient(90deg,rgba(87, 199, 133, 1) 44%, rgba(94, 235, 91, 1) 88%);
            min-height: 100vh;
        } */

        .form-control:focus {
            box-shadow: none;
            border-color: #4e73df;
        }
    </style>   
@endsection