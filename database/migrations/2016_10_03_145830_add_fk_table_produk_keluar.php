<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkTableProdukKeluar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_keluar', function (Blueprint $table) {
            $table->foreign('id_produk')
                ->references('id')
                ->on('produk')
                ->onDelete('cascade');
            $table->foreign('id_produk_detail')
                ->references('id')
                ->on('produk_detail')
                ->onDelete('cascade');
            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk_keluar', function (Blueprint $table) {
            $table->dropForeign('produk_keluar_id_produk_foreign');
            $table->dropForeign('produk_keluar_id_produk_detail_foreign');
            $table->dropForeign('produk_keluar_id_user_foreign');
        });
    }
}
