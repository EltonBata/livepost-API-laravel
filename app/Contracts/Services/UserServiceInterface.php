<?php

namespace App\Contracts\Services;

interface UserServiceInterface
{
    public function showAll($pages_number);

    public function create(array $post);

    public function update(array $attributes, $post);

    public function delete($post);
}