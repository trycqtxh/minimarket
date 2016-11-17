<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkAturanSubmenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aturan_submenu', function (Blueprint $table) {
            $table->foreign('id_status')
                ->references('id')
                ->on('status')
                ->onDelete('cascade');
            $table->foreign('id_submenu')
                ->references('id')
                ->on('submenu')
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
        Schema::table('aturan_submenu', function (Blueprint $table) {
            //$table->dropForeign('aturan_submenu_id_status_foreign');
            $table->dropForeign('aturan_submenu_id_submenu_foreign');
        });
    }
}
