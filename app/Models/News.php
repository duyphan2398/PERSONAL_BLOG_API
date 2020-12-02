<?php

namespace App\Models;

use App\Builders\NewsBuilder;

class News extends BaseModel
{
    public function provideCustomBuilder()
    {
        return NewsBuilder::class;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'movie_id',
        'display_type',
        'title',
        'text',
        'thumbnail',
        'url',
        'publish_start_datetime',
        'publish_end_datetime',
        'is_pushed',
        'is_preview',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
