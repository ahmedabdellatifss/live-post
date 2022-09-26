<?php

namespace Database\Factories\Helpers;
use App\Models\Post;

class FactoryHelper
{
    /**
     * this function will get a random model id from the database
     * @param string | HasFactory $model
     */
    public static function getRandomModelId(string $model)
    {
        // get model count
        $count = $model::query()->count();

        if($count === 0){
            // if count is zero
            // we should create a new record and retrieve the record id
            return $model::factory()->create()->id;
        }else{
            // generate random number between 1 and model count
            return rand(1 , $count);
        }
    }
}
