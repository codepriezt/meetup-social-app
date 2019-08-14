<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */


use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [

        'user_id' =>$faker->numberBetween(1 ,100),
        'parent_id'=>$faker->numberBetween(2 , 100),
        'body' => $faker->text(),
        
    ];
});
