<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubpanelInsider extends Model
{
    use HasFactory;
    protected $table = 'subpaneles_insider';
    protected $fillable = ['nombre', 'descripcion', 'url', 'ente'];

    public function paneles() {
        return $this->belongsToMany(Panel::class, 'panel_to_insiders', 'subpanel_insider_id', 'panel_id');
    }
}
