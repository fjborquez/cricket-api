<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use App\Services\PanelService;
use App\Traits\APIResponses;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    use APIResponses;

    protected PanelService $panelService;

    public function __construct(PanelService $panelService) {
        $this->panelService = $panelService;
    }

    public function index(Request $request) {
        $filters = [];

        if ($request->has('user_id')) {
            $filters['user_id'] = $request->get('user_id');
        }

        return $this->panelService->getAll($filters);
    }

    public function show($id) {
        return $this->panelService->get($id);
    }

    public function delete($id) {
        return Panel::find($id)->delete();
    }

    public function store(Request $request) {
        $user = auth('api')->user();

        $data = [];
        $data['nombre'] = $request->nombre;
        $data['descripcion'] = $request->descripcion;
        $data['user_id'] = $user->id;
        $this->panelService->create($data);

        return $this->created(["message" => "Agregado"]);
    }

    public function addSubpanel($panelId, $subpanelId, Request $request) {
        $pivotValues = [
            'position' => $request->get('position', 0),
            'note' => $request->get('note', '')
        ];

        return $this->panelService->addSubpanel($panelId, $subpanelId, $pivotValues);
    }

    public function removeSubpanel($panelId, $subpanelId) {
        return $this->panelService->removeSubpanel($panelId, $subpanelId);
    }
}
