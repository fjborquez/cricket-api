<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubpanelSerieEstadistica extends Model
{
    use HasFactory;
    protected $table = 'subpaneles_serie_estadistica';
    protected $fillable = ['nombre', 'descripcion', 'url', 'ente'];

    public function paneles() {
        return $this->belongsToMany(Panel::class, 'panel_to_serie_estadistica', 'subpaneles_ser_est_id', 'panel_id');
    }
}
