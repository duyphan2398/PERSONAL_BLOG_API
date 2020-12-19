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

        foreach($this->categories() as $name => $displayName){
            Category::query()->create([
                'name'          => $name,
                'display_name'  => $displayName,
                'title'         => \Faker\Provider\Uuid::uuid(),
                'content'       => 'this is logan',
                'file_id'       => null,
                'color'         => \Faker\Provider\id_ID\Color::hexColor()
            ]);
        }

    }

    public function categories(){
        return [
            'my_stories'    => 'My Stories',
            'blogs'         => 'Blogs',
            'projects'      => 'Projects',
            'services'      => 'Services'
        ];
    }
}
