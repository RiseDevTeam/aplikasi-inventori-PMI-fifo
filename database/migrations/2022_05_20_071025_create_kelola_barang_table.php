<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelolaBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelola_barang', function (Blueprint $table) {
            $table->bigIncrements('id_kelola_barang');
            $table->bigInteger('id_user');
            $table->string('kode_barang', '10');
            $table->string('nama_barang', '100');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelola_barang');
    }
}
