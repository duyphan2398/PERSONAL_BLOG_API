<?php

namespace App\Models;

use App\Builders\CategoryBuilder;
use App\Traits\OverridesBuilder;

class Category extends BaseModel
{
    use OverridesBuilder;

    public function provideCustomBuilder()
    {
        return CategoryBuilder::class;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'display_name',
        'file_id',
        'color'
    ];

    public function postCategories(){
        return $this->hasMany(PostCategory::class);
    }

    public function file(){
        return $this->belongsTo(File::class);
    }
}
