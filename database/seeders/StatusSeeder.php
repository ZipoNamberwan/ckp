<?php

namespace Database\Seeders;

use App\Models\StatusCkp;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusCkp::create([
            'name' => 'Belum Entri',
            'color' => 'default',
        ]);
        StatusCkp::create([
            'name' => 'Sedang Entri',
            'color' => 'default',
        ]);
        StatusCkp::create([
            'name' => 'Submit',
            'color' => 'default',
        ]);
        StatusCkp::create([
            'name' => 'Reject',
            'color' => 'default',
        ]);
        StatusCkp::create([
            'name' => 'Approve',
            'color' => 'default',
        ]);
        StatusCkp::create([
            'name' => 'Sudah Dinilai',
            'color' => 'default',
        ]);
    }
}
