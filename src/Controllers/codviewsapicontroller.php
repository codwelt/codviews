<?php
namespace Codwelt\codviews\Controllers;
use Codwelt\codviews\Models\visitas as bdvisitas;
use Codwelt\codviews\Clases\graficasvisitas;
use App\Http\Controllers\Controller;
use Codwelt\codviews\Clases\Visitas;
use Illuminate\Support\Facades\DB;
use Codwelt\codviews\Tools\Tools;
use Illuminate\Http\Request;

class codviewsapiconrtoller extends Controller
{
    public $graficas;
    public $herramientas;
    public $visitas;

    function __construct()
    {
        $this->herramientas = new Tools();
        $this->graficas = new graficasvisitas();
        $this->visitas = new Visitas();
    }


    public function show($data)
    {
        if ($data == 'mes') {
            return json_encode($this->graficas->traervisitasmes());
        } elseif ($data == 'dias') {
            return json_encode($this->graficas->traervisitasdias());
        } elseif ($data == 'paises') {
            return json_encode($this->graficas->traervisitaspaises());
        }
    }

    public function mundial($data)
    {
        if (isset($_GET['relacion'])) {
            $rel = $_GET['relacion'];
        } else {
            $rel = null;
        }
        if ($data == 'paises') {
            return json_encode($this->graficas->traervisitaspaises($rel));
        } elseif ($data == 'continente') {
            return json_encode($this->graficas->traervisitascontinente($rel));
        } elseif ($data == 'ciudad') {
            return json_encode($this->graficas->traervisitasciudad($rel));
        } elseif ($data == 'region') {
            return json_encode($this->graficas->traervisitasregion($rel));
        }
    }


    public function genvisit(Request $request)
    {
        return json_encode($this->visitas->visita(url($request->getPathInfo())));
    }


}
