<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fuel;
use Inertia\Inertia;


class FuelController extends Controller
{
    public function store()
    {
        $fuels = Fuel::all();
        return response() -> json($fuels);
    }
}
