<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = User::create([
            'name' => 'User Staff',
            'email'=>'user@bps.go.id',
            'password'=>bcrypt('123456')]);
        $staff->assignRole('staf');

        $admin = User::create([
            'name' => 'User Admin',
            'email'=>'admin@bps.go.id',
            'password'=>bcrypt('123456')]);
        $admin->assignRole('kabid');
    }
}
