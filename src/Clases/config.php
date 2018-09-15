<?php

namespace Codwelt\codviews\Clases;

use Codwelt\codviews\Models\configcodviews;
use Codwelt\codviews\Clases\Visitas;
use Illuminate\Support\Facades\DB;

class config
{
    public $visitas;

    public function __construct()
    {
        $this->visitas = new visitas();
    }

    public function refreshcount()
    {
        $this->visitas->refreshcounts();
    }

    public function update($datos)
    {
        $arr = explode(",", $datos['filtros']);
        DB::table('configcodviews')
            ->where('id', 1)
            ->update([
                'paginacion_general' => $datos['paginaciongeneral'],
                'paginacion_detallados' => $datos['paginaciondetallado'],
                'filtros' => json_encode($arr)]);
    }

    public function getdata()
    {
        return configcodviews::all()->toArray();
    }

    public function getfiltros()
    {
        $data = self::getdata();
        return json_decode($data[0]['filtros']);
    }

    public function getpaginaciongeneral()
    {
        $data = self::getdata();
        return json_decode($data[0]['paginacion_general']);
    }

    public function getpaginaciondetallada()
    {
        $data = self::getdata();
        return json_decode($data[0]['paginacion_detallados']);
    }
}