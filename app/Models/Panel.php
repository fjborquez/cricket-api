<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Panel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'paneles';
    protected $fillable = ['nombre', 'descripcion'];

    public function seriesEstadisticas(): BelongsToMany
    {
        return $this->belongsToMany(SubpanelSerieEstadistica::class, 'panel_to_serie_estadistica', 'panel_id', 'subpaneles_ser_est_id');
    }

    public function insiders(): belongsToMany
    {
        return $this->belongsToMany(SubpanelInsider::class, 'panel_to_insiders', 'panel_id', 'subpanel_insider_id');
    }

    public function resultadosAnuales(): belongsToMany
    {
        return $this->belongsToMany(SubpanelResultadoAnual::class, 'panel_to_resultados_anuales', 'panel_id', 'subpanel_res_anual_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
