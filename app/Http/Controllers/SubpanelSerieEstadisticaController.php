<?php

namespace App\Http\Controllers;

use App\Models\SubpanelSerieEstadistica;

class SubpanelSerieEstadisticaController extends Controller
{
    public function index() {
        return SubpanelSerieEstadistica::with('configuraciones')->with('configuraciones.opciones')->get();
    }
}
