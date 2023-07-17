<?php

/**
 * Summary of namespace App\Repositories
 */
namespace App\Repositories;

use App\Exceptions\CommentJsonException;
use App\Models\Comment;

/**
 * Summary of CommentRepository
 */
class CommentRepository extends Repository
{

    protected $model = Comment::class;


    public function create(array $attributes)
    {
        $create = $this->model::create($attributes);

        return $create;
    }


    public function update(array $attributes, $comment)
    {
        return $comment->updateOrFail($attributes);
    }


    public function delete($comment)
    {
        return $comment->deleteOrFail();
    }

}