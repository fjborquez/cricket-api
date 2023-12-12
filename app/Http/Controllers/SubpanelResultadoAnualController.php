<?php

namespace App\Http\Controllers;

use App\Models\SubpanelResultadoAnual;

class SubpanelResultadoAnualController extends Controller
{
    public function index() {
        return SubpanelResultadoAnual::all();
    }
}
