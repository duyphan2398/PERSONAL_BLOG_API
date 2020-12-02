<?php

namespace App\Http\Controllers\API;

use App\Actions\CreateNewsAction;
use App\Actions\UpdateNewsAction;
use App\Exceptions\UploadFileException;
use App\Filters\NewsFilter;
use App\Http\Requests\CreateNewsRequest;
use App\Models\News;
use App\Http\Requests\UpdateNewsRequest;

use App\Sorts\NewsSort;
use App\Transformers\NewsTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends ApiController
{

    /**
     * NewsController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\AwsS3Service $awsS3Service
     */
    public function __construct(Request $request, AwsS3Service $awsS3Service)
    {
        parent::__construct($request);
        $this->authorizeResource(News::class);
    }

    /**
     * @param \App\Filters\NewsFilter $filter
     * @param \App\Sorts\NewsSort $sort
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function index(NewsFilter $filter, NewsSort $sort)
    {
        return $this->httpOK(
            News::query()
                ->filter($filter)
                ->sortBy($sort)
                ->paginate($this->per_page),
            NewsTransformer::class
        );
    }

    /**
     * @param \App\Http\Requests\CreateNewsRequest $request
     * @param \App\Actions\CreateNewsAction $action
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function store(CreateNewsRequest $request, CreateNewsAction $action)
    {
        $news = $action->execute($request->validated());

        return $this->httpCreated($news, NewsTransformer::class);
    }

    /**
     * @param \App\Http\Requests\UpdateNewsRequest $request
     * @param \App\Models\News $news
     * @param \App\Actions\UpdateNewsAction $action
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateNewsRequest $request, News $news, UpdateNewsAction $action)
    {
        $action->execute($request->validated());

        return $this->httpNoContent();
    }

    /**
     * @param \App\Models\News $news
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function show(News $news)
    {
        return $this->httpOK($news, NewsTransformer::class);
    }

    /**
     * @param News $news
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        Storage::disk('s3')->delete($news->thumbnail);
        $news->delete();

        return $this->httpNoContent();
    }
}
