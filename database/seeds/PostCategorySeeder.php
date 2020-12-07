<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts =  Post::all();
        $posts->each(function ($post){
            $randomCategory = Category::query()->inRandomOrder()->take(random_int(1, 3));
            $randomCategory->each(function ($category) use ($post){
                $post->postCategories()->create(['category_id' => $category->id]);
            });
        });
    }
}
