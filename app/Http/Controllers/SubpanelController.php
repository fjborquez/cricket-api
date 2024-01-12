<?php

namespace App\Http\Controllers;

use App\Models\Subpanel;
use Illuminate\Http\Request;

class SubpanelController extends Controller
{
    public function index(Request $request) {
        $subpanels = new Subpanel();
        $subpanels = $subpanels->with('configuraciones')->with('configuraciones.opciones');

        if ($request->has('orderBy')) {
            $subpanels->orderBy($request->get('orderBy'), $request->get('orderDirection', 'DESC'));
        }

        return $subpanels->get();
    }

    public function create(Request $request) {
        $subpanel = new Subpanel();
        $subpanel->nombre = $request->nombre;
        $subpanel->descripcion = $request->descripcion;
        $subpanel->url = $request->url;
        $subpanel->ente = $request->ente;
        $subpanel->type = $request->type;
        $subpanel->grouped_by = $request->grouped_by;
        $subpanel->save();
        return $subpanel;

    }
}
