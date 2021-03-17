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
            'color' => 'danger',
        ]);
        StatusCkp::create([
            'name_1' => 'Sedang Entri',
            'name_2' => 'Sedang Entri',
            'color' => 'primary',
        ]);
        StatusCkp::create([
            'name_1' => 'Submit',
            'name_2' => 'Belum Dinilai',
            'color' => 'info',
        ]);
        StatusCkp::create([
            'name_1' => 'Rejected',
            'name_2' => 'Rejected',
            'color' => 'danger',
        ]);
        StatusCkp::create([
            'name_1' => 'Approved',
            'name_2' => 'Sudah Dinilai',
            'color' => 'success',
        ]);
    }
}
