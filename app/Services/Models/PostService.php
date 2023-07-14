<?php

namespace App\Services\Models;

use App\Contracts\Services\PostServiceInterface;
use App\Events\Models\post\CreatedPostEvent;
use App\Events\Models\post\DeletedPostEvent;
use App\Events\Models\post\UpdatedPostEvent;
use App\Exceptions\PostJsonException;
use App\Repositories\PostRepository;
use App\Services\Models;

class PostService extends Service implements PostServiceInterface
{
    protected $repository = PostRepository::class;

    public function create(array $post)
    {

        $post = $this->repository->create($post);

        throw_if(!$post, new PostJsonException('Failed to create post', 500));

        event(new CreatedPostEvent($post));

        return $post;
    }

    public function update(array $attributes, $post)
    {

        $update = $this->repository->update($attributes, $post);

        throw_if(!$update, new PostJsonException('Failed to update post', 500));

        event(new UpdatedPostEvent($post));

        return $post;
    }

    public function delete($post)
    {
        $delete = $this->repository->delete($post);

        throw_if(!$delete, new PostJsonException('Failed to delete post', 500));

        event(new DeletedPostEvent($post));

        return $delete;
    }


}