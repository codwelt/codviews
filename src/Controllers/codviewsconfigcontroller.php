<?php

namespace Codwelt\codviews\Controllers;

use Codwelt\codviews\Models\visitas as bdvisitas;
use Codwelt\codviews\Clases\graficasvisitas;
use App\Http\Controllers\Controller;
use Codwelt\codviews\Clases\Visitas;
use Codwelt\codviews\Clases\config;
use Codwelt\codviews\Models\configcodviews;
use Illuminate\Support\Facades\DB;
use Codwelt\codviews\Tools\Tools;
use Illuminate\Http\Request;

class codviewsconfigcontroller extends Controller
{
    public $config;

    public function __construct()
    {
        $this->config = new config();
    }

    public function index()
    {
        $data = configcodviews::all()->toArray();
        return view('codviews.configuracion')
            ->with('datos', $data);
    }

    public function resetcount()
    {
        $this->config->refreshcount();
    }

    public function store(Request $request)
    {
        $this->config->update($request->all());
        return redirect()->route('codviewsconfigcontroller')->withErrors('Configuración actualizada');
    }
}