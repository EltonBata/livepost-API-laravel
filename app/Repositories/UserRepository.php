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


    public function create(array $attributes)
    {
        $create = User::create($attributes);

        return $create;
    }


    public function update(array $attributes, $user)
    {
        return $user->updateOrFail($attributes);
    }


    public function delete($user)
    {
        return $user->deleteOrFail();
    }

}