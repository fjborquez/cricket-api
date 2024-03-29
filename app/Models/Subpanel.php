<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Parental\HasChildren;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subpanel extends Model
{
    use HasFactory, HasChildren, SoftDeletes;
    protected $table = 'subpaneles';
    protected $fillable = ['nombre', 'descripcion', 'url', 'ente', 'type'];
    protected $childTypes = [
        'serieEstadistica' => SubpanelSerieEstadistica::class,
        'resultadoAnual' => SubpanelResultadoAnual::class,
        'insider' => SubpanelInsider::class,
        'cantidadPuntosAgrupados' => SubpanelCantidadPuntosAgrupados::class,
        'mapa' => SubpanelMapa::class,
        'note' => SubpanelNote::class,
    ];

    public function paneles() {
        return $this->belongsToMany(Panel::class, 'panel_to_subpanel', 'subpanel_id', 'panel_id')
            ->withPivot('position')
            ->withPivot('note')
            ->orderByPivot('position', 'asc');
    }

    public function configuraciones(): HasMany {
        return $this->hasMany(Configuracion::class, 'subpanel_id');
    }
}
