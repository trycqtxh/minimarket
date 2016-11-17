<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkTableProdukMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_masuk', function (Blueprint $table) {
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
            $table->foreign('id_supplier')
                ->references('id')
                ->on('supplier')
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
        Schema::table('produk_masuk', function (Blueprint $table) {
            $table->dropForeign('produk_masuk_id_produk_foreign');
            $table->dropForeign('produk_masuk_id_produk_detail_foreign');
            $table->dropForeign('produk_masuk_id_user_foreign');
            $table->dropForeign('produk_masuk_id_supplier_foreign');
        });
    }
}
