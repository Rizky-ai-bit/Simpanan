<?php

namespace Database\Seeders;

use App\Models\Simpanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SimpanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Simpanan::create([
            'nama'          => 'Udin maulana',
            'nomor_anggota' => 'P-12456',
            'unit'          => 'jmto'
        ]);
    }
}