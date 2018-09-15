<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Configcodviewseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = new Carbon();
        DB::table('configcodviews')->insert([
            'paginacion_general' => 1,
            'paginacion_detallados' => 1,
            'filtros' => json_encode(['scan', 'spider']),
            'created_at' => $fecha->toDateTimeString()
        ]);
    }
}
