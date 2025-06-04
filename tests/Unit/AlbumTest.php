<?php

namespace Tests\Unit;

use App\Models\Album;
use App\Models\User;
use App\Models\ListeningLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AlbumTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_fillable_attributes()
    {
        $album = new Album();
        $this->assertEquals([
            'user_id', 'artist', 'title', 'genre', 'release_year', 'format', 'notes',
        ], $album->getFillable());
    }

    #[Test]
    public function it_belongs_to_a_user()
    {
        $album = new Album();
        $this->assertInstanceOf(BelongsTo::class, $album->user());
    }

    #[Test]
    public function it_has_many_listening_logs()
    {
        $album = new Album();
        $this->assertInstanceOf(HasMany::class, $album->listeningLogs());
    }
}
