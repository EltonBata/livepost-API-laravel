<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PostServiceInterface;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class PostController extends Controller
{

    public function __construct(
        protected PostServiceInterface $service
    ) {
    }


    public function index(Request $request)
    {

        $page_size = $request->page_size ?? 10;

        $posts = $this->service->showAll($page_size);

        return PostResource::collection($posts);
    }


    public function store(StorePostRequest $request)
    {

        $create = $this->service->create($request->validated());
        return [
            'message' => 'Post Created',
            'data' => new PostResource($create)
        ];
    }


    public function show(Post $post)
    {
        return new PostResource($post);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $update = $this->service->update($request->validated(), $post);

        return [
            'message' => 'Post Updated',
            'data' => new PostResource($update)
        ];
    }


    public function destroy(Post $post)
    {
        $this->service->delete($post);

        return new JsonResponse([
            'message' => 'Comment Deleted',
        ]);

    }
}