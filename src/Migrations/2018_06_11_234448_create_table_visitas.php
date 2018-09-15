<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVisitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip')->nullable($value = true);
            $table->string('ciudad')->nullable($value = true);
            $table->string('region')->nullable($value = true);
            $table->string('codregion')->nullable($value = true);
            $table->string('nomregion')->nullable($value = true);
            $table->string('codarea')->nullable($value = true);
            $table->string('codpais')->nullable($value = true);
            $table->string('pais')->nullable($value = true);
            $table->string('codcontinente')->nullable($value = true);
            $table->string('continente')->nullable($value = true);
            $table->string('latitud')->nullable($value = true);
            $table->string('longitud')->nullable($value = true);
            $table->string('radiolocalizacion')->nullable($value = true);
            $table->string('tipohorario')->nullable($value = true);
            $table->string('conteo')->nullable($value = true);
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
        Schema::dropIfExists('visitas');
    }
}
