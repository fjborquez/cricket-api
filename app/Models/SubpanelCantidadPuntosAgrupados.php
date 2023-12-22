<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class SubpanelCantidadPuntosAgrupados extends Subpanel
{
    use HasFactory, HasParent;

    protected $fillable = ['grouped_by'];
}
