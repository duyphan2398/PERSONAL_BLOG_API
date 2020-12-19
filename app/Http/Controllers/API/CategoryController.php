<?php

namespace App\Http\Controllers\API;

use App\Actions\UpdateCategoryAction;
use App\Actions\UpdatePostAction;
use App\Filters\CategoryFilter;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Sorts\CategorySort;
use App\Transformers\CategoryTransformer;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param \App\Filters\CategoryFilter $categoryFilter
     * @param \App\Sorts\CategorySort $categorySort
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
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

    /**
     * @param \App\Models\Category $category
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function show(Category $category){
        {
            return $this->httpOK($category, CategoryTransformer::class);
        }
    }

    /**
     * @param \App\Http\Requests\UpdateCategoryRequest $updateCategoryRequest
     * @param \App\Models\Category $category
     * @param \App\Actions\UpdateCategoryAction $updateCategoryAction
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryRequest $updateCategoryRequest, Category $category, UpdateCategoryAction $updateCategoryAction)
    {
        DB::beginTransaction();
        try {
            $updateCategoryAction->execute($updateCategoryRequest->validated(), $category);

            DB::commit();
            return $this->httpNoContent();
        }catch (\Exception $exception){
            DB::rollBack();
            return $this->httpBadRequest(['message' => $exception->getMessage()]);
        }

    }
}
