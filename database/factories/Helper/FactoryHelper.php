<?php

namespace Database\Factories\Helper;

class FactoryHelper
{

    /**
     * @param string $model 
     */

    public static function getRandomModelId(string $model)
    {
        //get model count
        $count = $model::query()->count();

        if ($count === 0) {
            //if count iquals 0, create new post and grab the id
            return $id = $model::factory()->create()->id;
        } else {
            //generate a random number from 1 to count

            return $id = rand(1, $count);
        }
    }
}