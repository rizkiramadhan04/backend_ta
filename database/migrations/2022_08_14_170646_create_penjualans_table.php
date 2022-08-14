<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable();
            $table->string('nama_pelanggan')->nullable();
            $table->integer('no_hp')->nullable();
            $table->string('no_resi')->nullable();
            $table->string('nama_product')->nullable();
            $table->integer('jumlah_produk')->nullable();
            $table->date('tgl_pesenan')->nullable();
            $table->integer('harga_produk')->nullable();
            $table->integer('total_harga')->nullable();
            $table->integer('total_jml_brg')->nullable();
            $table->foreignId('produks_id')->constrained()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}
