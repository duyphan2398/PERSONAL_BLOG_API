<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->categories() as $category){
            Category::query()->create([
                'name'          => ucwords($category),
                'display_name'  => strtoupper($category),
                'file_id'       => null
            ]);
        }

    }

    public function categories(){
        return [
            'My stories',
            'Blogs',
            'Projects',
            'Services'
        ];
    }
}
