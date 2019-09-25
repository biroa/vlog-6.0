<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, static function (Faker $faker) {
    $words = $faker->words(5,true);
    
    return [
        'user_id' => factory(App\User::class)->create(),
        'title' => $words,
        'comment' => $faker->paragraph
    ];
});
