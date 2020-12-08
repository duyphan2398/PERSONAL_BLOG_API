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
                'file_id'       => null
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
