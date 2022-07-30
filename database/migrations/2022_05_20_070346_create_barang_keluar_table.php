<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->bigIncrements('id_barang_keluar');
            $table->bigInteger('id_user');
            $table->bigInteger('id_stok');
            $table->string('kode_barang', '10');
            $table->bigInteger('stok_keluar');
            $table->date('tanggal_barang_keluar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_keluar');
    }
}
