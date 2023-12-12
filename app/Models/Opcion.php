<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Opcion extends Model
{
    use HasFactory;
    protected $table = 'opciones';
    protected $fillable = ['nombre', 'descripcion', 'valor_por_defecto'];

    public function configuracion(): BelongsTo
    {
        return $this->belongsTo(Configuracion::class);

    }
}
