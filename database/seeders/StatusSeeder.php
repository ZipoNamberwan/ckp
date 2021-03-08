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
        //         1. Belum Entri CKP-T/Belum Entri CKP-T
        // 2. Sedang Entri CKP-T/Sedang Entri CKP-T
        // 3. Sudah Final CKP-T / Belum Entri CKP-R
        // 4. Sedang Entri CKP-R/Sedang Entri CKP-R

        StatusCkp::create([
            'name_1' => 'Belum Entri CKP-T',
            'name_2' => 'Belum Entri CKP-T',
            'color' => 'danger',
        ]);
        StatusCkp::create([
            'name_1' => 'Sedang Entri CKP-T',
            'name_2' => 'Sedang Entri CKP-T',
            'color' => 'primary',
        ]);
        StatusCkp::create([
            'name_1' => 'Sudah Final CKP-T',
            'name_2' => 'Belum Entri CKP-R',
            'color' => 'primary',
        ]);
        StatusCkp::create([
            'name_1' => 'Sedang Entri CKP-R',
            'name_2' => 'Sedang Entri CKP-R',
            'color' => 'primary',
        ]);
        StatusCkp::create([
            'name_1' => 'Sudah Kirim',
            'name_2' => 'Belum Dinilai',
            'color' => 'info',
        ]);
        StatusCkp::create([
            'name_1' => 'Ditolak',
            'name_2' => 'Ditolak',
            'color' => 'danger',
        ]);
        StatusCkp::create([
            'name_1' => 'Sudah Dinilai',
            'name_2' => 'Sudah Dinilai',
            'color' => 'success',
        ]);
    }
}
