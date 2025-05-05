<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display the book reports.
     */
    public function showBookReports()
    {
        $totalBooks = Book::count();
        $totalPagesRead = \App\Models\ReadingSession::sum('pages_read');
        $averageBookRating = Book::avg('rating');
        $booksByStatus = Book::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        $readingSessionsByBook = Book::select('title')
            ->withCount('readingSessions')
            ->leftJoin('reading_sessions', 'books.id', '=', 'reading_sessions.book_id')
            ->groupBy('books.id', 'books.title')
            ->selectRaw('SUM(reading_sessions.pages_read) as total_pages_read')
            ->get();

        return view('reports.books', compact(
            'totalBooks',
            'totalPagesRead',
            'averageBookRating',
            'booksByStatus',
            'readingSessionsByBook'
        ));
    }

    /**
     * Display the album reports.
     */
    public function showAlbumReports()
    {
        $totalAlbums = Album::count();
        $averageAlbumRating = 1;//Album::avg('rating');
         $albumsByFormat = Album::select('format', DB::raw('count(*) as count'))
            ->groupBy('format')
            ->get()
            ->pluck('count', 'format')
            ->toArray();

        return view('reports.albums', compact(
            'totalAlbums',
            'averageAlbumRating',
            'albumsByFormat'
        ));
    }
}