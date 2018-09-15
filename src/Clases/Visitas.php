<?php

namespace Codwelt\codviews\Clases;

use Codwelt\codviews\Models\visitas as bdviitas;
use Codwelt\codviews\Models\visitashistoricos;
use Codwelt\codviews\Clases\fixquerys;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Codwelt\codviews\Tools\Tools;
use Carbon\Carbon;

class Visitas
{
    public $bdvisit;
    public $herramientas;
    public $fixed;

    function __construct()
    {
        $this->herramientas = new Tools();
        $this->fixed = new fixquerys();
    }

    public function visita($url)
    {
        $consulta = self::obtenerduplicado();
        if (count($consulta) > 0) {
            self::actualizar($consulta, $url);
        } else {
            $consulta = self::agregarvisita($url);
            self::actualizar(self::obtenerduplicado(), $url);
        }
        return $this->fixed->fixedvisitante($consulta, self::obttotalvisit());
    }

    public function obttotalvisit()
    {
        return DB::select('SELECT SUM(conteo)as totalvisitas FROM visitas');
    }

    public static function ObtenerIp()
    {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }


    private function Localizacion()
    {
        try {
            // Cogemos la IP del usuario del array que nos pasa el servidor
            $user_ip = self::ObtenerIp();
            // Iniciamos el handler de CURL y le pasamos la URL de la API externa
            $ch = curl_init("http://geoplugin.net/json.gp?ip=$user_ip");

            // Con este comando le pedimos a CURL que, en vez de mostrar
            // el resultado en pantalla, nos lo devuelva como una variable
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Y simplemente hacemos la petición HTTP.
            $country_code = curl_exec($ch);
            return $country_code;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function agregarvisita($url)
    {
        try {
            $data = json_decode(self::Localizacion());
            $bdvisit = new bdviitas();
            $bdvisit->ip = $data->geoplugin_request;
            $bdvisit->ciudad = $data->geoplugin_city;
            $bdvisit->region = $data->geoplugin_region;
            $bdvisit->codregion = $data->geoplugin_regionCode;
            $bdvisit->nomregion = $data->geoplugin_regionName;
            $bdvisit->codarea = $data->geoplugin_areaCode;
            $bdvisit->codpais = $data->geoplugin_countryCode;
            $bdvisit->pais = $data->geoplugin_countryName;
            $bdvisit->codcontinente = $data->geoplugin_continentCode;
            $bdvisit->continente = $data->geoplugin_continentName;
            $bdvisit->latitud = $data->geoplugin_latitude;
            $bdvisit->longitud = $data->geoplugin_longitude;
            $bdvisit->radiolocalizacion = $data->geoplugin_locationAccuracyRadius;
            $bdvisit->tipohorario = $data->geoplugin_timezone;
            $bdvisit->conteo = 1;
            $bdvisit->save();
            return $bdvisit;
        } catch (\Exception $e) {
            Log::error("Se genero un error de geolocalizacion " . $e->getMessage());
        }

    }

    private function actualizar($data, $url)
    {
        $historial = new visitashistoricos();
        $historial->ipfk = $data[0]['ip'];
        $historial->urlprocedencia = self::obtenerurlreferencia();
        $historial->url_visita = $url;
        $historial->user_agent = $_SERVER ['HTTP_USER_AGENT'];
        $historial->save();
        //$historial->agent_browser = self::agentebrowser()['browser'];
        $conteo = self::obtenerconteo($data[0]['ip']);
        bdviitas::where('ip', $data[0]['ip'])
            ->update(['conteo' => $conteo, 'updated_at' => $historial->created_at]);
        return $historial;
    }

    private function obtenerconteo($ip)
    {
        $cantidad = visitashistoricos::where('ipfk', $ip)
            ->where('user_agent', 'NOT LIKE', '%bot%')
            ->orWhere('user_agent', 'NOT LIKE', '%spider%')
            ->orWhere('user_agent', 'NOT LIKE', '%scan%')
            ->count();
        if ($cantidad != null) {
            return $cantidad;
        } else {
            return 0;
        }
    }

    public function refreshcounts()
    {
        $result = DB::update('UPDATE visitas SET conteo = (SELECT count(*) FROM visitashistoricas WHERE ipfk = visitas.ip)');
    }


    private function obtenerurlreferencia()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            return $_SERVER['HTTP_REFERER'];
        } else {
            return NULL;
        }
    }

    function obtenerduplicado()
    {
        return $this->herramientas->forceToArray(bdviitas::where('ip', self::ObtenerIp())->get());
    }

    function agentebrowser()
    {
        return get_browser(null, true);
    }
}
