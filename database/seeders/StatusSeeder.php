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
            'name_1' => 'Belum Entri',
            'name_2' => 'Belum Entri',
            'color' => 'default',
        ]);
        StatusCkp::create([
            'name_1' => 'Sedang Entri',
            'name_2' => 'Sedang Entri',
            'color' => 'default',
        ]);
        StatusCkp::create([
            'name_1' => 'Submit',
            'name_2' => 'Belum Dinilai',
            'color' => 'default',
        ]);
        StatusCkp::create([
            'name_1' => 'Rejected',
            'name_2' => 'Sedang Entri',
            'color' => 'default',
        ]);
        StatusCkp::create([
            'name_1' => 'Approved',
            'name_2' => 'Sudah Dinilai',
            'color' => 'default',
        ]);
    }
}
