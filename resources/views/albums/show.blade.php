@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ $album->title }}</h1>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Artist:</strong> {{ $album->artist }}</p>
                <p><strong>Genre:</strong> {{ $album->genre }}</p>
                <p><strong>Release Year:</strong> {{ $album->release_year }}</p>
                <p><strong>Format:</strong> {{ $album->format }}</p>
                <p><strong>Notes:</strong></p>
                <p>{{ $album->notes }}</p>
            </div>
        </div>

        <h2>Listening Logs</h2>

        @if($album->listeningLogs->isEmpty())
            <div class="alert alert-info">
                No listening logs recorded for this album.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Listened At</th>
                            <th>Side/Tracks</th>
                            <th>Rating</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($album->listeningLogs as $log)
                            <tr>
                                <td>{{ $log->listened_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $log->side_tracks }}</td>
                                <td>{{ $log->rating }}</td>
                                <td>{{ $log->notes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="mt-4">
            <a href="{{ route('albums.edit', $album) }}" class="btn btn-secondary">Edit Album</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addListeningLogModal">
                Add Listening Log
            </button>
        </div>
    </div>

    <div class="modal fade" id="addListeningLogModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Listening Log</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('albums.listening-logs.store', $album) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="listened_at">Listened At</label>
                            <input type="date" name="listened_at" id="listened_at" class="form-control" required>
                             @error('listened_at')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="side_tracks">Side/Tracks</label>
                            <input type="text" name="side_tracks" id="side_tracks" class="form-control">
                            @error('side_tracks')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="rating">Rating</label>
                            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5">
                            @error('rating')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" class="form-control"></textarea>
                            @error('notes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Log</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection