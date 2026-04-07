<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    \App\Models\Admin::create([
        'username' => 'admin',
        'password' => Hash::make('admin123'), // Passwordnya nanti: admin123
    ]);

    // Tambahkan kategori biar pilihan di input aspirasi muncul
    \App\Models\Kategori::create(['ket_kategori' => 'Kebersihan']);
    \App\Models\Kategori::create(['ket_kategori' => 'Fasilitas']);
    \App\Models\Kategori::create(['ket_kategori' => 'Keamanan']);
}
}
