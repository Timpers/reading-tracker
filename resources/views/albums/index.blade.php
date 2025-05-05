@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">My Albums</h1>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('albums.create') }}" class="btn btn-primary">Add New Album</a>
        </div>

        @if($albums->isEmpty())
            <div class="alert alert-info">
                You haven't added any albums yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Artist</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Release Year</th>
                            <th>Format</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($albums as $album)
                            <tr>
                                <td>{{ $album->artist }}</td>
                                <td>{{ $album->title }}</td>
                                <td>{{ $album->genre }}</td>
                                <td>{{ $album->release_year }}</td>
                                <td>{{ $album->format }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('albums.show', $album) }}" class="btn btn-sm btn-primary">View</a>
                                        <a href="{{ route('albums.edit', $album) }}" class="btn btn-sm btn-secondary">Edit</a>
                                        <form action="{{ route('albums.destroy', $album) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this album?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection