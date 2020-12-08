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
     * @param $startTime
     * @return \App\Builders\Builder
     */
    public function publishStartDatetime($startTime)
    {
        return $this->query
            ->whereDateRange('created_at', ['from' => $startTime]);
    }

    /**
     * @param $endTime
     * @return \App\Builders\Builder
     */
    public function publishEndDatetime($endTime)
    {
        return $this->query
            ->whereDateRange('created_at', ['to' => $endTime]);
    }

    /**
     * @param $categoryId
     * @return \App\Builders\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function categoryId($categoryId)
    {
        return $this->query->whereHas('postCategories', function ($query) use ($categoryId){
            $query->whereIn('category_id', $categoryId);
        });
    }
}
