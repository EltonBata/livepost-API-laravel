<?php

/**
 * Summary of namespace App\Repositories
 */
namespace App\Repositories;

use App\Models\Comment;

/**
 * Summary of CommentRepository
 */
class CommentRepository extends Repository
{

    /**
     * Summary of showAll
     * @param mixed $attribute
     * @return mixed
     */
    public function showAll($attribute)
    {
        return Comment::paginate($attribute);
    }

    /**
     * Summary of create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Comment::create($attributes);
    }

    /**
     * Summary of update
     * @param \App\Models\Comment $comment
     * @param array $attributes
     * @return Comment
     */
    public function update($comment, array $attributes)
    {
        $comment->updateOrFail($attributes);
        return $comment;
    }

    /**
     * Summary of delete
     * @param \App\Models\Comment $comment
     * @return bool|null
     */
    public function delete($comment)
    {
        return $comment->deleteOrFail();
    }

}