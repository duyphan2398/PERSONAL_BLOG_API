<?php

namespace App\Http\Controllers\API;

use App\Actions\CreatePostAction;
use App\Actions\UpdatePostAction;
use App\Filters\PostFilter;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Sorts\PostSort;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends ApiController
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
     * @param \App\Filters\PostFilter $postFilter
     * @param \App\Sorts\PostSort $postSort
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function index(PostFilter $postFilter, PostSort $postSort)
    {
        return $this->httpOK(
            Post::query()
                ->filter($postFilter)
                ->sortBy($postSort)
                ->paginate($this->per_page),
            PostTransformer::class
        );
    }

    public function indexBlog(PostFilter $postFilter, PostSort $postSort){
        return $this->httpOK(
            Post::query()
                ->where('is_active', 1)
                ->filter($postFilter)
                ->sortBy($postSort)
                ->paginate($this->per_page),
            PostTransformer::class
        );
    }


    public function store(CreatePostRequest $request, CreatePostAction $action)
    {
        $post = $action->execute($request->validated());

        return $this->httpCreated($post, PostTransformer::class);
    }

    /**
     * @param \App\Http\Requests\UpdatePostRequest $updatePostRequest
     * @param \App\Models\Post $post
     * @param \App\Actions\UpdatePostAction $updatePostAction
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function update(UpdatePostRequest $updatePostRequest, Post $post, UpdatePostAction $updatePostAction)
    {
        DB::beginTransaction();
        try {
            $updatePostAction->execute($updatePostRequest->validated(), $post);
            DB::commit();
            return $this->httpNoContent();
        }catch (\Exception $exception){
            DB::rollBack();
            return $this->httpBadRequest(['message' => $exception->getMessage()]);
        }

    }


    public function show(Post $post)
    {
        return $this->httpOK($post, PostTransformer::class);
    }


    public function destroy(Post $post)
    {
        DB::beginTransaction();
        try {
            Storage::disk('public')->deleteDirectory('POST/THUMBNAIL/'.$post->id);
            $post->postCategories()->delete();
            $post->delete();
            DB::commit();
            return $this->httpNoContent();
        }catch (\Exception $exception){
            DB::rollBack();
            return $this->httpBadRequest(['message' => $exception->getMessage()]);
        }
    }

    /**
     * @param $slug
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function showWithSlug($slug){
        $post = Post::query()->where('is_active', 1)->firstWhere('slug', $slug);
        if ($post){
            return $this->httpOK($post, PostTransformer::class);
        }
        return $this->httpNotFound();
    }
}
