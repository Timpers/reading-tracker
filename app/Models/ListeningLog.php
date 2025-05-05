<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListeningLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id', 'listened_at', 'side_tracks', 'rating', 'notes'
    ];
     protected $casts = [
        'listened_at' => 'datetime',
    ];

    /**
     * Get the album that owns the listening log.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
