<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Movie;
use App\Models\MovieGroup;
use App\Models\News;
use App\Models\Permission;
use App\Models\Push;
use App\Models\PushCategory;
use App\Models\Role;
use App\Models\TopContent;
use App\Policies\AdminPolicy;
use App\Policies\MovieGroupPolicy;
use App\Policies\MoviePolicy;
use App\Policies\NewsPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\PushCategoryPolicy;
use App\Policies\PushPolicy;
use App\Policies\RolePolicy;
use App\Policies\TopContentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
