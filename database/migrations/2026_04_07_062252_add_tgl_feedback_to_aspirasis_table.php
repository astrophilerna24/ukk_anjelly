<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //ini digunakan untuk menambahkan kolom tgl_feedback pada tabel aspirasis yang digunakan untuk menyimpan tanggal feedback diberikan, serta menghapus kolom tersebut jika rollback dilakukan
    public function up()
{
    Schema::table('aspirasis', function (Blueprint $table) {
        $table->date('tgl_feedback')->nullable()->after('feedback');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aspirasis', function (Blueprint $table) {
            //
        });
    }
};
