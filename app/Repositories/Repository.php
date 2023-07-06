<?php

namespace App\Repositories;

abstract class Repository
{

    public abstract function create(array $attributes);
    public abstract function update($model, array $attributes);
    public abstract function delete($model);
    public abstract function showAll($attribute);

}