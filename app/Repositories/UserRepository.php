<?php

/**
 * Summary of namespace App\Repositories
 */
namespace App\Repositories;

use App\Events\Models\user\CreatedUserEvent;
use App\Events\Models\user\DeletedUserEvent;
use App\Events\Models\user\UpdatedUserEvent;
use App\Exceptions\UserJsonException;
use App\Models\User;

/**
 * Summary of UserRepository
 */
class UserRepository extends Repository
{

    protected $model = User::class;
    

    /**
     * Summary of create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $create = User::create($attributes);

        throw_if(!$create, new UserJsonException('Failed to create user', 500));

        event(new CreatedUserEvent($create));

        return $create;
    }

    /**
     * Summary of update
     * @param \App\Models\User $user
     * @param array $attributes
     * @return User
     */
    public function update($user, array $attributes)
    {
        $update = $user->updateOrFail($attributes);

        throw_if(!$update, new UserJsonException('Failed to update user', 500));

        event(new UpdatedUserEvent($user));

        return $user;
    }

    /**
     * Summary of delete
     * @param \App\Models\User $user
     * @return bool|null
     */
    public function delete($user)
    {
        $delete = $user->deleteOrFail();

        throw_if(!$delete, new UserJsonException('Failed to delete user', 500));

        event(new DeletedUserEvent($user));

        return $delete;
    }

}