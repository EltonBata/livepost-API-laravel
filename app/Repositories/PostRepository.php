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

    /**
     * Summary of showAll
     * @param mixed $page_size
     * @return mixed
     */
    public function showAll($page_size)
    {
        return Post::paginate($page_size);
    }


    /**
     * Summary of create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {

            $post = Post::create($attributes);

            $post->users()->sync(data_get($attributes, 'user_id'));

            return $post;
        });

    }


    /**
     * Summary of update
     * @param \App\Models\Post $post
     * @param array $attributes
     * @return Post
     */
    public function update($post, array $attributes)
    {
        $update = $post->updateOrFail($attributes);
        return $post;
    }

    /**
     * Summary of delete
     * @param \App\Models\Post $post
     * @return bool|null
     */
    public function delete($post)
    {
        return $post->deleteOrFail();

    }
}