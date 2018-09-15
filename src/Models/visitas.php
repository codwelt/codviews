<?php

namespace Codwelt\codviews\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class visitas extends Model
{
    use SoftDeletes;
    protected $table = "visitas";
    protected  $fillable = ['id', 'ip', 'ciudad', 'region', 'codregion', 'nomregion', 'codarea', 'codpais', 'pais', 'codcontinente', 'continente', 'latitud', 'longitud',
        'radiolocalizacion', 'tipohorario', 'conteo', 'procedencia'];

    public  function  visitashistoricas(){
        return $this->hasMany('Codwelt\codviews\Models\visitashistoricos', 'ipfk', 'ip');
    }
}
