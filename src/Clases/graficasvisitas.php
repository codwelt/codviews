<?php

namespace Codwelt\codviews\Clases;

use Codwelt\codviews\visitas as bdviitas;
use Codwelt\codviews\Clases\fixquerys;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class graficasvisitas
{
    public $fixed;
    public $config;

    function __construct()
    {
        $this->fixed = new fixquerys();
        $this->config = new config();
    }

    public function filtros()
    {
        $dt = $this->config->getfiltros();
        $filtros = "";
        for ($a = 0; $a < count($dt); $a++) {
            $filtros .= 'and lower(visitashistoricas.user_agent) NOT like "%' . $dt[$a] . '%" ';
        }
        return $filtros;
    }

    public function traervisitasmes()
    {
        $meses = DB::select('
                    SELECT COUNT(*) as cantidad, month(visitashistoricas.created_at) as punto
                    FROM visitas, visitashistoricas
                    WHERE visitas.ip = visitashistoricas.ipfk ' . self::filtros() . '
                    and visitashistoricas.ipfk != "' . Visitas::ObtenerIp() . '"
                    GROUP BY punto');
        return $this->fixed->fixedarray($meses, 12);
    }

    /**
     * traer los dias de la base de datos utilizando expresiones raw sql
     */
    public function traervisitasdias()
    {
        $dias = DB::select('
                SELECT count(*) as cantidad, day(visitashistoricas.created_at) as punto
                FROM `visitas`, visitashistoricas
                WHERE  visitashistoricas.ipfk = visitas.ip ' . self::filtros() . '
                and visitashistoricas.ipfk != "' . Visitas::ObtenerIp() . '"
                and MONTH(visitashistoricas.created_at) = MONTH(CURDATE())
                GROUP BY punto');
        $fecha = Carbon::now();
        $cantidad = cal_days_in_month(CAL_GREGORIAN, $fecha->month, $fecha->year);
        return $this->fixed->fixedarray($dias, $cantidad);
    }

    public function traervisitaspaises($rel = null)
    {
        $paises = DB::select('SELECT count(*) as cantidad, pais, codpais, SUM(conteo)as totalvisitas FROM visitas GROUP BY pais, codpais ORDER by totalvisitas DESC;');
        return $this->fixed->fixedpaises($paises, $rel);
    }

    public function traervisitascontinente($rel = null)
    {
        $continente = DB::select('SELECT count(*) as cantidad, continente, codcontinente, SUM(conteo)as totalvisitas FROM visitas GROUP BY continente, codcontinente ORDER by totalvisitas DESC;');
        return $this->fixed->fixedcontiente($continente, $rel);
    }

    public function traervisitasciudad($rel = null)
    {
        $ciudades = DB::select('SELECT count(*) as cantidad, ciudad, SUM(conteo)as totalvisitas FROM visitas GROUP BY ciudad ORDER by totalvisitas DESC;');
        return $this->fixed->fixedciudades($ciudades, $rel);
    }

    public function traervisitasregion($rel = null)
    {
        $region = DB::select('SELECT count(*) as cantidad, region,codregion, SUM(conteo)as totalvisitas FROM visitas GROUP BY region, codregion ORDER by totalvisitas DESC;');
        return $this->fixed->fixedregion($region, $rel);
    }


    /**
     * @return mixed
     */
    public function traerprocedencia()
    {
        return $this->fixed->fixedproced(DB::select("
          SELECT urlprocedencia as url, date(created_at) as fecha, COUNT(*) as conteo
          FROM visitashistoricas
          where  " . self::filtros() . "
          GROUP BY url, fecha
          ORDER BY conteo
          DESC limit 10"));
    }

    public function traerpaginasvisitadas()
    {
        return $this->fixed->fixedproced(DB::select("
                SELECT url_visita as url, date(created_at) as fecha, COUNT(*) as conteo
                FROM visitashistoricas
                WHERE MONTH(created_at) = MONTH(NOW()) " . self::filtros() . "
                and visitashistoricas.url_visita != '" . $_SERVER['HTTP_HOST'] . "'
                GROUP BY url, fecha
                ORDER BY conteo desc limit 10"));
    }

}
