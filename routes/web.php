<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function () {
    // Books
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // Reading Sessions
    Route::post('/books/{book}/reading-sessions', [BookController::class, 'startReadingSession'])->name('books.reading-sessions.start');
    Route::put('/books/{book}/reading-sessions/{reading_session}', [BookController::class, 'endReadingSession'])->name('books.reading-sessions.end');

    // Albums
    Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
    Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
    Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
    Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');

    // Listening Logs
    Route::post('/albums/{album}/listening-logs', [AlbumController::class, 'logListeningSession'])->name('albums.listening-logs.store');

    // Reports  Add these lines
    Route::get('/reports/books', [ReportController::class, 'showBookReports'])->name('reports.books');
    Route::get('/reports/albums', [ReportController::class, 'showAlbumReports'])->name('reports.albums');
});
// Authentication routes (you can use Laravel's built-in auth)
Auth::routes();
Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
