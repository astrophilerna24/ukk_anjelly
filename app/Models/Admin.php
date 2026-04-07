<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Model Admin
 * * Model ini menangani autentikasi dan interaksi data untuk tabel 'admins'.
 * Mengadopsi Authenticatable agar dapat digunakan dalam sistem Guard Laravel.
 */
class Admin extends Authenticatable
{
    /**
     * Nama tabel yang terkait dengan model ini.
     * * @var string
     */
    protected $table = 'admins';

    /**
     * Nama kolom kunci utama (primary key) dari tabel.
     * Secara default Laravel mencari kolom 'id', sehingga perlu didefinisikan secara eksplisit.
     */
    protected $primaryKey = 'id_admin';

    /**
     * Atribut yang dapat diisi melalui mass assignment.
     * Digunakan untuk menentukan kolom mana saja yang boleh disimpan menggunakan metode create() atau update().
     */
    protected $fillable = ['username', 'password'];
}


/*
$admin = new App\Models\Admin;
$admin->username = 'admin';
$admin->password = Hash::make('admin123'); 
$admin->save();
*/

/*
bismillah lancar ukk tanpa remidi
*/