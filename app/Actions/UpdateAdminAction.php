<?php

namespace App\Actions;

use App\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class UpdateAdminAction implements BaseAction
{
    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data)
    {
        return DB::transaction(function () use ($data) {
            $admin = Arr::get($data, 'password') ?
                Route::current()->admin->update(Arr::except($data, 'role_id')) :
                Route::current()->admin->update(Arr::except($data, ['role_id', 'password']));
            Route::current()->admin->syncRoles(Role::where('id', Arr::get($data, 'role_id'))->get());

            return $admin;
        });
    }
}