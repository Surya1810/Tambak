<?php

namespace Database\Seeders;

use App\Models\Harga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $harga = Harga::create([
            'size' => '20',
            'harga' => '95000',
        ]);
        $harga = Harga::create([
            'size' => '30',
            'harga' => '79000',
        ]);
        $harga = Harga::create([
            'size' => '40',
            'harga' => '69000',
        ]);
        $harga = Harga::create([
            'size' => '50',
            'harga' => '60000',
        ]);
        $harga = Harga::create([
            'size' => '60',
            'harga' => '58000',
        ]);
        $harga = Harga::create([
            'size' => '70',
            'harga' => '54000',
        ]);
        $harga = Harga::create([
            'size' => '80',
            'harga' => '52000',
        ]);
        $harga = Harga::create([
            'size' => '90',
            'harga' => '48000',
        ]);
        $harga = Harga::create([
            'size' => '100',
            'harga' => '45000',
        ]);
    }
}
