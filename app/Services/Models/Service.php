<?php

namespace App\Services\Models;

abstract class Service
{

    protected $repository;

    public function __construct()
    {
        $this->repository = app($this->repository);
    }

    public function showAll($pages_number)
    {
        return $this->repository->showAll($pages_number);
    }


    public abstract function create(array $model);

    public abstract function update(array $attributes, $model);

    public abstract function delete($model);
}