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
            $table->string('no_hp',20)->nullable();
            $table->string('no_resi')->nullable();
            $table->integer('produk_id')->nullable();
            $table->integer('jumlah')->nullable();
            $table->date('tgl_pesanan')->nullable();
            $table->string('harga', 25)->nullable();

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
        Schema::dropIfExists('penjualans');
    }
}
