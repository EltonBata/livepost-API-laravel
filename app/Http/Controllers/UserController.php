<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Events\Models\user\CreatedUserEvent;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Userservice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(
        protected UserServiceInterface $service
    ) {
    }


    public function index(Request $request)
    {
        //event(new CreatedUserEvent(User::factory()->createOne()));

        $page_size = $request->page_size ?? 10;

        $users = $this->service->showAll($page_size);

        return UserResource::collection($users);
    }


    public function store(StoreUserRequest $request)
    {
        $create = $this->service->create($request->validated());

        return [
            'message' => 'User Created',
            'data' => new UserResource($create)
        ];
    }


    public function show(User $user)
    {
        return new UserResource($user);
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $update = $this->service->update($request->validated(), $user);

        return [
            'message' => 'User Updated',
            'data' => new UserResource($update)
        ];
    }


    public function destroy(User $user)
    {
        $this->service->delete($user);

        return new JsonResponse([
            'message' => 'User Deleted'
        ]);
    }
}