<?php

namespace App\Sorts;

use App\Traits\CommonSort;

class AdminSort extends Sort
{
    use CommonSort;

    public function name($direction)
    {
        return $this->query->orderBy('name', $direction);
    }
}