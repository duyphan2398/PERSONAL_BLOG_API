<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'         => $faker->text,
        'content'       => $faker->paragraphs(99, true),
        'admin_id'      => optional(\App\Models\Admin::query()->first())->id,
        'is_active'     => true,
        'file_id'       => null
    ];
});
