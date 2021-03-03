<?php

namespace Database\Seeders;

use App\Models\ActivityCkpR;
use App\Models\ActivityCkpT;
use App\Models\Ckp;
use Illuminate\Database\Seeder;

class CkpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ckp =Ckp::create([
            'user_id' => '6',
            'month_id' => '2',
            'year_id' => '1',
            'status_id' => '2',
        ]);

        ActivityCkpR::create([
            'ckp_id' => $ckp->id,
            'type' => 'main',
            'name' => 'Mengikuti pelatihan sakernas main',
            'unit' => 'Kegiatan',
            'target' => '1',
            'real' => '1',
            'quality' => '100',
            'note' => 'test kegiatan'
        ]);

        ActivityCkpR::create([
            'ckp_id' => $ckp->id,
            'type' => 'main',
            'name' => 'Activity 2',
            'unit' => 'Kegiatan',
            'target' => '1',
            'real' => '1',
            'quality' => '100',
            'note' => 'test kegiatan'
        ]);

        ActivityCkpR::create([
            'ckp_id' => $ckp->id,
            'type' => 'additional',
            'name' => 'Mengikuti pelatihan sakernas add',
            'unit' => 'Kegiatan',
            'target' => '1',
            'real' => '1',
            'quality' => '100',
            'note' => 'test kegiatan'
        ]);

        //
        ActivityCkpT::create([
            'ckp_id' => $ckp->id,
            'type' => 'main',
            'name' => 'Mengikuti pelatihan sakernas main CKP-T',
            'unit' => 'Kegiatan',
            'target' => '1',
            'note' => 'test kegiatan'
        ]);

        ActivityCkpT::create([
            'ckp_id' => $ckp->id,
            'type' => 'main',
            'name' => 'Activity 2 CKP-T',
            'unit' => 'Kegiatan',
            'target' => '1',
            'note' => 'test kegiatan'
        ]);

        ActivityCkpT::create([
            'ckp_id' => $ckp->id,
            'type' => 'additional',
            'name' => 'Mengikuti pelatihan sakernas add CKP-T',
            'unit' => 'Kegiatan',
            'target' => '1',
            'note' => 'test kegiatan'
        ]);
    }
}
