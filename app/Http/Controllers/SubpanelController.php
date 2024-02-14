<?php

namespace App\Http\Controllers;

use App\Models\Subpanel;
use App\Services\SubpanelService;
use Illuminate\Http\Request;

class SubpanelController extends Controller
{
    protected SubpanelService $subpanelService;

    public function __construct(SubpanelService $subpanelService)
    {
        $this->subpanelService = $subpanelService;
    }

    public function index(Request $request) {
        $order = [];

        if ($request->has('orderBy')) {
            $order['orderBy'] = $request->get('orderBy');
            $order['orderDirection'] = $request->get('orderDirection', 'DESC');
        }

        return $this->subpanelService->getAll($order);
    }

    public function create(Request $request) {
        $subpanelData = [];
        $subpanelData['nombre'] = $request->nombre;
        $subpanelData['descripcion'] = $request->descripcion;
        $subpanelData['url'] = $request->url;
        $subpanelData['ente'] = $request->ente;
        $subpanelData['type'] = $request->type;
        $subpanelData['grouped_by'] = $request->grouped_by;
        return $this->subpanelService->create($subpanelData);
    }

    public function delete($id) {
        return $this->subpanelService->delete($id);
    }
}
