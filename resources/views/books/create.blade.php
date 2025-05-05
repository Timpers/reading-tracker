@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Add New Book</h1>

        <form action="{{ route('books.store') }}" method="POST" class="form-horizontal">
            @csrf

            <div class="form-group mb-3">
                <label for="title" class="col-md-4 control-label">Title</label>
                <div class="col-md-6">
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="author" class="col-md-4 control-label">Author</label>
                <div class="col-md-6">
                    <input type="text" id="author" name="author" class="form-control" value="{{ old('author') }}" required>
                    @error('author')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="genre" class="col-md-4 control-label">Genre</label>
                <div class="col-md-6">
                    <input type="text" id="genre" name="genre" class="form-control" value="{{ old('genre') }}">
                    @error('genre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="publication_year" class="col-md-4 control-label">Publication Year</label>
                <div class="col-md-6">
                    <input type="number" id="publication_year" name="publication_year" class="form-control" value="{{ old('publication_year') }}">
                    @error('publication_year')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="pages" class="col-md-4 control-label">Pages</label>
                <div class="col-md-6">
                    <input type="number" id="pages" name="pages" class="form-control" value="{{ old('pages') }}">
                    @error('pages')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

             <div class="form-group mb-3">
                <label for="status" class="col-md-4 control-label">Status</label>
                <div class="col-md-6">
                    <select id="status" name="status" class="form-select">
                        <option value="to_read" {{ old('status') == 'to_read' ? 'selected' : '' }}>To Read</option>
                        <option value="currently_reading" {{ old('status') == 'currently_reading' ? 'selected' : '' }}>Currently Reading</option>
                        <option value="finished" {{ old('status') == 'finished' ? 'selected' : '' }}>Finished</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="started_at" class="col-md-4 control-label">Started At</label>
                <div class="col-md-6">
                    <input type="date" id="started_at" name="started_at" class="form-control" value="{{ old('started_at') }}">
                    @error('started_at')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="finished_at" class="col-md-4 control-label">Finished At</label>
                <div class="col-md-6">
                    <input type="date" id="finished_at" name="finished_at" class="form-control" value="{{ old('finished_at') }}">
                    @error('finished_at')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="rating" class="col-md-4 control-label">Rating</label>
                <div class="col-md-6">
                    <input type="number" id="rating" name="rating" class="form-control" min="1" max="5" value="{{ old('rating') }}">
                    @error('rating')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="notes" class="col-md-4 control-label">Notes</label>
                <div class="col-md-6">
                    <textarea id="notes" name="notes" class="form-control">{{ old('notes') }}</textarea>
                    @error('notes')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-4">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Add Book</button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
