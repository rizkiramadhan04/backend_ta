<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_masuks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('nama_produk')->nullable();
            $table->text('jumlah')->nullable();
            $table->date('tgl_produk_masuk')->nullable();
            $table->integer('pemasok_id')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('produk_masuks');
    }
}
