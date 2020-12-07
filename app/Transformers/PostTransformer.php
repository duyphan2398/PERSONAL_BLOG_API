<?php

namespace App\Transformers;

use App\Models\Post;
use Flugg\Responder\Transformers\Transformer;

class PostTransformer extends Transformer
{

    /**
     * List of auto loaded default relations.
     *
     * @var array
     */
    protected $load = [
        'admin' => AdminTransformer::class
    ];


    public function transform(Post $post)
    {
        return [
            'id'                     => (string) $post->id,
            'title'                  => (string) $post->text,
            'content'                => (string) $post->content,
            'file'                   => (string) optional($post->file)->path,
            'is_active'              => (int) $post->is_active,
            'created_at'             => (string) $post->created_at,
            'updated_at'             => (string) $post->updated_at
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
