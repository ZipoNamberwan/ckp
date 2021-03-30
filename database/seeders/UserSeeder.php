<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Organization;
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
        $organization1 = Organization::create([
            'name' => 'Root',
            'position' => '1',
        ]);

        $root = Department::create([
            'name' => 'Root',
            'position' => '1',
            'organization_id' => $organization1->id
        ]);

        $organization2 = Organization::create([
            'name' => 'BPS Provinsi Nusa Tenggara Timur',
            'position' => '1',
            'parent_id' => $organization1->id
        ]);

        $department1 = Department::create([
            'name' => 'Kepala BPS Provinsi Nusa Tenggara Timur',
            'parent_id' => $root->id,
            'position' => '1',
            'organization_id' => $organization2->id
        ]);

        $department48 = Department::create([
            'name' => 'Statistisi Madya',
            'parent_id' => $department1->id,
            'position' => '1',
            'organization_id' => $organization2->id
        ]);

        $organization3 = Organization::create([
            'name' => 'Bagian Umum',
            'position' => '1',
            'parent_id' => $organization2->id
        ]);

        $department2 = Department::create([
            'name' => 'Kepala Bagian Umum',
            'parent_id' => $department1->id,
            'position' => '1',
            'organization_id' => $organization3->id
        ]);

        $organization9 = Organization::create([
            'name' => 'Fungsi Perencanaan',
            'position' => '1',
            'parent_id' => $organization3->id
        ]);

        $department3 = Department::create([
            'name' => 'Subkoordinator Fungsi Perencanaan',
            'parent_id' => $department2->id,
            'position' => '1',
            'organization_id' => $organization9->id
        ]);

        $department4 = Department::create([
            'name' => 'Staf Fungsi Perencanaan',
            'parent_id' => $department3->id,
            'position' => '1',
            'organization_id' => $organization9->id
        ]);

        $organization10 = Organization::create([
            'name' => 'Fungsi Umum',
            'position' => '1',
            'parent_id' => $organization3->id
        ]);

        $department5 = Department::create([
            'name' => 'Subkoordinator Fungsi Umum',
            'parent_id' => $department2->id,
            'position' => '1',
            'organization_id' => $organization10->id
        ]);

        $department6 = Department::create([
            'name' => 'Staf Fungsi Umum',
            'parent_id' => $department5->id,
            'position' => '1',
            'organization_id' => $organization10->id
        ]);

        $organization11 = Organization::create([
            'name' => 'Fungsi Sumber Daya Manusia dan Hukum',
            'position' => '1',
            'parent_id' => $organization3->id
        ]);

        $department7 = Department::create([
            'name' => 'Subkoordinator Fungsi Sumber Daya Manusia dan Hukum',
            'parent_id' => $department2->id,
            'position' => '1',
            'organization_id' => $organization11->id
        ]);

        $department8 = Department::create([
            'name' => 'Staf Fungsi Sumber Daya Manusia dan Hukum',
            'parent_id' => $department7->id,
            'position' => '1',
            'organization_id' => $organization11->id
        ]);

        $organization12 = Organization::create([
            'name' => 'Fungsi Keuangan',
            'position' => '1',
            'parent_id' => $organization3->id
        ]);

        $department9 = Department::create([
            'name' => 'Subkoordinator Fungsi Keuangan',
            'parent_id' => $department2->id,
            'position' => '1',
            'organization_id' => $organization12->id
        ]);

        $department10 = Department::create([
            'name' => 'Staf Fungsi Keuangan',
            'parent_id' => $department9->id,
            'position' => '1',
            'organization_id' => $organization12->id
        ]);

        $organization13 = Organization::create([
            'name' => 'Fungsi Pengadaan Barang/Jasa',
            'position' => '1',
            'parent_id' => $organization3->id
        ]);

        $department11 = Department::create([
            'name' => 'Subkoordinator Fungsi Pengadaan Barang/Jasa',
            'parent_id' => $department2->id,
            'position' => '1',
            'organization_id' => $organization13->id
        ]);

        $department12 = Department::create([
            'name' => 'Staf Fungsi Pengadaan Barang/Jasa',
            'parent_id' => $department11->id,
            'position' => '1',
            'organization_id' => $organization13->id
        ]);

        $organization4 = Organization::create([
            'name' => 'Fungsi Statistik Sosial',
            'position' => '1',
            'parent_id' => $organization2->id
        ]);

        $department13 = Department::create([
            'name' => 'Koordinator Fungsi Statistik Sosial',
            'parent_id' => $department1->id,
            'position' => '1',
            'organization_id' => $organization4->id
        ]);

        $organization14 = Organization::create([
            'name' => ' Fungsi Statistik Kependudukan',
            'position' => '1',
            'parent_id' => $organization4->id
        ]);

        $department14 = Department::create([
            'name' => 'Subkoordinator Fungsi Statistik Kependudukan',
            'parent_id' => $department13->id,
            'position' => '1',
            'organization_id' => $organization14->id
        ]);

        $department15 = Department::create([
            'name' => 'Staf Fungsi Statistik Kependudukan',
            'parent_id' => $department14->id,
            'position' => '1',
            'organization_id' => $organization14->id
        ]);

        $organization15 = Organization::create([
            'name' => 'Fungsi Statistik Kesejahteraan Rakyat',
            'position' => '1',
            'parent_id' => $organization4->id
        ]);

        $department16 = Department::create([
            'name' => 'Subkoordinator Fungsi Statistik Kesejahteraan Rakyat',
            'parent_id' => $department13->id,
            'position' => '1',
            'organization_id' => $organization15->id
        ]);

        $department17 = Department::create([
            'name' => 'Staf Fungsi Statistik Kesejahteraan Rakyat',
            'parent_id' => $department16->id,
            'position' => '1',
            'organization_id' => $organization15->id
        ]);

        $organization16 = Organization::create([
            'name' => 'Fungsi Statistik Ketahanan Sosial',
            'position' => '1',
            'parent_id' => $organization4->id
        ]);

        $department18 = Department::create([
            'name' => 'Subkoordinator Fungsi Statistik Ketahanan Sosial',
            'parent_id' => $department13->id,
            'position' => '1',
            'organization_id' => $organization16->id
        ]);

        $department19 = Department::create([
            'name' => 'Staf Fungsi Statistik Ketahanan Sosial',
            'parent_id' => $department18->id,
            'position' => '1',
            'organization_id' => $organization16->id
        ]);

        $department60 = Department::create([
            'name' => 'Statistisi Madya Fungsi Statistik Sosial',
            'parent_id' => $department13->id,
            'position' => '1',
            'organization_id' => $organization4->id
        ]);

        $department49 = Department::create([
            'name' => 'Statistisi Muda Fungsi Statistik Sosial',
            'parent_id' => $department13->id,
            'position' => '1',
            'organization_id' => $organization4->id
        ]);

        $department50 = Department::create([
            'name' => 'Statistisi Pertama Fungsi Statistik Sosial',
            'parent_id' => $department13->id,
            'position' => '1',
            'organization_id' => $organization4->id
        ]);

        $organization5 = Organization::create([
            'name' => 'Fungsi Statistik Produksi',
            'position' => '1',
            'parent_id' => $organization2->id
        ]);

        $department20 = Department::create([
            'name' => 'Koordinator Fungsi Statistik Produksi',
            'parent_id' => $department1->id,
            'position' => '1',
            'organization_id' => $organization5->id
        ]);

        $organization17 = Organization::create([
            'name' => 'Fungsi Statistik Pertanian',
            'position' => '1',
            'parent_id' => $organization5->id
        ]);

        $department21 = Department::create([
            'name' => 'Subkoordinator Fungsi Statistik Pertanian',
            'parent_id' => $department20->id,
            'position' => '1',
            'organization_id' => $organization17->id
        ]);

        $department22 = Department::create([
            'name' => 'Staf Fungsi Statistik Pertanian',
            'parent_id' => $department21->id,
            'position' => '1',
            'organization_id' => $organization17->id
        ]);

        $organization18 = Organization::create([
            'name' => 'Fungsi Statistik Statistik Industri',
            'position' => '1',
            'parent_id' => $organization5->id
        ]);

        $department23 = Department::create([
            'name' => 'Subkoordinator Fungsi Statistik Industri',
            'parent_id' => $department20->id,
            'position' => '1',
            'organization_id' => $organization18->id
        ]);

        $department24 = Department::create([
            'name' => 'Staf Fungsi Statistik Industri',
            'parent_id' => $department23->id,
            'position' => '1',
            'organization_id' => $organization18->id
        ]);

        $organization19 = Organization::create([
            'name' => 'Fungsi Statistik Pertambangan, Energi, dan Konstruksi',
            'position' => '1',
            'parent_id' => $organization5->id
        ]);

        $department25 = Department::create([
            'name' => 'Subkoordinator Fungsi Statistik Pertambangan, Energi, dan Konstruksi',
            'parent_id' => $department20->id,
            'position' => '1',
            'organization_id' => $organization19->id
        ]);

        $department26 = Department::create([
            'name' => 'Staf Fungsi Statistik Pertambangan, Energi, dan Konstruksi',
            'parent_id' => $department25->id,
            'position' => '1',
            'organization_id' => $organization19->id
        ]);

        $department61 = Department::create([
            'name' => 'Statistisi Madya Fungsi Statistik Produksi',
            'parent_id' => $department20->id,
            'position' => '1',
            'organization_id' => $organization5->id
        ]);

        $department50 = Department::create([
            'name' => 'Statistisi Muda Fungsi Statistik Produksi',
            'parent_id' => $department20->id,
            'position' => '1',
            'organization_id' => $organization5->id
        ]);

        $department51 = Department::create([
            'name' => 'Statistisi Pertama Fungsi Statistik Produksi',
            'parent_id' => $department20->id,
            'position' => '1',
            'organization_id' => $organization5->id
        ]);

        $organization6 = Organization::create([
            'name' => 'Fungsi Statistik Distribusi',
            'position' => '1',
            'parent_id' => $organization2->id
        ]);

        $department27 = Department::create([
            'name' => 'Koordinator Fungsi Statistik Produksi',
            'parent_id' => $department1->id,
            'position' => '1',
            'organization_id' => $organization6->id
        ]);

        $organization20 = Organization::create([
            'name' => 'Fungsi Statistik Harga Konsumen dan Perdagangan Besar',
            'position' => '1',
            'parent_id' => $organization6->id
        ]);

        $department28 = Department::create([
            'name' => 'Subkoordinator Fungsi Statistik Harga Konsumen dan Perdagangan Besar',
            'parent_id' => $department27->id,
            'position' => '1',
            'organization_id' => $organization20->id
        ]);

        $department29 = Department::create([
            'name' => 'Staf Fungsi Statistik Harga Konsumen dan Perdagangan Besar',
            'parent_id' => $department28->id,
            'position' => '1',
            'organization_id' => $organization20->id
        ]);

        $organization21 = Organization::create([
            'name' => 'Fungsi Statistik Keuangan dan Harga Produsen',
            'position' => '1',
            'parent_id' => $organization6->id
        ]);

        $department30 = Department::create([
            'name' => 'Subkoordinator Fungsi Statistik Keuangan dan Harga Produsen',
            'parent_id' => $department27->id,
            'position' => '1',
            'organization_id' => $organization21->id
        ]);

        $department31 = Department::create([
            'name' => 'Staf Fungsi Statistik Keuangan dan Harga Produsen',
            'parent_id' => $department30->id,
            'position' => '1',
            'organization_id' => $organization21->id
        ]);

        $organization22 = Organization::create([
            'name' => 'Fungsi Statistik Niaga dan Jasa',
            'position' => '1',
            'parent_id' => $organization6->id
        ]);

        $department32 = Department::create([
            'name' => 'Subkoordinator Fungsi Statistik Niaga dan Jasa',
            'parent_id' => $department27->id,
            'position' => '1',
            'organization_id' => $organization22->id
        ]);

        $department33 = Department::create([
            'name' => 'Staf Fungsi Statistik Niaga dan Jasa',
            'parent_id' => $department32->id,
            'position' => '1',
            'organization_id' => $organization22->id
        ]);

        $department62 = Department::create([
            'name' => 'Statistisi Madya Fungsi Statistik Distribusi',
            'parent_id' => $department27->id,
            'position' => '1',
            'organization_id' => $organization6->id
        ]);

        $department52 = Department::create([
            'name' => 'Statistisi Muda Fungsi Statistik Distribusi',
            'parent_id' => $department27->id,
            'position' => '1',
            'organization_id' => $organization6->id
        ]);

        $department53 = Department::create([
            'name' => 'Statistisi Pertama Fungsi Statistik Distribusi',
            'parent_id' => $department27->id,
            'position' => '1',
            'organization_id' => $organization6->id
        ]);

        $organization7 = Organization::create([
            'name' => 'Fungsi Neraca Wilayah dan Analisis Statistik',
            'position' => '1',
            'parent_id' => $organization2->id
        ]);

        $department34 = Department::create([
            'name' => 'Koordinator Fungsi Neraca Wilayah dan Analisis Statistik',
            'parent_id' => $department1->id,
            'position' => '1',
            'organization_id' => $organization7->id
        ]);

        $organization23 = Organization::create([
            'name' => 'Fungsi Neraca Produksi',
            'position' => '1',
            'parent_id' => $organization7->id
        ]);

        $department35 = Department::create([
            'name' => 'Subkoordinator Fungsi Neraca Produksi',
            'parent_id' => $department34->id,
            'position' => '1',
            'organization_id' => $organization23->id
        ]);

        $department36 = Department::create([
            'name' => 'Staf Fungsi Neraca Produksi',
            'parent_id' => $department35->id,
            'position' => '1',
            'organization_id' => $organization23->id
        ]);

        $organization24 = Organization::create([
            'name' => 'Fungsi Neraca Konsumsi',
            'position' => '1',
            'parent_id' => $organization7->id
        ]);

        $department37 = Department::create([
            'name' => 'Subkoordinator Fungsi Neraca Konsumsi',
            'parent_id' => $department34->id,
            'position' => '1',
            'organization_id' => $organization24->id
        ]);

        $department38 = Department::create([
            'name' => 'Staf Fungsi Neraca Konsumsi',
            'parent_id' => $department37->id,
            'position' => '1',
            'organization_id' => $organization24->id
        ]);

        $organization25 = Organization::create([
            'name' => 'Fungsi Analisis Statistik Lintas Sektor',
            'position' => '1',
            'parent_id' => $organization7->id
        ]);

        $department39 = Department::create([
            'name' => 'Subkoordinator Fungsi Analisis Statistik Lintas Sektor',
            'parent_id' => $department34->id,
            'position' => '1',
            'organization_id' => $organization25->id
        ]);

        $department40 = Department::create([
            'name' => 'Staf Fungsi Analisis Statistik Lintas Sektor',
            'parent_id' => $department39->id,
            'position' => '1',
            'organization_id' => $organization25->id
        ]);

        $department63 = Department::create([
            'name' => 'Statistisi Madya Fungsi Neraca Wilayah dan Analisis Statistik',
            'parent_id' => $department34->id,
            'position' => '1',
            'organization_id' => $organization7->id
        ]);

        $department54 = Department::create([
            'name' => 'Statistisi Muda Fungsi Neraca Wilayah dan Analisis Statistik',
            'parent_id' => $department34->id,
            'position' => '1',
            'organization_id' => $organization7->id
        ]);

        $department55 = Department::create([
            'name' => 'Statistisi Pertama Fungsi Neraca Wilayah dan Analisis Statistik',
            'parent_id' => $department34->id,
            'position' => '1',
            'organization_id' => $organization7->id
        ]);

        $organization8 = Organization::create([
            'name' => 'Fungsi Integrasi Pengolahan dan Diseminasi Statistik',
            'position' => '1',
            'parent_id' => $organization2->id
        ]);

        $department41 = Department::create([
            'name' => 'Koordinator Fungsi Integrasi Pengolahan dan Diseminasi Statistik',
            'parent_id' => $department1->id,
            'position' => '1',
            'organization_id' => $organization8->id
        ]);

        $organization26 = Organization::create([
            'name' => 'Fungsi Integrasi Pengolahan Data',
            'position' => '1',
            'parent_id' => $organization8->id
        ]);

        $department42 = Department::create([
            'name' => 'Subkoordinator Fungsi Integrasi Pengolahan Data',
            'parent_id' => $department41->id,
            'position' => '1',
            'organization_id' => $organization26->id
        ]);

        $department43 = Department::create([
            'name' => 'Staf Fungsi Integrasi Pengolahan Data',
            'parent_id' => $department42->id,
            'position' => '1',
            'organization_id' => $organization26->id
        ]);

        $organization27 = Organization::create([
            'name' => 'Fungsi Jaringan dan Rujukan Statistik',
            'position' => '1',
            'parent_id' => $organization8->id
        ]);

        $department44 = Department::create([
            'name' => 'Subkoordinator Fungsi Jaringan dan Rujukan Statistik',
            'parent_id' => $department41->id,
            'position' => '1',
            'organization_id' => $organization27->id
        ]);

        $department45 = Department::create([
            'name' => 'Staf Fungsi Jaringan dan Rujukan Statistik',
            'parent_id' => $department44->id,
            'position' => '1',
            'organization_id' => $organization27->id
        ]);

        $organization28 = Organization::create([
            'name' => 'Fungsi Diseminasi dan Layanan Statistik',
            'position' => '1',
            'parent_id' => $organization8->id
        ]);

        $department46 = Department::create([
            'name' => 'Subkoordinator Fungsi Diseminasi dan Layanan Statistik',
            'parent_id' => $department41->id,
            'position' => '1',
            'organization_id' => $organization28->id
        ]);

        $department47 = Department::create([
            'name' => 'Staf Fungsi Diseminasi dan Layanan Statistik',
            'parent_id' => $department46->id,
            'position' => '1',
            'organization_id' => $organization28->id
        ]);

        $department56 = Department::create([
            'name' => 'Statistisi Muda Fungsi Integrasi Pengolahan dan Diseminasi Statistik',
            'parent_id' => $department41->id,
            'position' => '1',
            'organization_id' => $organization8->id
        ]);

        $department57 = Department::create([
            'name' => 'Statistisi Pertama Fungsi Integrasi Pengolahan dan Diseminasi Statistik',
            'parent_id' => $department41->id,
            'position' => '1',
            'organization_id' => $organization8->id
        ]);

        $department58 = Department::create([
            'name' => 'Pranata Komputer Muda Fungsi Integrasi Pengolahan dan Diseminasi Statistik',
            'parent_id' => $department41->id,
            'position' => '1',
            'organization_id' => $organization8->id
        ]);

        $department59 = Department::create([
            'name' => 'Pranata Komputer Pertama Fungsi Integrasi Pengolahan dan Diseminasi Statistik',
            'parent_id' => $department41->id,
            'position' => '1',
            'organization_id' => $organization8->id
        ]);

        // $organization6 = Organization::create([
        //     'name' => 'Fungsi DLS',
        //     'position' => '1',
        //     'parent_id' => $organization3->id
        // ]);

        // $ipds = Department::create([
        //     'name' => 'Koordinator IPDS',
        //     'parent_id' => $head->id,
        //     'position' => '1',
        //     'organization_id' => $organization3->id
        // ]);

        // $ipd = Department::create([
        //     'name' => 'Sub Koordinator IPD',
        //     'position' => '1',
        //     'parent_id' => $ipds->id,
        //     'organization_id' => $organization4->id
        // ]);

        // $stafipd = Department::create([
        //     'name' => 'Staf IPD',
        //     'position' => '1',
        //     'parent_id' => $ipd->id,
        //     'organization_id' => $organization4->id
        // ]);

        // $jrs = Department::create([
        //     'name' => 'Sub Koordinator JRS',
        //     'position' => '2',
        //     'parent_id' => $ipds->id,
        //     'organization_id' => $organization5->id
        // ]);

        // $stafjrs = Department::create([
        //     'name' => 'Staf JRS',
        //     'position' => '1',
        //     'parent_id' => $jrs->id,
        //     'organization_id' => $organization5->id
        // ]);

        // $dls = Department::create([
        //     'name' => 'Sub Koordinator DLS',
        //     'position' => '3',
        //     'parent_id' => $ipds->id,
        //     'organization_id' => $organization6->id
        // ]);

        // $stafdls = Department::create([
        //     'name' => 'Staf DLS',
        //     'position' => '3',
        //     'parent_id' => $dls->id,
        //     'organization_id' => $organization6->id
        // ]);

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
            'email' => 'darwis@bps.go.id',
            'password' => bcrypt('123456'),
            'nip' => '19650801 198901 1 002',
            'nipold' => '12046',
            'assessor_id' => 1,
            'department_id' => 2,
        ]);
        $kabps->assignRole('supervisor');

        // $coordinator = User::create([
        //     'name' => 'Tio',
        //     'email' => 'tio@bps.go.id',
        //     'password' => bcrypt('123456'),
        //     'nip' => '123456789',
        //     'assessor_id' => 2,
        //     'department_id' => $ipds->id,
        // ]);
        // $coordinator->assignRole('supervisor');

        // $subcoordinator = User::create([
        //     'name' => 'Iva',
        //     'email' => 'iva@bps.go.id',
        //     'password' => bcrypt('123456'),
        //     'nip' => '123456789',
        //     'assessor_id' => 3,
        //     'department_id' => $ipd->id,
        // ]);
        // $subcoordinator->assignRole('supervisor');

        // $subcoordinator2 = User::create([
        //     'name' => 'Andri',
        //     'email' => 'andri@bps.go.id',
        //     'password' => bcrypt('123456'),
        //     'nip' => '123456789',
        //     'assessor_id' => 3,
        //     'department_id' => $jrs->id,
        // ]);
        // $subcoordinator2->assignRole('supervisor');

        // $staf = User::create([
        //     'name' => 'Indra',
        //     'email' => 'indra@bps.go.id',
        //     'password' => bcrypt('123456'),
        //     'nip' => '123456789',
        //     'assessor_id' => 4,
        //     'department_id' => $stafipd->id,
        // ]);
        // $staf->assignRole('user');

        // $staf2 = User::create([
        //     'name' => 'Jati',
        //     'email' => 'jati@bps.go.id',
        //     'password' => bcrypt('123456'),
        //     'nip' => '123456789',
        //     'assessor_id' => 4,
        //     'department_id' => $stafipd->id,
        // ]);
        // $staf2->assignRole('user');

        // $staf3 = User::create([
        //     'name' => 'Stephen',
        //     'email' => 'stephen@bps.go.id',
        //     'password' => bcrypt('123456'),
        //     'nip' => '123456789',
        //     'assessor_id' => 4,
        //     'department_id' => $stafipd->id,
        // ]);
        // $staf3->assignRole('user');

        // $staf4 = User::create([
        //     'name' => 'Minan',
        //     'email' => 'minan@bps.go.id',
        //     'password' => bcrypt('123456'),
        //     'nip' => '123456789',
        //     'assessor_id' => 5,
        //     'department_id' => $stafdls->id,
        // ]);
        // $staf4->assignRole('user');
    }
}
