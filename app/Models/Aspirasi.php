<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Aspirasi
 * * Model ini merepresentasikan entitas aspirasi yang dikirimkan oleh pengguna (siswa).
 * Menggunakan trait HasFactory untuk mendukung pembuatan data testing (seeding/factory).
 */
class Aspirasi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang secara spesifik digunakan oleh model ini.
     * @var string
     */
    protected $table = 'aspirasis';

    /**
     * Nama kolom kunci utama (primary key).
     * Didefinisikan secara manual karena tidak menggunakan nama default 'id'.
     * @var string
     */
    protected $primaryKey = 'id_aspirasi';

    /**
     * Daftar atribut yang dapat diisi secara massal (mass assignable).
     * * @var array
     */
    protected $fillable = [
        'nis',          // Nomor Induk Siswa (Foreign Key ke tabel siswa)
        'id_kategori',  // ID Kategori aspirasi (Foreign Key ke tabel kategori)
        'lokasi',       // Lokasi terkait aspirasi yang dilaporkan
        'ket',          // Keterangan atau isi detail aspirasi
        'foto',         // Nama file/path dokumentasi foto
        'status',       // Status proses aspirasi (misal: pending, proses, selesai)
        'feedback'      // Umpan balik atau respon dari pihak admin
    ];


    // Relasi ke tabel Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Relasi ke tabel Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}