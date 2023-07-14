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

    /**
     * Summary of create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $create = Comment::create($attributes);

        throw_if(!$create, new CommentJsonException('Failed to create comment', 500));

        return $create;
    }

    /**
     * Summary of update
     * @param \App\Models\Comment $comment
     * @param array $attributes
     * @return Comment
     */
    public function update($comment, array $attributes)
    {
        $update = $comment->updateOrFail($attributes);

        throw_if(!$update, new CommentJsonException('Failed to update comment', 500));

        return $comment;
    }

    /**
     * Summary of delete
     * @param \App\Models\Comment $comment
     * @return bool|null
     */
    public function delete($comment)
    {
        $delete = $comment->deleteOrFail();

        throw_if(!$delete, new CommentJsonException('Failed to delete comment', 500));

        return $delete;
    }

}