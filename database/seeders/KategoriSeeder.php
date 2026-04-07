<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Kategori::insert([
        ['ket_kategori' => 'Kebersihan'],
        ['ket_kategori' => 'Fasilitas'],
        ['ket_kategori' => 'Keamanan'],
    ]);
}
}
