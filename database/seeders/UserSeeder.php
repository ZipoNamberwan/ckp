<?php

namespace Database\Seeders;

use App\Models\Department;
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
        $root = Department::create([
            'name' => 'Root',
            'position' => '1',
        ]);

        $head = Department::create([
            'name' => 'Kepala BPS Provinsi NTT',
            'parent_id' => $root->id,
            'position' => '1',
        ]);

        $ipds = Department::create([
            'name' => 'Koordinator IPDS',
            'parent_id' => $head->id,
            'position' => '1',
        ]);

        $ipd = Department::create([
            'name' => 'Sub Koordinator IPD',
            'position' => '1',
            'parent_id' => $ipds->id,
        ]);

        $stafipd = Department::create([
            'name' => 'Staf IPD',
            'position' => '1',
            'parent_id' => $ipd->id,
        ]);

        $jrs = Department::create([
            'name' => 'Sub Koordinator JRS',
            'position' => '2',
            'parent_id' => $ipds->id
        ]);

        $stafjrs = Department::create([
            'name' => 'Staf JRS',
            'position' => '1',
            'parent_id' => $jrs->id,
        ]);

        $dls = Department::create([
            'name' => 'Sub Koordinator DLS',
            'position' => '3',
            'parent_id' => $ipds->id
        ]);

        $stafdls = Department::create([
            'name' => 'Staf DLS',
            'position' => '3',
            'parent_id' => $dls->id
        ]);

        $superadmin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@bps.go.id',
            'password' => bcrypt('123456'),
            'nip' => '123456789',
            //'assessor_id' => 1,
            'department_id' => $root->id,
        ]);
        $superadmin->assignRole('admin');

        $kabps = User::create([
            'name' => 'Kepala BPS Provinsi NTT',
            'email' => 'kabps@bps.go.id',
            'password' => bcrypt('123456'),
            'nip' => '123456789',
            'assessor_id' => 1,
            'department_id' => $head->id,
        ]);
        $kabps->assignRole('supervisor');

        $coordinator = User::create([
            'name' => 'Tio',
            'email' => 'tio@bps.go.id',
            'password' => bcrypt('123456'),
            'nip' => '123456789',
            'assessor_id' => 2,
            'department_id' => $ipds->id,
        ]);
        $coordinator->assignRole('supervisor');

        $subcoordinator = User::create([
            'name' => 'Iva',
            'email' => 'iva@bps.go.id',
            'password' => bcrypt('123456'),
            'nip' => '123456789',
            'assessor_id' => 3,
            'department_id' => $ipd->id,
        ]);
        $subcoordinator->assignRole('supervisor');

        $subcoordinator2 = User::create([
            'name' => 'Andri',
            'email' => 'andri@bps.go.id',
            'password' => bcrypt('123456'),
            'nip' => '123456789',
            'assessor_id' => 3,
            'department_id' => $jrs->id,
        ]);
        $subcoordinator2->assignRole('supervisor');

        $staf = User::create([
            'name' => 'Indra',
            'email' => 'indra@bps.go.id',
            'password' => bcrypt('123456'),
            'nip' => '123456789',
            'assessor_id' => 4,
            'department_id' => $stafipd->id,
        ]);
        $staf->assignRole('user');

        $staf2 = User::create([
            'name' => 'Jati',
            'email' => 'jati@bps.go.id',
            'password' => bcrypt('123456'),
            'nip' => '123456789',
            'assessor_id' => 4,
            'department_id' => $stafipd->id,
        ]);
        $staf2->assignRole('user');

        $staf3 = User::create([
            'name' => 'Stephen',
            'email' => 'stephen@bps.go.id',
            'password' => bcrypt('123456'),
            'nip' => '123456789',
            'assessor_id' => 4,
            'department_id' => $stafipd->id,
        ]);
        $staf3->assignRole('user');

        $staf4 = User::create([
            'name' => 'Minan',
            'email' => 'minan@bps.go.id',
            'password' => bcrypt('123456'),
            'nip' => '123456789',
            'assessor_id' => 5,
            'department_id' => $stafdls->id,
        ]);
        $staf4->assignRole('user');
    }
}
