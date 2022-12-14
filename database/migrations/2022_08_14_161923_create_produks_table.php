<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_produk')->nullable();
            $table->integer('jml_masuk')->nullable();
            $table->integer('jml_keluar')->nullable();
            $table->integer('total')->nullable();
            $table->date('tgl_produk_masuk')->nullable();
            $table->integer('harga_jual')->nullable();
            $table->integer('harga_beli')->nullable();
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
        Schema::dropIfExists('produks');
    }
}
