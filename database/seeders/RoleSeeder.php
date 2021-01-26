<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'coordinator',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'subcoordinator',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'staf',
            'guard_name' => 'web'
        ]);
    }
}
