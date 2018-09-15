<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFliedTableVisitashistoricas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitashistoricas', function (Blueprint $table) {
            $table->string('user_agent')->nullable($value = true);
            $table->string('agent_browser')->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitashistoricas', function (Blueprint $table) {
            //
        });
    }
}
