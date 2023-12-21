<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parental\HasParent;

class SubpanelMapa extends Subpanel
{
    use HasFactory, HasParent;
}
