<?php

namespace App\Http\Controllers;

use App\Models\Subpanel;

class SubpanelController extends Controller
{
    public function index() {
        return Subpanel::with('configuraciones')->with('configuraciones.opciones')->get();
    }
}
