<?php

namespace Tests\Unit;

use App\Contracts\Services\PostServiceInterface;
use App\Exceptions\PostJsonException;
use App\Models\Post;
use Tests\TestCase;

class PostServiceTest extends TestCase
{
    /**
     * @test
     */
    public function create_post_has_to_work()
    {

        //the environment replication
        $post = $this->app->make(PostServiceInterface::class);

        //the source of truth
        $payload = [
            'title' => 'Hello',
            'body' => []
        ];

        //expected result
        $result = $post->create($payload);

        //compare de results
        $this->assertSame($payload, $result->only(['title', 'body']));

    }


    /**
     * @test
     */
    // public function throw_exception_when_create_post_fails()
    // {
    //     //env
    //     $post = $this->app->make(PostServiceInterface::class);

    //     //source of truth 
    //     $payload = [
    //         'title' => 12345,
    //          'body' => []
    //     ];

    //     $this->expectException(PostJsonException::class);

    //     $post->create($payload);
    // }

    /**
     * @test
     */
    public function update_post_has_to_work()
    {
        //env
        $post = $this->app->make(PostServiceInterface::class);

        //dummyPost
        $dummy = Post::factory()->createOne();

        //source of truth
        $payload = [
            'title' => 'Hello World'
        ];

        //update
        $updated = $post->update($payload, $dummy);

        //compare
        $this->assertSame($dummy->only(['title', 'body']), $updated->only(['title', 'body']));
    }

    /**
     * @test
     */
    public function delete_post_has_to_work()
    {

        //env
        $post = $this->app->make(PostServiceInterface::class);

        //dummyPost
        $dummy = Post::factory()->createOne();

        //delete
        $post->delete($dummy);

        //find deleted dummy
        $find = Post::find($dummy->id);

        //compare
        $this->assertSame(null, $find);

    }

    /**
     * @test
     */
    public function throw_exception_when_delete_post_that_doesnt_exist()
    {

        //env
        $post = $this->app->make(PostServiceInterface::class);

        //dummyPost
        $dumy = Post::factory()->makeOne();

        //result
        $this->expectException(PostJsonException::class);

        //delete
        $post->delete($dumy);

    }
}