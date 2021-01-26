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
            'name' => 'Belum Entri'
        ]);
        StatusCkp::create([
            'name' => 'Sedang Entri'
        ]);
        StatusCkp::create([
            'name' => 'Submit'
        ]);
        StatusCkp::create([
            'name' => 'Reject'
        ]);
        StatusCkp::create([
            'name' => 'Approve'
        ]);
        StatusCkp::create([
            'name' => 'Sudah Dinilai'
        ]);
    }
}
