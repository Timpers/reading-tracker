@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ $book->title }}</h1>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p><strong>Genre:</strong> {{ $book->genre }}</p>
                <p><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
                <p><strong>Pages:</strong> {{ $book->pages }}</p>
                <p><strong>Status:</strong> {{ $book->status }}</p>
                <p><strong>Rating:</strong> {{ $book->rating }}</p>
                <p><strong>Started At:</strong> {{ $book->started_at ? $book->started_at->format('Y-m-d') : 'Not Started' }}</p>
                <p><strong>Finished At:</strong> {{ $book->finished_at ? $book->finished_at->format('Y-m-d') : 'Not Finished' }}</p>
                <p><strong>Notes:</strong></p>
                <p>{{ $book->notes }}</p>
            </div>
        </div>

        <h2>Reading Sessions</h2>

        @if($book->readingSessions->isEmpty())
            <div class="alert alert-info">
                No reading sessions recorded for this book.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Started At</th>
                            <th>Ended At</th>
                            <th>Pages Read</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($book->readingSessions as $session)
                            <tr>
                                <td>{{ $session->started_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $session->ended_at ? $session->ended_at->format('Y-m-d H:i:s') : 'Ongoing' }}</td>
                                <td>{{ $session->pages_read }}</td>
                                 <td>
                                    @if($session->ended_at)
                                        {{ $session->started_at->diff($session->ended_at)->format('%h hours %i minutes') }}
                                    @else
                                        Ongoing
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-4">
             <a href="{{ route('books.edit', $book) }}" class="btn btn-secondary">Edit Book</a>
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#startReadingSessionModal">
                Start Reading Session
            </button>
        </div>
    </div>

    <div class="modal fade" id="startReadingSessionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Start Reading Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('books.reading-sessions.start', $book) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="started_at">Started At</label>
                            <input type="date" name="started_at" id="started_at" class="form-control" required>
                             @error('started_at')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                         <div class="form-group mb-3">
                            <label for="pages_read">Pages Read (Optional)</label>
                            <input type="number" name="pages_read" id="pages_read" class="form-control" min="0">
                             @error('pages_read')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Start Session</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="endReadingSessionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">End Reading Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="end-reading-session-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="ended_at">Ended At</label>
                            <input type="date" name="ended_at" id="ended_at" class="form-control" required>
                            @error('ended_at')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="pages_read_end">Pages Read (Optional)</label>
                            <input type="number" name="pages_read" id="pages_read_end" class="form-control" min="0">
                             @error('pages_read')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">End Session</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        //script to set the end session modal form action.
        $('#endReadingSessionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var readingSessionId = button.data('reading-session-id') // Extract info from data attributes
            var form = $("#end-reading-session-form")
            form.attr('action', '/books/{{$book->id}}/reading-sessions/' + readingSessionId);
        })
    </script>
@endsection