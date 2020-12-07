<?php

namespace App\Actions;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class UpdateAdminAction
{
    /**
     * @param array $data
     * @return mixed
     */
    public function execute(array $data)
    {
        return DB::transaction(function () use ($data) {
            $admin = Arr::get($data, 'password') ?
                Route::current()->admin->update($data) :
                Route::current()->admin->update(Arr::except($data, ['password']));

            return $admin;
        });
    }
}