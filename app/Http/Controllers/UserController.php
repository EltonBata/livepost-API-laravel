<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return new JsonResponse([
            'data' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $create = User::create($request->validated());

        return new JsonResponse([
            'data' => $create
        ]);
    }

    /**
     * Display the specified resource.
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return new JsonResponse([
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $update = $user->updateOrFail($request->validated());

        return new JsonResponse([
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $delete = $user->deleteOrFail();

        return new JsonResponse([
            'data' => $delete
        ]);
    }
}