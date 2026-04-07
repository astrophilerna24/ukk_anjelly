<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//ini berfungsi untuk membuat tabel admins, siswas, kategoris, dan aspirasis yang digunakan untuk menyimpan data admin, siswa, kategori, dan aspirasi yang diajukan oleh siswa, serta menghapus tabel tersebut jika rollback dilakukan
return new class extends Migration {
    public function up(): void {
        // 1. Tabel Admin
        Schema::create('admins', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // 2. Tabel Siswa
        Schema::create('siswas', function (Blueprint $table) {
            $table->integer('nis')->primary();
            $table->string('password'); // WAJIB ADA
            $table->string('kelas', 10);
            $table->timestamps();
        });

        // 3. Tabel Kategori
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('ket_kategori', 30);
            $table->timestamps();
        });

        // 4. Tabel Aspirasi
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id('id_aspirasi');
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu');
            $table->foreignId('id_kategori')->constrained('kategoris', 'id_kategori');
            $table->integer('feedback')->nullable();
            $table->integer('nis');
            $table->string('lokasi', 50);
            $table->string('ket', 50);
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
        });
    }

    //digunakan untuk menghapus tabel admins, siswas, kategoris, dan aspirasis jika rollback dilakukan
    public function down(): void {
        Schema::dropIfExists('aspirasis');
        Schema::dropIfExists('kategoris');
        Schema::dropIfExists('siswas');
        Schema::dropIfExists('admins');
    }
};