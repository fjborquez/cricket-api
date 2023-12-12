<?php

namespace App\Http\Controllers;

use App\Models\SubpanelSerieEstadistica;

class SubpanelSerieEstadisticaController extends Controller
{
    public function index() {
        return SubpanelSerieEstadistica::all();
    }
}
