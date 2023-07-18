<?php

namespace Tests\Feature\Api\V1\post;

use App\Events\Models\post\CreatedPostEvent;
use App\Events\Models\post\DeletedPostEvent;
use App\Events\Models\post\UpdatedPostEvent;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PostApiTest extends TestCase
{

    // use RefreshDatabase;

    // public function test_index()
    // {
    //     $posts = Post::factory(5)->create();

    //     $postsId = $posts->map(fn($post) => $post->id);

    //     //call index end-point
    //     $response = $this->json('get', '/api/v1/posts');

    //     //assert status
    //     $response->assertStatus(200);

    //     //verify data
    //     $data = $response->json('data');

    //     collect($data)->each(fn($post) => $this->assertTrue(in_array($post['id'], $postsId->toArray())));
    // }

    public function test_show()
    {

        $post = Post::factory()->createOne();

        $response = $this->json('get', '/api/v1/posts/' . $post->id);

        $response->assertStatus(200);

        $data = $response->json('data');

        $this->assertEquals($data['id'], $post->id);
    }

    public function test_store()
    {
        Event::fake();

        $post = Post::factory()->makeOne();
        $post['user_id'] = 2;

        $response = $this->json('post', '/api/v1/posts', $post->toArray());

        $response->assertStatus(201);

        Event::assertDispatched(CreatedPostEvent::class);

        $result = $response->json('data');

        $result = collect($result)->only(array_keys($post->getAttributes()));

        $this->assertSame($result->toArray(), $post->only(['title', 'body']));

    }

    public function test_update()
    {
        Event::fake();

        $post = Post::factory()->createOne();

        $update = [
            'title' => 'yeah sup',
            'body' => ['name' => 'Ronaldo']
        ];

        $response = $this->json('put', '/api/v1/posts/' . $post->id, $update);

        $response->assertStatus(200);

        Event::assertDispatched(UpdatedPostEvent::class);

        $result = $response->json('data');

        $result = collect($result)->only(array_keys($update));

        $this->assertSame($result->toArray(), $update);
    }

    public function test_delete()
    {
        Event::fake();

        $post = Post::factory()->createOne();

        $response = $this->json('delete', '/api/v1/posts/' . $post->id);

        $response->assertStatus(200);

        Event::assertDispatched(DeletedPostEvent::class);

        $actual = Post::find($post->id);

        $this->assertSame(null, $actual);
    }
}