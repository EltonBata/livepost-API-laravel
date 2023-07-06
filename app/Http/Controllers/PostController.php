<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::all();

        return new JsonResponse([
            'data' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePostRequest $request)
    {

        $create = DB::transaction(function () use ($request) {

            $post = Post::create($request->validated());

            $post->users()->sync($request->user_id);

            return $post;
        });

        return new JsonResponse([
            'data' => $create
        ]);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post)
    {
        return new JsonResponse([
            'data' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Models\Post $post
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $update = $post->updateOrFail($request->validated());

        return new JsonResponse([
            'data' => $update
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $delete = $post->deleteOrFail();

        return new JsonResponse([
            'data' => $delete
        ]);
    }
}