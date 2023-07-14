<?php

/**
 * Summary of namespace App\Repositories
 */
namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;


/**
 * Summary of PostRepository
 */
class PostRepository extends Repository
{

    protected $model = Post::class;


    public function create(array $post)
    {
        return DB::transaction(function () use ($post) {

            $post = Post::create($post);

            $post->users()->sync($post['user_id']);

            return $post;

        });

    }


    public function update(array $attributes, $post)
    {
        return $post->updateOrFail($attributes);
    }


    public function delete($post)
    {
        return $post->deleteOrFail();
    }
}