<?php

namespace App\Http\Controllers;

use App\Events\Models\user\CreatedUserEvent;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(protected UserRepository $repository)
    {

    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index(Request $request)
    {
        //event(new CreatedUserEvent(User::factory()->createOne()));

        $page_size = $request->page_size ?? 10;

        $users = $this->repository->showAll($page_size);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreUserRequest $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(StoreUserRequest $request)
    {
        $create = $this->repository->create($request->validated());

        return new UserResource($create);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $update = $this->repository->update($user, $request->validated());

        return new UserResource($update);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $delete = $this->repository->delete($user);

        return new JsonResponse([
            'data' => $delete
        ]);
    }
}