<?php

namespace App\Services\Models;

use App\Contracts\Services\CommentServiceInterface;
use App\Events\Models\comment\CreatedCommentEvent;
use App\Events\Models\comment\DeletedCommentEvent;
use App\Events\Models\comment\UpdatedCommentEvent;
use App\Exceptions\CommentJsonException;
use App\Repositories\CommentRepository;

class CommentService extends Service implements CommentServiceInterface
{

    protected $repository = CommentRepository::class;

    public function create(array $comment)
    {
        $created = $this->repository->create($comment);

        throw_if(!$created, new CommentJsonException('Failed to create comment', 500));

        event(new CreatedCommentEvent($created));

        return $created;
    }

    public function update(array $attributes, $comment)
    {
        $updated = $this->repository->update($attributes, $comment);

        throw_if(!$updated, new CommentJsonException('Failed to update comment', 500));

        event(new UpdatedCommentEvent($comment));

        return $comment;
    }

    public function delete($comment)
    {
        $deleted = $this->repository->delete($comment);

        throw_if(!$deleted, new CommentJsonException('Failed to delete comment', 500));

        event(new DeletedCommentEvent);

        return $deleted;
    }

}