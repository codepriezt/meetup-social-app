<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Friend;
use Faker\Generator as Faker;

$factory->define(Friend::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->numberBetween(1,100),
        'friend_id'=>$faker->numberBetween(1,100),
        'status'=>$faker->randomElement(['inactive' ,'pending' , 'confirmed' , 'blocked']),

    ];
});
