<?php

namespace App\Models;

use App\Builders\PostBuilder;
use App\Traits\OverridesBuilder;

class Post extends BaseModel
{
    use OverridesBuilder;

    public function provideCustomBuilder()
    {
        return PostBuilder::class;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'content',
        'admin_id',
        'file_id',
        'is_active',
        'created_at',
        'updated_at'
    ];

    /**
     * @var bool
     */
    public $timestamps  = true;

    public function postCategories(){
        return $this->hasMany(PostCategory::class);
    }

    public function file(){
        return $this->belongsTo(File::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
