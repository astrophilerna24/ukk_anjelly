<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

//class ini untuk menyimpan data siswa, biar bisa login dan input aspirasi
class Siswa extends Authenticatable
{
    protected $table = 'siswas';
    protected $primaryKey = 'nis';
    public $incrementing = false; 
    protected $fillable = ['nis', 'password', 'kelas'];
    protected $hidden = ['password'];
}