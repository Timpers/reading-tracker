<?php

namespace Tests\Unit;

use App\Models\ListeningLog;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ListeningLogTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_fillable_attributes()
    {
        $log = new ListeningLog();
        $this->assertEquals([
            'album_id', 'listened_at', 'side_tracks', 'rating', 'notes'
        ], $log->getFillable());
    }

    #[Test]
    public function it_casts_listened_at_to_datetime()
    {
        $log = new ListeningLog();
        $this->assertEquals([
            'id' => 'int',
            'listened_at' => 'datetime',
        ], $log->getCasts());
    }

    #[Test]
    public function it_belongs_to_an_album()
    {
        $log = new ListeningLog();
        $this->assertInstanceOf(BelongsTo::class, $log->album());
    }
}
