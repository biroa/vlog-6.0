<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, static function (Faker $faker) {
    return [
        'title' => $faker->name,
        'user_id' => factory(App\User::class)->create(),
        'category_id' => factory(App\Category::class)->create(),
        'description' => $faker->text(),
    ];
});
