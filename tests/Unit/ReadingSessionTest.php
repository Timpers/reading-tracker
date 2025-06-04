<?php

namespace Tests\Unit;

use App\Models\ReadingSession;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ReadingSessionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_fillable_attributes()
    {
        $session = new ReadingSession();
        $this->assertEquals([
            'book_id', 'started_at', 'ended_at', 'pages_read',
        ], $session->getFillable());
    }

    #[Test]
    public function it_casts_dates_correctly()
    {
        $session = new ReadingSession();
        $this->assertEquals([
            'id' => 'int',
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ], $session->getCasts());
    }

    #[Test]
    public function it_belongs_to_a_book()
    {
        $session = new ReadingSession();
        $this->assertInstanceOf(BelongsTo::class, $session->book());
    }
}
