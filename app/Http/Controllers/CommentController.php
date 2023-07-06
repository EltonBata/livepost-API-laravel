<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $comments = Comment::all();

        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreCommentRequest $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(StoreCommentRequest $request)
    {
        $create = Comment::create($request->validated());

        return new CommentResource($create);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Models\Comment $comment
     * @param \App\Http\Requests\UpdateCommentRequest $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->updateOrFail($request->validated());

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        $delete = $comment->deleteOrFail();

        return new JsonResponse([
            'data' => $delete
        ]);
    }
}
