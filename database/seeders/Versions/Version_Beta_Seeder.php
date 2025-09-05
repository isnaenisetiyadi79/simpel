<?php

namespace Database\Seeders\Versions;

use App\Models\AppVersion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Version_Beta_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppVersion::create([
            'version'   => 'Beta',
            'title'     => 'Initial Release',
            'changelog' => 'Rilis Beta aplikasi dengan fitur dasar.',
            'is_active' => true,
        ]);

        // DI BAWAH INI CARA MEMBUAT ISI FILE BARU LAGI

        // Matikan versi lama
        // AppVersion::where('is_active', true)->update(['is_active' => false]);

        // Tambah versi baru
        // AppVersion::create([
        //     'version'   => 'v1.1.0',
        //     'title'     => 'Tambah Modul Print',
        //     'changelog' => 'Fitur cetak laporan ditambahkan.',
        //     'is_active' => true,
        // ]);
    }
}
