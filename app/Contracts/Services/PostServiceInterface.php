<?php

namespace App\Contracts\Services;

interface PostServiceInterface
{
    public function showAll($pages_number);

    public function create(array $post);

    public function update(array $attributes, $post);

    public function delete($post);
}