<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index(Request $request) {
        $paneles = new Panel;

        if ($request->has('user_id')) {
            $paneles = $paneles->where('user_id', $request->get('user_id'));
        }

        return $paneles->get();
    }

    public function show($id) {
        return Panel::with('seriesEstadisticas')->with('seriesEstadisticas.configuraciones.opciones')->with('insiders')->with('resultadosAnuales')->find($id);
    }

    public function delete($id) {
        return Panel::find($id)->delete();
    }

    public function store(Request $request) {
        $user = auth('api')->user();
        $panel = new Panel;
        $panel->nombre = $request->nombre;
        $panel->descripcion = $request->descripcion;
        $panel->user_id = $user->id;
        $panel->save();

        return response()->json(["message" => "Agregado" ], 201);
    }

    public function addSerie($panelId, $serieId) {
        $panel = Panel::find($panelId);
        $panel->seriesEstadisticas()->attach($serieId);
        return $panel;
    }

    public function addInsider($panelId, $insiderId) {
        $panel = Panel::find($panelId);
        $panel->insiders()->attach($insiderId);
        return $panel;
    }

    public function addResultadoAnual($panelId, $resultadoAnualId) {
        $panel = Panel::find($panelId);
        $panel->resultadosAnuales()->attach($resultadoAnualId);
        return $panel;
    }

    public function removeSerie($panelId, $serieId) {
        $panel = Panel::find($panelId);
        $panel->seriesEstadisticas()->detach($serieId);
        return $panel;
    }

    public function removeInsider($panelId, $insiderId) {
        $panel = Panel::find($panelId);
        $panel->insiders()->detach($insiderId);
        return $panel;
    }

    public function removeResultadoAnual($panelId, $resultadoAnualId) {
        $panel = Panel::find($panelId);
        $panel->resultadosAnuales()->detach($resultadoAnualId);
        return $panel;
    }
}
