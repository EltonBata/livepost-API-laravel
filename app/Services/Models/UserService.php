<?php

namespace App\Services\Models;

use App\Contracts\Services\UserServiceInterface;
use App\Events\Models\user\CreatedUserEvent;
use App\Events\Models\user\DeletedUserEvent;
use App\Events\Models\user\UpdatedUserEvent;
use App\Exceptions\UserJsonException;
use App\Repositories\UserRepository;

class UserService extends Service implements UserServiceInterface
{
    protected $repository = UserRepository::class;

    public function create(array $attributes)
    {
        $created = $this->repository->create($attributes);

        throw_if(!$created, new UserJsonException('Failed to create user', 500));

        event(new CreatedUserEvent($created));

        return $created;
    }

    public function update(array $attributes, $user)
    {
        $updated = $this->update($attributes, $user);

        throw_if(!$updated, new UserJsonException('Failed to update user', 500));

        event(new UpdatedUserEvent($user));

        return $user;
    }

    public function delete($user)
    {
        $deleted = $this->repository->delete($user);

        throw_if(!$deleted, new UserJsonException('Failed to delete user', 500));

        event(new DeletedUserEvent);

        return $deleted;
    }
}