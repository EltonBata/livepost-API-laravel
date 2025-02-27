<?php

namespace App\Repositories;


abstract class Repository
{

    protected $model;

    public function __construct()
    {
        $this->model = app($this->model);
    }

    public function showAll($pages_number)
    {
        return $this->model::paginate($pages_number);
    }


    public abstract function create(array $model);

    public abstract function update(array $attributes, $model);

    public abstract function delete($model);


}