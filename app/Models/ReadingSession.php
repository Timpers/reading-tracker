<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReadingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id', 'started_at', 'ended_at', 'pages_read',
    ];

     protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /**
     * Get the book that owns the reading session.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
