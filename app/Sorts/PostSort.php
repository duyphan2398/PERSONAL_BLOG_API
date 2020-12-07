<?php

namespace App\Sorts;

use App\Sorts\Sort;
use App\Traits\CommonSort;

class PostSort extends Sort {
    use CommonSort;

    /**
     * Sort model by publish_start_datetime datetime
     *
     * @param  string  $direction
     * @return \App\Builders\Builder
     * @throws \Exception
     */
    public function publish_start_datetime($direction) {
        return $this->query->orderBy('publish_start_datetime', $direction);
    }
}
