<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Parental\HasParent;

class SubpanelSerieEstadistica extends Subpanel
{
    use HasFactory, HasParent;

    public function configuraciones(): HasMany {
        return $this->hasMany(Configuracion::class, 'serie_estadistica_id');
    }
}
