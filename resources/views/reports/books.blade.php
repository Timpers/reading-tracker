@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Book Reports</h1>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Total Books</div>
                    <div class="card-body">
                        {{ $totalBooks }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Total Pages Read</div>
                    <div class="card-body">
                        {{ $totalPagesRead }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Average Book Rating</div>
                    <div class="card-body">
                        {{ $averageBookRating }}
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Books by Status</div>
                    <div class="card-body">
                        <ul>
                            @foreach($booksByStatus as $status => $count)
                                <li>{{ ucfirst($status) }}: {{ $count }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <h2>Reading Sessions by Book</h2>
         <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Total Reading Sessions</th>
                        <th>Total Pages Read</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($readingSessionsByBook as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->total_sessions }}</td>
                             <td>{{ $book->total_pages_read }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
