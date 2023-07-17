<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CommentServiceInterface;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommentController extends Controller
{

    public function __construct(
        protected CommentServiceInterface $service,
    ) {
    }


    public function index(Request $request)
    {

        $page_size = $request->page_size ?? 10;

        $comments = $this->service->showAll($page_size);

        return CommentResource::collection($comments);
    }


    public function store(StoreCommentRequest $request)
    {
        $create = $this->service->create($request->validated());

        return [
            'message' => 'Comment Created',
            'data' => new CommentResource($create)
        ];
    }


    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }


    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $update = $this->service->update($request->validated(), $comment);

        return [
            'message' => 'Comment Updated',
            'data' => new CommentResource($update)
        ];
    }


    public function destroy(Comment $comment)
    {
        $this->service->delete($comment);

        return new JsonResponse([
            'message' => 'Comment Deleted',
        ]);
    }
}