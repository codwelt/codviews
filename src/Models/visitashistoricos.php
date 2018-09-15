<?php

namespace Codwelt\codviews\Models;

use Illuminate\Database\Eloquent\Model;

class visitashistoricos extends Model
{
   protected $table = "visitashistoricas";
   protected $fillable = ['ipfk', 'urlprocedencia', 'url_visita'];

   public function visitas(){
       return $this->belongsTo('Codwelt\codviews\Models\visitas', 'ipfk', 'ip');
   }
}
