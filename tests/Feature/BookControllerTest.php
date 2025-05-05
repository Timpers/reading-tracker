<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test the index method of BookController.
     */
    public function testIndex()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create some books for the user
        $books = Book::factory()->count(3)->create(['user_id' => $user->id]);

        // Call the index route
        $response = $this->get(route('books.index'));

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the view contains the books
        $response->assertViewHas('books');

        // Assert the view contains the user's books
        $response->assertViewHas('books', $books);
    }

    /**
     * Test the create method of BookController.
     */
    public function testCreate()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Call the create route
        $response = $this->get(route('books.create'));

        // Assert the response is successful
        $response->assertStatus(200);
    }

    /**
     * Test the store method of BookController.
     */
    public function testStore()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Generate book data
        $bookData = [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'genre' => $this->faker->word,
            'publication_year' => $this->faker->year,
            'pages' => $this->faker->numberBetween(100, 500),
            'status' => 'to_read',
            'notes' => $this->faker->paragraph,
        ];

        // Call the store route
        $response = $this->post(route('books.store'), $bookData);

        // Assert the response is a redirect
        $response->assertStatus(302);

        // Assert the book was created in the database
        $this->assertDatabaseHas('books', [
            'title' => $bookData['title'],
            'author' => $bookData['author'],
            'user_id' => $user->id,
        ]);

        // Assert a flash message was set
        $response->assertSessionHas('success');
    }

    /**
     * Test the show method of BookController.
     */
    public function testShow()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a book for the user
        $book = Book::factory()->create(['user_id' => $user->id]);

        // Call the show route
        $response = $this->get(route('books.show', $book));

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the view contains the book
        $response->assertViewHas('book');

        // Assert the view contains the correct book
        $response->assertViewHas('book', $book);
    }

    /**
     * Test the edit method of BookController.
     */
    public function testEdit()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a book for the user
        $book = Book::factory()->create(['user_id' => $user->id]);

        // Call the edit route
        $response = $this->get(route('books.edit', $book));

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the view contains the book
        $response->assertViewHas('book');

        // Assert the view contains the correct book
        $response->assertViewHas('book', $book);
    }

    /**
     * Test the update method of BookController.
     */
    public function testUpdate()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a book for the user
        $book = Book::factory()->create(['user_id' => $user->id]);

        // Generate updated book data
        $updatedBookData = [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'genre' => $this->faker->word,
            'publication_year' => $this->faker->year,
            'pages' => $this->faker->numberBetween(100, 500),
            'status' => 'currently_reading',
            'notes' => $this->faker->paragraph,
        ];

        // Call the update route
        $response = $this->put(route('books.update', $book), $updatedBookData);

        // Assert the response is a redirect
        $response->assertStatus(302);

        // Assert the book was updated in the database
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => $updatedBookData['title'],
            'author' => $updatedBookData['author'],
            'status' => $updatedBookData['status'],
        ]);

        // Assert a flash message was set
        $response->assertSessionHas('success');
    }

    /**
     * Test the destroy method of BookController.
     */
    public function testDestroy()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a book for the user
        $book = Book::factory()->create(['user_id' => $user->id]);

        // Call the destroy route
        $response = $this->delete(route('books.destroy', $book));

        // Assert the response is a redirect
        $response->assertStatus(302);

        // Assert the book was deleted from the database
        $this->assertDatabaseMissing('books', ['id' => $book->id]);

        // Assert a flash message was set
        $response->assertSessionHas('success');
    }
}