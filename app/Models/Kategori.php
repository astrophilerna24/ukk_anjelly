<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Ini di gukan untuk menyimpan kategori aspirasi, biar pilihan di input aspirasi muncul
class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['ket_kategori'];
}