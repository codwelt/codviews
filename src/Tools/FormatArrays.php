<?php

namespace Codwelt\codviews\Tools;

use Carbon\Carbon;

class FormatArrays
{

    public function FormatTestimonios($data)
    {
        $datos = [];
        if (count($data) > 0) {
            for ($a = 0; $a < count($data); $a++) {
                $fecha = new Carbon($data[$a]['created_at']);
                $datos[$a] = [
                    'testimonio' => $data[$a]['testimonio'],
                    'autor' => $data[$a]['autor'],
                    'cargo' => $data[$a]['cargo'],
                    'creado' => $fecha->diffForHumans(),
                    'logo' => '/storage/' . $data[$a]['cliente']['logo'],
                    'nombreempresa' => $data[$a]['cliente']['nombre']
                ];
            }
        }
        return $datos;
    }

    public function formatnotificaciones($data)
    {
        for ($a = 0; $a < count($data); $a++) {
            $not = json_decode($data[$a]['notification']);
            $fecha = new Carbon(json_decode($data[$a]['created_at']));
            $dat[$a] = [
                'idnoti' => $data[$a]['id'],
                'url' => $data[$a]['url'],
                'autor' => $not->correo,
                'notificacion' => substr($not->mensaje, 0, 20),
                'crado' => $fecha->diffForHumans(),
            ];
        }
        return $dat;
    }

    public function formatpaquetenotificaciones($nuevos, $viejos)
    {
        $paquete = [
            'nuevos' => $nuevos,
            'historial' => $viejos,
        ];
        return $paquete;
    }


    // array clientes
    public function arrayclientes($cliente)
    {
//        dd($cliente);
        for ($a = 0; $a < count($cliente); $a++) {
            $client[$a] = [
                'id' => $cliente[$a]['id'],
                'nombre' => $cliente[$a]['nombre'],
                'logo' => $cliente[$a]['logo'],
                'representante' => $cliente[$a]['representante'],
                'direccion' => $cliente[$a]['direccion'],
                'telefono' => $cliente[$a]['telefono'],
                'correo' => $cliente[$a]['correo'],
                'ciudad' => $cliente[$a]['ciudad'],
                'ipftp' => $cliente[$a]['ipftp'],
                'usuarioftp' => $cliente[$a]['usuarioftp'],
                'claveftp' => $cliente[$a]['claveftp'],
                'urlpag' => $cliente[$a]['urlpag'],
                'urlcpanel' => $cliente[$a]['urlcpanel'],
                'usuariocpanel' => $cliente[$a]['usuariocpanel'],
                'contrasenacpanel' => $cliente[$a]['contrasenacpanel'],
                'usuariowp' => $cliente[$a]['usuariowp'],
                'contrasenawp' => $cliente[$a]['contrasenawp'],
                'urlwpadmin' => $cliente[$a]['urlwpadmin'],
                'estado' => $cliente[$a]['estado'],
                'descripcion' => $cliente[$a]['descripcion'],
                'hosting' => new Carbon($cliente[$a]['hosting']),
                'hostingcantidad' => $cliente[$a]['hostingcantidad'],
                'created_at' => new Carbon($cliente[$a]['created_at']),
            ];
        }
    return $client;
    }
}