<?php

namespace App\Http\Controllers\API;

use App\Actions\UpdatePostAction;
use App\Filters\CategoryFilter;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Sorts\CategorySort;
use App\Transformers\CategoryTransformer;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /**
     * PostController constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(CategoryFilter $categoryFilter, CategorySort $categorySort)
    {
        return $this->httpOK(
            Category::query()
                ->filter($categoryFilter)
                ->sortBy($categorySort)
                ->paginate($this->per_page),
            CategoryTransformer::class
        );
    }
}
