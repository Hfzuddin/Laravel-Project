@extends('template.main')

@section('content')

<div class="row mt-3 mb-3">
    <div class="col">
        <div class="card p-4 shadow-lg rounded-4">
            <div class="card-header">
                <div class="row mt-3 mb-2">
                    <!-- check sebarang error pada input -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            Please check your input again
                        </div>
                    @endif

                    <div class="col col-auto">
                        <a href="{{ route('senaraiBuku') }}" class=""><i class="fs-3 bi bi-arrow-left-square"></i></a>
                    </div>
                    <div class="col col-auto">
                        <h3>Add New Book</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('simpanBuku') }}" method="POST">
                <!-- @csrf avoid hijack from outsider -->
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <!-- untuk display error jika required -->
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price')}}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="synopsis" class="form-label">Synopsis</label>
                        <textarea class="form-control @error('synopsis') is-invalid @enderror" id="synopsis" name="synopsis">{{ old('synopsis') }}</textarea>
                        @error('synopsis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="author_name" class="form-label">Author</label>
                        <input class="form-control  @error('author') is-invalid @enderror" list="authorOptions" id="author_name" name="author" placeholder="Type to search or add new...">
                        @error('author')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <datalist id="authorOptions">
                            @foreach($authors as $author)
                                <option value="{{ $author->name }}">
                            @endforeach
                        </datalist>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success mb-2">Submit</button>
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