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
            'owner_id' => '1',
            'size' => '20',
            'harga' => '95000',
        ]);
        $harga = Harga::create([
            'owner_id' => '1',
            'size' => '30',
            'harga' => '79000',
        ]);
        $harga = Harga::create([
            'owner_id' => '1',
            'size' => '40',
            'harga' => '69000',
        ]);
        $harga = Harga::create([
            'owner_id' => '1',
            'size' => '50',
            'harga' => '60000',
        ]);
        $harga = Harga::create([
            'owner_id' => '1',
            'size' => '60',
            'harga' => '58000',
        ]);
        $harga = Harga::create([
            'owner_id' => '1',
            'size' => '70',
            'harga' => '54000',
        ]);
        $harga = Harga::create([
            'owner_id' => '1',
            'size' => '80',
            'harga' => '52000',
        ]);
        $harga = Harga::create([
            'owner_id' => '1',
            'size' => '90',
            'harga' => '48000',
        ]);
        $harga = Harga::create([
            'owner_id' => '1',
            'size' => '100',
            'harga' => '45000',
        ]);
    }
}
