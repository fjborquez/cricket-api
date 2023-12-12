<?php

namespace App\Http\Controllers;

use App\Models\SubpanelInsider;
use Illuminate\Http\Request;

class SubpanelInsiderController extends Controller
{
    public function index() {
        return SubpanelInsider::all();
    }
}
