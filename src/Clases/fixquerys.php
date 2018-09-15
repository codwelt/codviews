<?php

namespace Codwelt\codviews\Clases;

use Carbon\Carbon;

class fixquerys
{
    public function fixedarray($arr, $cantidad)
    {
        $labels = array();
        $data = array();
        for ($a = 1; $a <= $cantidad; $a++) {
            $labels[$a] = $a;
            $data[$a] = 0;
            for ($b = 0; $b < count($arr); $b++) {
                if ($a == $arr[$b]->punto) {
                    if (isset($arr[$b]->cantidad)) {
                        $data[$a] = $arr[$b]->cantidad;
                    } else {
                        $data[$a] = 0;
                    }
                }
            }
        }
        $compila = [array_values($data), array_values($labels)];
        return $compila;
    }

    public function fixedproced($arr)
    {
        for ($a = 0; $a < count($arr); $a++) {
            $fe = new Carbon($arr[$a]->fecha);
            $data[$a] = [
                'url' => $arr[$a]->url,
                'fecha' => $fe->toDayDateTimeString(),
                'conteo' => $arr[$a]->conteo,
            ];
        }
        return $data;
    }

    public function fixedvisitas($visitas)
    {
        $arr = [];
        if (count($visitas) > 0) {
            $arr = [
                "id" => $visitas[0]['id'],
                "ip" => $visitas[0]['ip'],
                "ciudad" => $visitas[0]['ciudad'],
                "region" => $visitas[0]['region'],
                "codregion" => $visitas[0]['codregion'],
                "nomregion" => $visitas[0]['nomregion'],
                "codarea" => $visitas[0]['codarea'],
                "codpais" => $visitas[0]['codpais'],
                "pais" => $visitas[0]['pais'],
                "codcontinente" => $visitas[0]['codcontinente'],
                "continente" => $visitas[0]['continente'],
                "latitud" => $visitas[0]['latitud'],
                "longitud" => $visitas[0]['longitud'],
                "radiolocalizacion" => $visitas[0]['radiolocalizacion'],
                "tipohorario" => $visitas[0]['tipohorario'],
                "conteo" => $visitas[0]['conteo'],
                "deleted_at" => new Carbon($visitas[0]['deleted_at']),
                "created_at" => new Carbon($visitas[0]['created_at']),
                "updated_at" => new Carbon($visitas[0]['updated_at']),
                "procedencia" => $visitas[0]['procedencia']
            ];
        }
        return $arr;
    }


    public function fixedpaises($paises, $rel)
    {
        $pais = [];
        if ($rel == null || $rel == 'codigo') {
            for ($a = 0; $a < count($paises); $a++) {
                $pais[$paises[$a]->codpais] = [
                    'Pais' => $paises[$a]->pais,
                    'CantidadRelativa' => $paises[$a]->cantidad,
                    'CantidadAbsoluta' => $paises[$a]->totalvisitas,
                ];
            }
        } elseif ($rel == 'numerico') {
            for ($a = 0; $a < count($paises); $a++) {
                $pais[$a] = [
                    'Codigo' => $paises[$a]->codpais,
                    'Pais' => $paises[$a]->pais,
                    'CantidadRelativa' => $paises[$a]->cantidad,
                    'CantidadAbsoluta' => $paises[$a]->totalvisitas,
                ];
            }
        }
        return $pais;
    }

    public function fixedcontiente($continente, $rel)
    {
        $continentes = [];
        if ($rel == null || $rel == 'codigo') {
            for ($a = 0; $a < count($continente); $a++) {
                $continentes[$continente[$a]->codcontinente] = [
                    'Pais' => $continente[$a]->continente,
                    'CantidadRelativa' => $continente[$a]->cantidad,
                    'CantidadAbsoluta' => $continente[$a]->totalvisitas,
                ];
            }
        } elseif ($rel == 'numerico') {
            for ($a = 0; $a < count($continente); $a++) {
                $continentes[$a] = [
                    'Codigo' => $continente[$a]->codcontinente,
                    'Contiente' => $continente[$a]->continente,
                    'CantidadRelativa' => $continente[$a]->cantidad,
                    'CantidadAbsoluta' => $continente[$a]->totalvisitas,
                ];
            }
        }
        return $continentes;
    }

    public function fixedciudades($ciudad, $rel)
    {
        $ciudades = [];
        if ($rel == null || $rel == 'codigo') {
            for ($a = 0; $a < count($ciudad); $a++) {
                $ciudades[$ciudad[$a]->ciudad] = [
                    'Ciudad' => $ciudad[$a]->ciudad,
                    'CantidadRelativa' => $ciudad[$a]->cantidad,
                    'CantidadAbsoluta' => $ciudad[$a]->totalvisitas,
                ];
            }
        } elseif ($rel == 'numerico') {
            for ($a = 0; $a < count($ciudad); $a++) {
                $ciudades[$a] = [
                    'Ciudad' => $ciudad[$a]->ciudad,
                    'CantidadRelativa' => $ciudad[$a]->cantidad,
                    'CantidadAbsoluta' => $ciudad[$a]->totalvisitas,
                ];
            }
        }
        return $ciudades;
    }

    public function fixedregion($region, $rel)
    {
        $regiones = [];
        if ($rel == null || $rel == 'codigo') {
            for ($a = 0; $a < count($region); $a++) {
                $regiones[$region[$a]->codregion] = [
                    'Codigo' => $region[$a]->codregion,
                    'Region' => $region[$a]->region,
                    'CantidadRelativa' => $region[$a]->cantidad,
                    'CantidadAbsoluta' => $region[$a]->totalvisitas,
                ];
            }
        } elseif ($rel == 'numerico') {
            for ($a = 0; $a < count($region); $a++) {
                $regiones[$a] = [
                    'Codigo' => $region[$a]->codregion,
                    'Region' => $region[$a]->region,
                    'CantidadRelativa' => $region[$a]->cantidad,
                    'CantidadAbsoluta' => $region[$a]->totalvisitas,
                ];
            }
        }
        return $regiones;
    }

    public function fixedvisitante($visita, $cont)
    {
        $fech = new Carbon($visita[0]['created_at']);
        $da = [
            "ip" => $visita[0]['ip'],
            "region" => $visita[0]['region'],
            "pais" => $visita[0]['pais'],
            "continente" => $visita[0]['continente'],
            "created_at" => $fech->copy()->startOfWeek()->toRfc850String(),
            "TotalVisitas" => $cont[0]->totalvisitas,
        ];
        return $da;
    }

}