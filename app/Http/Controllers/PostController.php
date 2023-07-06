<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function __construct(protected PostRepository $repository)
    {

    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index(Request $request)
    {

        $page_size = $request->page_size ?? 10;

        $posts = $this->repository->showAll($page_size);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(StorePostRequest $request)
    {

        $create = $this->repository->create($request->validated());
        return new PostResource($create);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Models\Post $post
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $update = $this->repository->update($post, $request->validated());

        return new PostResource($update);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $delete = $this->repository->delete($post);

        return new JsonResponse([
            'data' => $delete
        ]);
    }
}