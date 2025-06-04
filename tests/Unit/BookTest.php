<?php

namespace Tests\Unit;

use App\Models\Book;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_fillable_attributes()
    {
        $book = new Book();
        $this->assertEquals([
            'user_id', 'title', 'author', 'genre', 'publication_year', 'pages',
            'status', 'started_at', 'finished_at', 'rating', 'notes',
        ], $book->getFillable());
    }

    #[Test]
    public function it_casts_dates_correctly()
    {
        $book = new Book();
        $this->assertEquals([
            'id' => 'int',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ], $book->getCasts());
    }

    #[Test]
    public function it_belongs_to_a_user()
    {
        $book = new Book();
        $this->assertInstanceOf(BelongsTo::class, $book->user());
    }

    #[Test]
    public function it_has_many_reading_sessions()
    {
        $book = new Book();
        $this->assertInstanceOf(HasMany::class, $book->readingSessions());
    }
}
