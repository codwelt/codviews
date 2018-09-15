<?php

namespace  Codwelt\codviews\Models;
use Illuminate\Database\Eloquent\Model;

class configcodviews extends Model
{
    protected $table = "configcodviews";
    protected $fillable = ['id', 'paginacion_general', 'filtros', 'paginacion_detallados'];
}
