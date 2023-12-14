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
        return Panel::with('subpaneles')->with('subpaneles.configuraciones.opciones')->find($id);
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

    public function addSubpanel($panelId, $subpanelId) {
        $panel = Panel::find($panelId);
        $panel->subpaneles()->attach($subpanelId);
        return $panel;
    }

    public function removeSubpanel($panelId, $subpanelId) {
        $panel = Panel::find($panelId);
        $panel->subpaneles()->detach($subpanelId);
        return $panel;
    }
}
