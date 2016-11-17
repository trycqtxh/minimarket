<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkAturanMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aturan_menu', function (Blueprint $table) {
            $table->foreign('id_status')
                ->references('id')
                ->on('status')
                ->onDelete('cascade');
            $table->foreign('id_menu')
                ->references('id')
                ->on('menu')
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
        Schema::table('aturan_menu', function (Blueprint $table) {
            $table->dropForeign('aturan_menu_id_status_foreign');
            $table->dropForeign('aturan_menu_id_menu_foreign');
        });
    }
}
