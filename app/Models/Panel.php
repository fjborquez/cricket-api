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

    public function subpaneles(): BelongsToMany
    {
        return $this->belongsToMany(Subpanel::class, 'panel_to_subpanel', 'panel_id', 'subpanel_id')
            ->withPivot('position')
            ->orderByPivot('position', 'asc');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
