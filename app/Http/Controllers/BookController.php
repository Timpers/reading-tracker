<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ReadingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        $user = Auth::user();
        $books = $user->books()->with('readingSessions')->get(); // Eager load reading sessions
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'nullable|string|max:100',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'pages' => 'nullable|integer|min:1',
            'status' => ['nullable', Rule::in(['to_read', 'currently_reading', 'finished'])],
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date|after:started_at',
            'rating' => 'nullable|integer|min:1|max:5',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();
        $book = new Book($validatedData);
        $book->user_id = $user->id; // Assign the current user's ID
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        // Ensure the user owns the book
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $book->load('readingSessions'); // Load reading sessions
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
         // Ensure the user owns the book
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        // Ensure the user owns the book
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'nullable|string|max:100',
            'publication_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'pages' => 'nullable|integer|min:1',
             'status' => ['nullable', Rule::in(['to_read', 'currently_reading', 'finished'])],
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date|after:started_at',
            'rating' => 'nullable|integer|min:1|max:5',
            'notes' => 'nullable|string',
        ]);

        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        // Ensure the user owns the book
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

    /**
     * Start a new reading session for the specified book.
     */
    public function startReadingSession(Request $request, Book $book)
    {
        // Ensure the user owns the book
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $validatedData = $request->validate([
            'started_at' => 'required|date',
            'pages_read' => 'nullable|integer|min:0'
        ]);

        $readingSession = new ReadingSession();
        $readingSession->book_id = $book->id;
        $readingSession->started_at = $validatedData['started_at'];
        $readingSession->pages_read = $validatedData['pages_read'];
        $readingSession->save();

        $book->status = 'currently_reading';  //update the status
        $book->save();

        return redirect()->route('books.show', $book)->with('success', 'Reading session started!');
    }

    /**
     * End the specified reading session.
     */
    public function endReadingSession(Request $request, Book $book, ReadingSession $readingSession)
    {
        // Ensure the user owns the book
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Ensure the reading session belongs to the book
        if ($readingSession->book_id !== $book->id) {
            abort(400, 'Invalid reading session.'); //Or 404
        }
        $validatedData = $request->validate([
            'ended_at' => 'required|date|after:started_at',
            'pages_read' => 'nullable|integer|min:0'
        ]);
        $readingSession->ended_at = $validatedData['ended_at'];
        $readingSession->pages_read = $validatedData['pages_read'];
        $readingSession->save();

         //update the status of the book.
        $total_pages_read = DB::table('reading_sessions')
            ->where('book_id', $book->id)
            ->sum('pages_read');

        if($book->pages && $total_pages_read >= $book->pages){
             $book->status = 'finished';
             $book->finished_at = $readingSession->ended_at;
             $book->save();
        }

        return redirect()->route('books.show', $book)->with('success', 'Reading session ended!');
    }
}