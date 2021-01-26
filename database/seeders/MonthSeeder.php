<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Month::create(['name' => "Januari",],);
        Month::create(['name' => "Februari"],);
        Month::create(['name' => "Maret"],);
        Month::create(['name' => "April"],);
        Month::create(['name' => "Mei"],);
        Month::create(['name' => "Juni"],);
        Month::create(['name' => "Juli"],);
        Month::create(['name' => "Agustus"],);
        Month::create(['name' => "September"],);
        Month::create(['name' => "Oktober"],);
        Month::create(['name' => "November"],);
        Month::create(['name' => "Desember"],);
    }
}
