<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Hospital;
use App\Models\HospitalFacility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Hospital::insert([
            'name' => 'RSUD Dr. Soetomo',
            'address' => 'Jl. Mayjen Prof. Dr. Moestopo No.6-8, Surabaya',
            'tenaga_medis' => 150,
            'persentase_ketersediaan_obat_dan_alkes' => 90,
            'indeks_kebersihan' => 85,
            'rata_rata_biaya' => 500000,
            'akreditasi' => 'A',
            'other_details' => 'Rumah sakit rujukan utama di Jawa Timur'
        ]);
        HospitalFacility::insert([
            'hospital_id' => 1,
            'name' => 'IGD 24 Jam',
            'description' => 'Pelayanan gawat darurat tersedia 24 jam'
        ]);
    }
}
