<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProdukMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tanggal');
            $table->unsignedSmallInteger('stok');
            $table->unsignedInteger('id_produk');
            $table->unsignedInteger('id_produk_detail');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_supplier')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_masuk');
    }
}
