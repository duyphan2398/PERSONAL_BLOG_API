<?php

namespace App\Models;

use App\Builders\CategoryBuilder;
use App\Traits\OverridesBuilder;

class PostCategory extends BaseModel
{
    use OverridesBuilder;

    protected $table = 'post_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'post_id',
        'category_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
