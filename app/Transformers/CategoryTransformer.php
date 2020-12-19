<?php

namespace App\Transformers;

use App\Models\Category;
use Flugg\Responder\Transformers\Transformer;

class CategoryTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];


    public function transform(Category $category)
    {
        return [
            'id'            => (string) $category->id,
            'name'          => (string) $category->name,
            'display_name'  => (string) $category->display_name,
            'title'         => (string) $category->title,
            'content'       => (string) $category->content,
            'file'          => (string) optional($category->file)->path,
            'color'         => (string) $category->color
        ];
    }
}
