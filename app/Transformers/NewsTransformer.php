<?php

namespace App\Transformers;

use App\Models\News;

//use App\Transformers\Companies\CompanyTransformer;
//use App\Transformers\Shared\PrefectureTransformer;

use Carbon\Carbon;
use Flugg\Responder\Transformers\Transformer;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class NewsTransformer extends Transformer
{

    private $awsS3Service;

    public function __construct(AwsS3Service $awsS3Service)
    {
        $this->awsS3Service = $awsS3Service;
    }

    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        //'company'       => CompanyTransformer::class,
        //'news_category' => NewsCategoryTransformer::class,
        //'prefectures'   => PrefectureTransformer::class,
    ];

    /**
     * List of auto loaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * @param \App\Models\News $news
     * @return array
     */
    public function transform(News $news)
    {
        return [
            'id'                     => (string) $news->id,
            'category_id'            => (string) $news->category_id,
            'movie_id'               => (string) $news->movie_id,
            'display_type'           => (string) $news->display_type,
            'title'                  => (string) $news->title,
            'text'                   => $this->extendResignedURL($news->text),
            'url'                    => (string) $news->url,
            'thumbnail'              => (string) $this->awsS3Service->getURlAccessImage($news->thumbnail),
            'publish_start_datetime' => (string) date('Y-m-d H:i', strtotime($news->publish_start_datetime)),
            'publish_end_datetime'   => (string) date('Y-m-d H:i', strtotime($news->publish_end_datetime)),
            'is_pushed'              => (bool) $news->is_pushed,
            'is_preview'             => (bool) $news->is_preview,
            'is_active'              => (bool) $news->is_active,
            'created_at'             => (string) $news->created_at,
            'updated_at'             => (string) $news->updated_at,
            'deleted_at'             => (string) $news->deleted_at,
        ];
    }

    function extendResignedURL($text)
    {
        $doc = new \DOMDocument();
        $doc->loadHTML($text);

        $imageTags = $doc->getElementsByTagName('img');

        //Loop through the image tags that DOMDocument found.
        foreach ($imageTags as $imageTag) {
            $url = parse_url($imageTag->getAttribute('src'));
            $text = str_replace(str_replace('&', '&amp;', $imageTag->getAttribute('src')), $this->awsS3Service->getURlAccessImage(substr($url['path'], 1)), $text);
        }

        return $text;
    }
}
