<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_panen', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');
            $table->string('nama_tanaman');
            $table->integer('berat_panen');
            $table->year('tahun_panen');
            $table->enum('kondisi_tanaman', ['Baik', 'Buruk']);
            $table->string('gambar_tanaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_panen');
    }
};
