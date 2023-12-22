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
}
