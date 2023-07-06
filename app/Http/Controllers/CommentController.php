<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $comments = Comment::all();

        return new JsonResponse([
            'data' => $comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $create = Comment::create($request->validated());

        return new JsonResponse([
            'data' => $create
        ]);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Comment $comment)
    {
        return new JsonResponse([
            'data' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Models\Comment $comment
     * @param \App\Http\Requests\UpdateCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->updateOrFail($request->validated());

        return new JsonResponse([
            'data' => $comment
        ]);
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
