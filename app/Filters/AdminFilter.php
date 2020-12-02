<?php

namespace App\Filters;

use App\Traits\CommonFilter;

class AdminFilter extends Filter
{
    use CommonFilter;
    /**
     * @param $name
     * @return \App\Builders\Builder
     */
    public function name($name)
    {
        return $this->query->whereLike('name', $name);
    }

    /**
     * @param $loginId
     * @return \App\Builders\Builder
     */
    public function loginId($loginId)
    {
        return $this->query->whereLike('login_id', $loginId);
    }

    /**
     * @param $isActive
     * @return \App\Builders\Builder
     */
    public function isActive($isActive)
    {
        return $this->query->where('is_active', $isActive);
    }

    /**
     * @param $roleId
     * @return \App\Builders\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function roleId($roleId)
    {
        return $this->query->whereHas('roles', function ($query) use ($roleId) {
            $query->where('id', $roleId);
        });
    }
}