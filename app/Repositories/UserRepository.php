<?php

/**
 * Summary of namespace App\Repositories
 */
namespace App\Repositories;

use App\Models\User;

/**
 * Summary of UserRepository
 */
class UserRepository extends Repository
{

    /**
     * Summary of showAll
     * @param mixed $attribute
     * @return mixed
     */
    public function showAll($attribute)
    {
        return User::paginate($attribute);
    }

    /**
     * Summary of create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return User::create($attributes);
    }

    /**
     * Summary of update
     * @param \App\Models\User $user
     * @param array $attributes
     * @return User
     */
    public function update($user, array $attributes)
    {
        $user->updateOrFail($attributes);
        return $user;
    }

    /**
     * Summary of delete
     * @param \App\Models\User $user
     * @return bool|null
     */
    public function delete($user)
    {
        return $user->deleteOrFail();
    }

}