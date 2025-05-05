<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\ListeningLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class AlbumController extends Controller
{
    /**
     * Display a listing of the albums.
     */
    public function index()
    {
        $user = Auth::user();
        $albums = $user->albums()->with('listeningLogs')->get();
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new album.
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created album in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'artist' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string|max:100',
            'release_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'format' => ['nullable', Rule::in(['vinyl', 'cd', 'digital'])],
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();
        $album = new Album($validatedData);
        $album->user_id = $user->id;
        $album->save();

        return redirect()->route('albums.index')->with('success', 'Album added successfully!');
    }

    /**
     * Display the specified album.
     */
    public function show(Album $album)
    {
        // Ensure the user owns the album
        if ($album->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $album->load('listeningLogs');
        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified album.
     */
    public function edit(Album $album)
    {
        // Ensure the user owns the album
        if ($album->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified album in storage.
     */
    public function update(Request $request, Album $album)
    {
        // Ensure the user owns the album
         if ($album->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'artist' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'genre' => 'nullable|string|max:100',
            'release_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'format' => ['nullable', Rule::in(['vinyl', 'cd', 'digital'])],
            'notes' => 'nullable|string',
        ]);

        $album->update($validatedData);

        return redirect()->route('albums.index')->with('success', 'Album updated successfully!');
    }

    /**
     * Remove the specified album from storage.
     */
    public function destroy(Album $album)
    {
        // Ensure the user owns the album
        if ($album->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album deleted successfully!');
    }

    /**
     * Log a new listening session for the specified album.
     */
    public function logListeningSession(Request $request, Album $album)
    {
        // Ensure the user owns the album
        if ($album->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'listened_at' => 'required|date',
            'side_tracks' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
            'notes' => 'nullable|string',
        ]);

        $listeningLog = new ListeningLog();
        $listeningLog->album_id = $album->id;
        $listeningLog->listened_at = $validatedData['listened_at'];
        $listeningLog->side_tracks = $validatedData['side_tracks'];
        $listeningLog->rating = $validatedData['rating'];
        $listeningLog->notes = $validatedData['notes'];
        $listeningLog->save();

        return redirect()->route('albums.show', $album)->with('success', 'Listening session logged!');
    }
}
