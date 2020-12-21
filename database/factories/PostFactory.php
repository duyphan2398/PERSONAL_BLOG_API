<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->paragraphs(2, true);
    $shortTile = $faker->paragraph;
    $slug =\Illuminate\Support\Str::random(3).'-'.join('+',explode(' ', str_replace('/', '', $shortTile)));

    return [
        'title'         => $title,
        'content'       => $faker->paragraphs(99, true),
        'short_content' => $faker->paragraphs(1, true),
        'short_title'   => $shortTile,
        'admin_id'      => optional(\App\Models\Admin::query()->first())->id,
        'is_active'     => true,
        'slug'          => $slug,
        'file_id'       => null
    ];
});
