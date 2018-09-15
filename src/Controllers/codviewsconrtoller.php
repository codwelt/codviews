<?php /** @noinspection ALL */

namespace Codwelt\codviews\Controllers;

use Codwelt\codviews\Clases\config;
use Codwelt\codviews\Models\visitas as bdvisitas;
use Codwelt\codviews\Models\visitashistoricos;
use Codwelt\codviews\Clases\graficasvisitas;
use Codwelt\codviews\Clases\fixquerys;
use App\Http\Controllers\Controller;
use Codwelt\codviews\Clases\Visitas;
use Illuminate\Support\Facades\DB;
use Codwelt\codviews\Tools\Tools;
use Illuminate\Http\Request;

class codviewsconrtoller extends Controller
{

    public $graficas;
    public $herramientas;
    public $fixed;
    public $config;

    function __construct()
    {
        $this->herramientas = new Tools();
        $this->graficas = new graficasvisitas();
        $this->fixed = new fixquerys();
        $this->config = new config();
    }

    public function index()
    {
        if (isset($_GET['consulta'])) {
            $visits = DB::table('visitas')
                ->where([['ip', 'like', '%' . $_GET['consulta'] . '%']])
                ->orWhere([['ciudad', 'like', '%' . $_GET['consulta'] . '%']])
                ->orWhere([['region', 'like', '%' . $_GET['consulta'] . '%']])
                ->orWhere([['codregion', 'like', '%' . $_GET['consulta'] . '%']])
                ->orWhere([['codarea', 'like', '%' . $_GET['consulta'] . '%']])
                ->orWhere([['nomregion', 'like', '%' . $_GET['consulta'] . '%']])
                ->orWhere([['codcontinente', 'like', '%' . $_GET['consulta'] . '%']])
                ->orWhere([['codpais', 'like', '%' . $_GET['consulta'] . '%']])
                ->orWhere([['pais', 'like', '%' . $_GET['consulta'] . '%']])
                ->orWhere([['continente', 'like', '%' . $_GET['consulta'] . '%']])
                ->paginate($this->config->getpaginaciongeneral());

        } else {
            $visits = DB::table('visitas')->where('ip', '!=', Visitas::ObtenerIp())->orderBy('updated_at', 'desc')->paginate($this->config->getpaginaciongeneral());
        }
        return view('codviews.visitas')
            ->with('visitas', $visits);
    }

    public function show($id)
    {
        $visitas = $this->herramientas->forceToArray(bdvisitas::where('id', $id)->get());
        $visitashistoriacas = DB::table('visitashistoricas')->where('ipfk', $visitas[0]['ip'])->orderByDesc('updated_at')->paginate($this->config->getpaginaciondetallada());
        return view('codviews.detalle')
            ->with('detalles', $this->fixed->fixedvisitas($visitas))
            ->with('historial', $visitashistoriacas);
    }


}