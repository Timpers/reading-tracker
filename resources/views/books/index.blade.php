@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">My Books</h1>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
        </div>

        @if($books->isEmpty())
            <div class="alert alert-info">
                You haven't added any books yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Publication Year</th>
                            <th>Status</th>
                            <th>Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->genre }}</td>
                                <td>{{ $book->publication_year }}</td>
                                <td>{{ $book->status }}</td>
                                <td>{{ $book->rating }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-primary">View</a>
                                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-secondary">Edit</a>
                                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
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