<?php

use App\Enums\AdminType;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'     => 'duypn_developer',
            'login_id' => 'superadmin',
            'password' => '123123123'
        ]);
    }
}