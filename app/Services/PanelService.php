<?php

namespace App\Services;

use App\Models\Panel;

/**
 * Class PanelService.
 */
class PanelService
{
    public function getAll(array $filters = [])
    {
        $paneles = new Panel;

        if (in_array('user_id', $filters)) {
            $paneles = $paneles->where('user_id', $filters['user_id']);
        }

        return $paneles->get();
    }

    public function get(int $id): Panel
    {
        return Panel::with(['subpaneles' => function ($query) {
            return $query->orderBy('position', 'asc');
        }])->with('subpaneles.configuraciones.opciones')->find($id);
    }

    public function create(array $data)
    {
        $panel = new Panel;
        $panel->nombre = $data['nombre'];
        $panel->descripcion = $data['descripcion'];
        $panel->user_id = $data['user_id'];
        $panel->save();
    }

    public function delete(int $id)
    {
        return Panel::find($id)->delete();
    }

    public function addSubpanel(int $panelId, int $subpanelId, array $pivotValues): Panel
    {
        $panel = Panel::find($panelId);
        $panel->subpaneles()->syncWithoutDetaching([$subpanelId]);
        $panel->subpaneles()->updateExistingPivot($subpanelId, [
            'position' => $pivotValues['position'],
            'note' => $pivotValues['note'],
        ]);

        return $panel;
    }

    public function removeSubpanel(int $panelId, int $subpanelId): Panel
    {
        $panel = Panel::find($panelId);
        $panel->subpaneles()->detach($subpanelId);
        return $panel;
    }
}
