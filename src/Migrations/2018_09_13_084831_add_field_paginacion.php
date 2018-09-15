<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldPaginacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configcodviews', function (Blueprint $table) {
            $table->integer('paginacion_detallados');
            $table->renameColumn('paginacion', 'paginacion_general');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configcodviews', function (Blueprint $table) {
            //
        });
    }
}
