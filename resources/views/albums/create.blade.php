@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Add New Album</h1>

        <form action="{{ route('albums.store') }}" method="POST" class="form-horizontal">
            @csrf

            <div class="form-group mb-3">
                <label for="artist" class="col-md-4 control-label">Artist</label>
                <div class="col-md-6">
                    <input type="text" id="artist" name="artist" class="form-control" value="{{ old('artist') }}" required>
                    @error('artist')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

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
                <label for="genre" class="col-md-4 control-label">Genre</label>
                <div class="col-md-6">
                    <input type="text" id="genre" name="genre" class="form-control" value="{{ old('genre') }}">
                    @error('genre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="release_year" class="col-md-4 control-label">Release Year</label>
                <div class="col-md-6">
                    <input type="number" id="release_year" name="release_year" class="form-control" value="{{ old('release_year') }}">
                    @error('release_year')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="format" class="col-md-4 control-label">Format</label>
                <div class="col-md-6">
                    <select id="format" name="format" class="form-select">
                        <option value="vinyl" {{ old('format') == 'vinyl' ? 'selected' : '' }}>Vinyl</option>
                        <option value="cd" {{ old('format') == 'cd' ? 'selected' : '' }}>CD</option>
                        <option value="digital" {{ old('format') == 'digital' ? 'selected' : '' }}>Digital</option>
                    </select>
                    @error('format')
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
                    <button type="submit" class="btn btn-primary">Add Album</button>
                    <a href="{{ route('albums.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
