<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test the index method of AlbumController.
     */
    public function testIndex()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create some albums for the user
        $albums = Album::factory()->count(3)->create(['user_id' => $user->id]);

        // Call the index route
        $response = $this->get(route('albums.index'));

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the view contains the albums
        $response->assertViewHas('albums');

         // Assert the view contains the user's albums
        $response->assertViewHas('albums', $albums);
    }

    /**
     * Test the create method of AlbumController.
     */
    public function testCreate()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Call the create route
        $response = $this->get(route('albums.create'));

        // Assert the response is successful
        $response->assertStatus(200);
    }

    /**
     * Test the store method of AlbumController.
     */
    public function testStore()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Generate album data
        $albumData = [
            'artist' => $this->faker->name,
            'title' => $this->faker->sentence,
            'genre' => $this->faker->word,
            'release_year' => $this->faker->year,
            'format' => 'vinyl',
            'notes' => $this->faker->paragraph,
        ];

        // Call the store route
        $response = $this->post(route('albums.store'), $albumData);

        // Assert the response is a redirect
        $response->assertStatus(302);

        // Assert the album was created in the database
        $this->assertDatabaseHas('albums', [
            'artist' => $albumData['artist'],
            'title' => $albumData['title'],
            'user_id' => $user->id,
        ]);

        // Assert a flash message was set
        $response->assertSessionHas('success');
    }

    /**
     * Test the show method of AlbumController.
     */
    public function testShow()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an album for the user
        $album = Album::factory()->create(['user_id' => $user->id]);

        // Call the show route
        $response = $this->get(route('albums.show', $album));

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the view contains the album
        $response->assertViewHas('album');

        // Assert the view contains the correct album
        $response->assertViewHas('album', $album);
    }

    /**
     * Test the edit method of AlbumController.
     */
    public function testEdit()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an album for the user
        $album = Album::factory()->create(['user_id' => $user->id]);

        // Call the edit route
        $response = $this->get(route('albums.edit', $album));

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the view contains the album
        $response->assertViewHas('album');

        // Assert the view contains the correct album
        $response->assertViewHas('album', $album);
    }

    /**
     * Test the update method of AlbumController.
     */
    public function testUpdate()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an album for the user
        $album = Album::factory()->create(['user_id' => $user->id]);

        // Generate updated album data
        $updatedAlbumData = [
            'artist' => $this->faker->name,
            'title' => $this->faker->sentence,
            'genre' => $this->faker->word,
            'release_year' => $this->faker->year,
            'format' => 'cd',
            'notes' => $this->faker->paragraph,
        ];

        // Call the update route
        $response = $this->put(route('albums.update', $album), $updatedAlbumData);

        // Assert the response is a redirect
        $response->assertStatus(302);

        // Assert the album was updated in the database
        $this->assertDatabaseHas('albums', [
            'id' => $album->id,
            'artist' => $updatedAlbumData['artist'],
            'title' => $updatedAlbumData['title'],
            'format' => $updatedAlbumData['format'],
        ]);

        // Assert a flash message was set
        $response->assertSessionHas('success');
    }

    /**
     * Test the destroy method of AlbumController.
     */
    public function testDestroy()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create an album for the user
        $album = Album::factory()->create(['user_id' => $user->id]);

        // Call the destroy route
        $response = $this->delete(route('albums.destroy', $album));

        // Assert the response is a redirect
        $response->assertStatus(302);

        // Assert the album was deleted from the database
        $this->assertDatabaseMissing('albums', ['id' => $album->id]);

        // Assert a flash message was set
        $response->assertSessionHas('success');
    }
}