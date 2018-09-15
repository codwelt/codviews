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
            $table->integer('paginacion_detallados')->nullable($value = true);
            $table->renameColumn('paginacion', 'paginacion_general')->nullable($value = true);
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
