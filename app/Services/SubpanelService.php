<?php

namespace App\Services;

use App\Models\Subpanel;

/**
 * Class SubpanelService.
 */
class SubpanelService
{
    public function getAll(array $order = [])
    {
        $subpanels = new Subpanel;
        $subpanels = $subpanels->with('configuraciones')->with('configuraciones.opciones');

        if (in_array('orderBy', $order)) {
            $subpanels->orderBy($order['orderBy'], $order['orderDirection']);
        }

        return $subpanels->get();
    }

    public function create(array $subpanelData): Subpanel
    {
        $subpanel = new Subpanel();
        $subpanel->nombre = $subpanelData['nombre'];
        $subpanel->descripcion = $subpanelData['descripcion'];
        $subpanel->url = $subpanelData['url'];
        $subpanel->ente = $subpanelData['ente'];
        $subpanel->type = $subpanelData['type'];
        $subpanel->grouped_by = $subpanelData['grouped_by'];
        $subpanel->save();

        return $subpanel;
    }

    public function delete(int $id): Subpanel
    {
        $subpanel = Subpanel::find($id);
        $subpanel->delete();
        return $subpanel;
    }
}
