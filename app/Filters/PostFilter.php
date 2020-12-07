<?php

namespace App\Filters;

class PostFilter extends Filter
{
    /**
     * @param $title
     * @return \App\Builders\Builder
     */
    public function title($title)
    {
        return $this->query->whereLike('title', $title);
    }

    /**
     * Filter content by active
     *
     * @param $isActive
     * @return \App\Builders\Builder
     */
    public function isActive($isActive)
    {
        return $this->query->where('is_active', $isActive);
    }

    /**
     * @param $isPushed
     * @return \App\Builders\Builder
     */
    public function isPushed($isPushed)
    {
        return $this->query->where('is_pushed', $isPushed);
    }

    /**
     * @param $isPreview
     * @return \App\Builders\Builder
     */
    public function isPreview($isPreview)
    {
        return $this->query->where('is_preview', $isPreview);
    }

    /**
     * @param $startTime
     * @return \App\Builders\Builder
     */
    public function publishStartDatetime($startTime)
    {
        return $this->query
            ->whereDateRange('publish_start_datetime', ['from' => $startTime]);
    }

    /**
     * @param $endTime
     * @return \App\Builders\Builder
     */
    public function publishEndDatetime($endTime)
    {
        return $this->query
            ->whereDateRange('publish_end_datetime', ['to' => $endTime]);
    }

    /**
     *
     * @param $category_id
     * @return \App\Builders\Builder
     */
    public function categoryId($categoryId)
    {
        return $this->query->where('category_id', $categoryId);
    }
}
